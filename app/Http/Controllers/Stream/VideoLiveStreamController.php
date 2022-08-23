<?php

namespace App\Http\Controllers\Stream;

use App\Http\Controllers\Controller;
use App\Models\Stream\VideoLiveStream;
use Illuminate\Http\Request;

class VideoLiveStreamController extends Controller
{
    public function create_meeting(Request $r)
    {
        $api_key = env('WHEREBY_TOKEN');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.whereby.dev/v1/meetings');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            '{
          "endDate": "2099-02-18T14:23:00.000Z",
          "fields": ["hostRoomUrl"]}'
        );

        $headers = [
            'Authorization: Bearer ' . $api_key,
            'Content-Type: application/json'
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $data = json_decode($response);

        $html['creater_id'] = auth()->user()->id;
        $html['start_date'] = $data->startDate;
        $html['end_date'] = $data->endDate;
        $html['roomName'] = $data->roomName;
        $html['roomUrl'] = $data->roomUrl;
        $html['meetingId'] = $data->meetingId;
        $html['hostRoomUrl'] = $data->hostRoomUrl;

        $obj = VideoLiveStream::create($html);
        return redirect()->route('user_dashboard');
    }
}
