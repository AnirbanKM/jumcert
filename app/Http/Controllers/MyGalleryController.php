<?php

namespace App\Http\Controllers;

use App\Models\Frontend\PrivateStream;
use App\Models\PrivateVideo;
use Illuminate\Http\Request;

class MyGalleryController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $videos = PrivateVideo::where('user_id', $user_id)->with('video')->get();
        $streams = PrivateStream::where('buyer_id', $user_id)->with('channel', 'stream')->get();

        return view('frontend.pages.gallery.gallery', [
            'videos' => $videos,
            'streams' => $streams,
        ]);
    }
}
