<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Channel;
use App\Models\Frontend\Playlist;
use App\Models\Frontend\VideoUpload;
use App\Models\LiveStream;
use App\Models\User;
use Illuminate\Http\Request;

class AdminVideoController extends Controller
{
    public function user_video()
    {
        $videos = VideoUpload::with('user_info')->orderBy('created_at', 'DESC')->paginate(12);
        return view('backend.pages.user_uploaded_video', ['videos' => $videos]);
    }

    public function play_video($id)
    {
        $video = VideoUpload::where('id', $id)->with('category', 'playlists')->first();
        return view('backend.pages.playvideo', ['video' => $video]);
    }

    public function video_status_update()
    {
        $id = $_GET['id'];
        $status = $_GET['status'];

        if ($status == "Active") {
            $updateStatus = "Inactive";
        } else {
            $updateStatus = "Active";
        }

        $video = VideoUpload::find($id);

        $video->status = $updateStatus;
        $video->update();

        $html['vstatus'] = $video->status;

        echo json_encode($html);
    }

    public function user_channel()
    {
        $channels = Channel::with('user_info', 'user_primary')->orderBy('created_at', 'DESC')->paginate(12);
        return view('backend.pages.channel', ['channels' => $channels]);
    }

    public function user_playlist()
    {
        $playlists = Playlist::with('frontendVideos', 'user_info')->orderBy('created_at', 'DESC')->paginate(12);
        return view('backend.pages.playlist', ['playlists' => $playlists]);
    }

    public function all_user()
    {
        $users = User::with('userprofile')->orderBy('created_at', 'DESC')->get();
        return view('backend.pages.users', ['users' => $users]);
    }

    public function user_info($id)
    {
        $user = User::where('id', $id)->with('userprofile')->first();

        $videos = VideoUpload::orderBy('id', 'desc')->where('user_id', $id)->with('category')->paginate(12);
        $playlists = Playlist::orderBy('id', 'desc')->where('user_id', $id)->with('frontendVideos')->paginate(12);
        $channels = Channel::where('user_id', $id)->paginate(12);
        $liveStreams = LiveStream::where('user_id', $id)->orderBy('id', 'desc')->paginate(12);

        return view('backend.pages.userinfo', [
            'user' => $user,
            'videos' => $videos,
            'playlists' => $playlists,
            'channels' => $channels,
            'liveStreams' => $liveStreams
        ]);
    }

    public function playlist_videos($pid)
    {
        $videos = VideoUpload::where('playlist_id', $pid)->get();
        return view('backend.pages.playlistVideos', ['videos' => $videos]);
    }
}
