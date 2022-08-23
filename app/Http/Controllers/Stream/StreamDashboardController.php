<?php

namespace App\Http\Controllers\Stream;

use App\Http\Controllers\Controller;
use App\Models\LiveStream;
use App\Models\Stream\VideoLiveStream;
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
        $findMeeting = LiveStream::where('meetingId', $meetingId)->get();
        return view('frontend.pages.master_stream.join_host_stream', ['findMeeting' => $findMeeting]);
    }

    public function audience_join_stream(Request $r)
    {
        $meetingId = $r->streamId;
        $findMeeting = LiveStream::where('meetingId', $meetingId)->get();
        return view('frontend.pages.master_stream.join_audience_stream', ['findMeeting' => $findMeeting]);
    }
}
