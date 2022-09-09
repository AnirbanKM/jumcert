<?php

namespace App\Http\Controllers;

use App\Models\LiveStream;
use App\Models\StreamRecorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StreamRecorderController extends Controller
{

    public function getResource()
    {
        $cname = $_GET['cname'];
        $uid = $_GET['uid'];

        $authorizationField = 'Basic NzZmNGJkMDkxN2E2NDVmMWFhMzA4ODQ3YjEyZjc0Y2M6MWJmYTgxOGJhYjkwNGZjNjg0NjcwNjk5NzY3ZmRkMjg=';

        $data = [
            'cname' =>  strval($cname),
            'uid' =>  strval($uid),
            "clientRequest" => [],
        ];

        $data = str_replace('[]', '{}', json_encode($data));

        $getResourceId = Http::withBody($data, 'application/json')
            ->withHeaders(['Authorization' => $authorizationField])
            ->post('https://api.agora.io/v1/apps/73360382719943c6a12d1602e673eb8f/cloud_recording/acquire');

        $getResourceResp = $getResourceId->json();

        $masterID = $getResourceResp['resourceId'];
        echo json_encode(['masterID' => $masterID]);
    }

    public function streamRecordIns(Request $r)
    {
        $streamId = $r->streamId;
        $streamlink = $r->streamlink;
        $user_id = auth()->user()->id;

        $awsS3Link = "https://jumcertstorage.s3.amazonaws.com/" . $streamlink;

        try {
            $streamInfo = LiveStream::find($streamId);

            $streamRecorderObj = new StreamRecorder();
            $streamRecorderObj->channel_owner_id = $streamInfo->user_id;
            $streamRecorderObj->buyer_id = $user_id;
            $streamRecorderObj->video_path = $awsS3Link;
            $streamRecorderObj->stream_id = $streamId;
            $streamRecorderObj->save();

            return response()->json([
                'msg' => 'Record has been created successfully',
                'status' => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Record creation failed',
                'status' => 404,
                'error' => $th
            ]);
        }
    }

    public function fetchStreamVideos()
    {
        $user_id = auth()->user()->id;

        $stream_videos = StreamRecorder::where('channel_owner_id', $user_id)
            ->orWhere('buyer_id', $user_id)
            ->with('streamInfo')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.pages.recording.streamed_vidoes', ['streamVideos' => $stream_videos]);
    }

    public function watchStream($recorded_stream_id)
    {
        $id = $recorded_stream_id;

        $recordedStreamObj = StreamRecorder::where('id', $id)
            ->with('streamInfo', 'channerOwnerInfo')
            ->first();

        return view('frontend.pages.recording.watch_stream', ['recordedStreamObj' => $recordedStreamObj]);
    }
}
