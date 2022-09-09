<?php

namespace App\Http\Controllers\Stream;

use App\Http\Controllers\Controller;
use App\Models\LiveStream;
use App\Models\Stream\VideoLiveStream;
use App\Models\StreamRecorder;
use Aws\S3\S3Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StreamDashboardController extends Controller
{
    public function user_dashboard()
    {
        if (Auth::user()->role == 'host') {
            $data = VideoLiveStream::where('creater_id', Auth::user()->id)->get();
        } else {
            $data = VideoLiveStream::get();
        }

        $user = Auth::user();

        return view('frontend.pages.master_stream.dashboard', [
            'data' => $data,
            'user' => $user
        ]);
    }

    public function host_join_stream(Request $r)
    {
        $meetingId = $r->meetingId;

        try {
            // Update Stream Status
            $stream = LiveStream::where('meetingId', $meetingId)->update(['status' => 'Completed']);

            $findMeeting = LiveStream::where('meetingId', $meetingId)->get();
            return view('frontend.pages.master_stream.join_host_stream', ['findMeeting' => $findMeeting]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function audience_join_stream(Request $r)
    {
        try {

            $meetingId = $r->streamId;

            $findMeeting = LiveStream::where('meetingId', $meetingId)->get();

            $channel_owner_id = $findMeeting[0]->user_id;
            $buyer_id = auth()->user()->id;
            $stream_id = $findMeeting[0]->id;
            $roomName = substr($findMeeting[0]->roomName, 1, 36);

            $s3Client = new S3Client([
                'version' => 'latest',
                'region'  => 'us-east-1',
                'credentials' => [
                    'key'    => 'AKIA3IE3MMFQ37HUMCBV',
                    'secret' => '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'
                ]
            ]);

            $response = $s3Client->listObjects(array('Bucket' => 'jumcertstorage', 'MaxKeys' => 100000));
            $files = $response->getPath('Contents');

            foreach ($files as $file) {

                $filename = $file['Key'];

                if (substr($filename, 0, 36) == $roomName) {
                    $S3path = 'https://jumcertstorage.s3.amazonaws.com/' . $filename;
                }
            }

            $obj = new StreamRecorder();
            $obj->channel_owner_id = $channel_owner_id;
            $obj->buyer_id = $buyer_id;
            $obj->video_path = $S3path;
            $obj->stream_id = $stream_id;
            $obj->save();

            return view('frontend.pages.master_stream.join_audience_stream', ['findMeeting' => $findMeeting]);
        } catch (\Throwable $th) {
            echo $th->getMessage() . PHP_EOL;
        }
    }
}
