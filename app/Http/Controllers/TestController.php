<?php

namespace App\Http\Controllers;

use App\Models\Frontend\VideoUpload;
use App\Models\PrivateVideo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test()
    {
        $user_id = auth()->user()->id;

        $owner_videos = VideoUpload::join('private_videos', 'video_uploads.id', '=', 'private_videos.video_id')
            ->where('video_uploads.user_id', $user_id)
            ->get();

        // $owner_videos = VideoUpload::where('video_uploads.user_id', $user_id)
        //     ->with('purchasedVideo')
        //     ->groupBy('private_videos.video_id')
        //     ->get(DB::raw('sum(video_uploads.price) as price'));

        // $q = PrivateVideo::with('video')
        //     ->whereRelation('video', 'user_id', '=', $user_id)
        //     ->groupBy('video_id')
        //     ->get();

        // dd($q);

        return view('test', ['owner_videos' => $owner_videos]);
    }
}
