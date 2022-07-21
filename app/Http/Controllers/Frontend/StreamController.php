<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Channel;
use App\Models\Frontend\Playlist;
use App\Models\LiveStream;
use App\Models\StreamRecord;
use Illuminate\Http\Request;

class StreamController extends Controller
{
    // Stream home page listing
    public function index()
    {
        $streams = LiveStream::where('streamDateTime', '>=', strtotime('now'))
            ->where('status', 'Pending')
            ->with('channel', 'user_purchased_video', 'host_user_plan_info')
            ->orderByDesc('id')
            ->paginate(9);
        // return $streams;
        return view('frontend.pages.stream', ['streams' => $streams]);
    }

    // Stream join as host
    public function join_as_host(Request $r, $slug)
    {
        $streamId = $r->streamId;
        return view('frontend.pages.host_live.host', [
            'streamId' => $streamId,
            'slug' => $slug
        ]);
    }

    // Stream Viewer counter
    public function stream_record_create(Request $r)
    {
        $user_id = auth()->user()->id;
        $user_ip_address = $r->ip();
        $event_id = $r->event_id;

        $find = StreamRecord::where('guest_id', $user_id)->get();

        if (count($find) == 0) {
            try {
                $obj = new StreamRecord();
                $obj->guest_id = $user_id;
                $obj->guest_ip_address = $user_ip_address;
                $obj->event_id = $event_id;
                $obj->save(); // event_id = Live Stream Id

                $query = LiveStream::where('id', $event_id)->first();
                $query->total_views = $query->total_views + 1;
                $query->update();
                return response()->json([
                    $query->total_views
                ]);
            } catch (\Throwable $th) {
                throw $th;
            }
        } else {
            return response()->json([
                'result' => 'Already exists'
            ]);
        }
    }

    //  Update Stream Cancel status
    public function stream_status()
    {
        $id = $_GET['id'];
        $status = $_GET['status'];

        try {
            $obj = LiveStream::find($id);
            $obj->status = $status;
            $obj->update();

            return response()->json([
                'status' => 'success'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // Get data for single stream
    public function stream_edit()
    {
        $userID = auth()->user()->id;
        $id = base64_decode($_GET['id']);
        $query = LiveStream::where('id', $id)->get();

        if (count($query) > 0) {
            foreach ($query as $q) {
                $html['id'] = $q->id;
                $html['streamDateTime'] = $q->streamDateTime;
                $html['topic'] = $q->topic;
                $html['channel'] = $q->channel_id;
                $html['playlist'] = $q->playlist_id;
                $html['desc'] = $q->description;
            }

            // Playlist select option
            $playlist = Playlist::where('user_id', $userID)->get();
            foreach ($playlist as $item) {
                if ($item->id == $q->playlist_id) {
                    $selected = 'selected';
                } else {
                    $selected = '';
                }
                $html['playlist'] .= '<option value="' . $item->id . '"  ' . $selected . ' >' . $item->title . '</option>';
            }

            // Channel select option
            $channels = Channel::where('user_id', $userID)->get();
            foreach ($channels as $item) {
                if ($item->id == $q->channel_id) {
                    $selected = 'selected';
                } else {
                    $selected = '';
                }
                $html['channel'] .= '<option value="' . $item->id . '"  ' . $selected . ' >' . $item->name . '</option>';
            }

            echo json_encode($html);
        } else {
            return response()->json([
                'errors' => 'Faild to find your stream'
            ]);
        }
    }

    // Update stream data
    public function stream_update(Request $r)
    {
        $id = $r->id;
        $streaming_date = $r->streamDateTime;
        $streaming_topic = $r->streaming_topic;
        $streaming_playlist = $r->streaming_playlist;
        $streaming_channel = $r->streaming_channel;
        $streaming_description = $r->streaming_description;

        $this->validate($r, [
            'streamDateTime' => 'required',
            'streaming_topic' => 'required',
            'streaming_playlist' => 'required',
            'streaming_channel' => 'required',
            'streaming_description' => 'required',
        ]);

        try {
            $obj = LiveStream::find($id);
            $obj->streamDateTime = $streaming_date;
            $obj->topic = $streaming_topic;
            $obj->playlist_id = $streaming_playlist;
            $obj->channel_id = $streaming_channel;
            $obj->description =  $streaming_description;
            $obj->update();

            return redirect()->route('videos')->with('success', 'Live stream updated successfully');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    // Update stream row with stream Id & stream Token
    public function streamTokenUpd(Request $r)
    {
        $id = $r->id;
        $streamToken = $r->stream_token;

        try {
            $obj = LiveStream::find($id);
            $obj->stream_token = $streamToken;
            $obj->update();

            echo json_encode(['msg' => 'Stream token updated successfully']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // Join audience as public stream
    public function join_Public_Stream(Request $r)
    {
        $id = $r->streamId;
        $stream = LiveStream::where('id', $id)->with('channel')->first();
        return view('frontend.pages.audience.audience', ['stream' => $stream]);
    }

    // fetch public video info for generate share link
    public function public_stream_link()
    {
        $id = $_GET['vid'];

        $obj = LiveStream::where('id', $id)->where('stream_type', 'Public')->first();

        $link = $obj->id;

        $path = url('') . '/share_stream/' . $link;

        $fb = "https://www.facebook.com/sharer/sharer.php?u=" . $path;

        $wp = "https://api.whatsapp.com/send?text=" . $path;

        echo json_encode([
            'path' => $path,
            'fb' => $fb,
            'wp' => $wp
        ]);
    }

    public function share_stream($id)
    {
        $stream = LiveStream::where('id', $id)->where('stream_type', 'Public')->first();
        return view('frontend.pages.sharestream.singlestream', ['stream' => $stream]);
    }
}
