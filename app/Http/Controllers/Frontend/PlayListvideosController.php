<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Playlist;
use App\Models\Frontend\VideoUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayListvideosController extends Controller
{
    public function index($id)
    {
        $userID = Auth::user()->id;
        $playlist = Playlist::where('user_id', $userID)->where('id', $id)->with('videos')->first();
        $videos = VideoUpload::where('user_id', $userID)->where('playlist_id', $id)->get();

        return view('frontend.pages.playlist.videos', [
            'playlist' => $playlist,
            'videos' => $videos
        ]);
    }
}
