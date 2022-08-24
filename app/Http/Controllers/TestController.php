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
            ->get([
                'private_videos.payment_id',
                'private_videos.user_id',
                'private_videos.created_at',
                'video_uploads.*'
            ]);

        dd($owner_videos);

        return view('test', ['owner_videos' => $owner_videos]);
    }
}
