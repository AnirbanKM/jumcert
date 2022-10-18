<?php

namespace App\Http\Controllers;

use App\Models\LiveStream;
use Illuminate\Http\Request;
use Carbon\Carbon;

// This Live-Stream-Controller only for live stream creation & CRON Job

class LiveStreamController extends Controller
{
    public function create(Request $r)
    {
        $streaming_dateTime = $r->streamDateTime;
        $streaming_topic = $r->streaming_topic;
        $streaming_playlist = $r->streaming_playlist;
        $streaming_channel = $r->streaming_channel;
        $streaming_description = $r->streaming_description;
        $price = $r->price;
        $stream_type = $r->stream_type;

        if (Carbon::parse($streaming_dateTime) < Carbon::now()) {
            return redirect()->route('videos')->with('error', 'Please select valid date!!!');
        } else {
            // stream thumbnail
            $thumbnail =  $r->file('thumbnail');

            if ($r->stream_type == "Private") {
                $this->validate($r, [
                    'price' => 'required'
                ]);
            } else {
                $price = 0;
            }

            $this->validate($r, [
                'streamDateTime' => 'required',
                'streaming_topic' => 'required|unique:live_streams,topic',
                'streaming_playlist' => 'required',
                'streaming_channel' => 'required',
                'streaming_description' => 'required',
                'stream_type' => 'required'
            ]);

            if ($r->hasFile('thumbnail')) {
                $allowedImageExtension = ['jpg', 'png', 'jpeg', 'webp'];
                $extension = $thumbnail->getClientOriginalExtension();

                $checkImage = in_array($extension, $allowedImageExtension);

                if ($checkImage == 1) {
                    $file = $r->file('thumbnail');
                    $thumbnailName = time() . $file->getClientOriginalName();

                    $path = $file->storeAs('jumcert', $thumbnailName, 's3'); // Thumbnail store in Amazon S3
                    $thumbnailLink = "https://jumcertstorage.s3.us-east-1.amazonaws.com/" . $path;
                } else {
                    session()->flash('error', 'Please select a valid image format !!!');
                    return redirect()->back()->with('streamErr', 'active show');
                }
            } else {
                $thumbnailLink = "https://jumcert.com/user.png";
            }

            try {
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

                $obj = new LiveStream();
                $obj->streamDateTime = $streaming_dateTime;
                $obj->topic = $streaming_topic;
                $obj->playlist_id = $streaming_playlist;
                $obj->channel_id = $streaming_channel;
                $obj->description =  $streaming_description;
                $obj->user_id = auth()->user()->id;
                $obj->role = 'host';
                $obj->price = $price;
                $obj->stream_type = $stream_type;
                $obj->thumbnail = $thumbnailLink;
                $obj->roomName = $data->roomName;
                $obj->meetingId = $data->meetingId;
                $obj->hostRoomUrl = $data->hostRoomUrl;
                $obj->audienceRoomUrl = $data->roomUrl;
                $obj->save();

                return redirect()->route('videos')->with('success', 'Live stream added successfully');
            } catch (\Throwable $th) {
                dd($th);
            }
        }
    }
}
