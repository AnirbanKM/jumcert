<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\VideoUpload;
use App\Models\PrivateVideo;
use Illuminate\Http\Request;

class StreamPlayerController extends Controller
{
    public function index()
    {
        return view('frontend.pages.stream_player');
    }

    public function watch_video($id)
    {
        $video = VideoUpload::where('video_id', $id)->with('user_info', 'user_primary_info')->first();
        return view('frontend.pages.watch.watch', ['video' => $video]);
    }

    public function watch_private_video($id)
    {
        $video = VideoUpload::where('video_id', $id)
            ->with('user_info', 'user_primary_info', 'checkPurchasedVideo')->first();

        if ($video->checkPurchasedVideo != null) {
            return view('frontend.pages.watch.watch', ['video' => $video]);
        } else {
            return redirect()->route('my_gallery')->with('error', 'Please purchase this video');
        }
    }

    public function watch_creater_video($id)
    {
        $video = VideoUpload::where('video_id', $id)
            ->where('user_id', auth()->user()->id)
            ->with('user_info', 'user_primary_info')
            ->first();
        return view('frontend.pages.watch.watch', ['video' => $video]);
    }
}
