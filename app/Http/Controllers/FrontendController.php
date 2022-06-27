<?php

namespace App\Http\Controllers;

use App\Models\Frontend\Channel;
use App\Models\Frontend\Playlist;
use App\Models\Frontend\VideoUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function channel($slug)
    {
        // Frontend Videos
        $videos = Channel::join('video_uploads', 'video_uploads.user_id', '=', 'channels.user_id')
            ->where('slug', $slug)
            ->with('purchasedVideo')
            ->get(['channels.*', 'video_uploads.*']);

        // Frontend Playlist related to the slug
        $query = Channel::where('slug', $slug)->get();
        $playlistId =  $query[0]->playlist_id;
        $playlistArr = explode(",", $playlistId);
        $playlists = Playlist::whereIn('id', $playlistArr)->get();

        // Frontend Channel Owner Info
        $userinfo = Channel::join('user_profile_infos', 'user_profile_infos.user_id', '=', 'channels.user_id')
            ->where('slug', $slug)
            ->get(['user_profile_infos.*']);

        // Frontend Channel related to the slug
        $channel = Channel::where('slug', $slug)->first();
        $user_id = $channel->user_id;
        $channels =  Channel::where('user_id', $user_id)->get();

        return view('frontend.pages.frontend_channel.channel', [
            'videos' => $videos,
            'playlists' => $playlists,
            'query' => $query,
            'userinfo' => $userinfo,
            'channel' => $channel,
            'channels' => $channels
        ]);
    }

    public function channel_playlist($slug, $pid)
    {
        $channel = Channel::where('slug', $slug)->first();
        $playlist = Playlist::where('id', $pid)->first();
        $videos = VideoUpload::where('playlist_id', $pid)->with('purchasedVideo')->get();

        return view('frontend.pages.frontend_channel.playlist_videos', [
            'playlist' => $playlist,
            'videos' => $videos,
            'channel' => $channel
        ]);
    }

    public function category_video($id, $name)
    {
        $videos = VideoUpload::where('category_id', $id)->with('user_info', 'purchasedVideo')->get();
        return view('frontend.pages.categoryvideo.categoryvideo', ['videos' => $videos]);
    }
}
