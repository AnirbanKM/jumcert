<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Frontend\VideoUpload;
use App\Http\Controllers\Controller;
use App\Models\Frontend\Channel;
use App\Models\Frontend\Playlist;
use App\Models\LiveStream;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideosController extends Controller
{
    // Video Pages all tab data getting
    public function index()
    {
        if (Auth::user()) {
            $userID = Auth::user()->id;
            $videos = VideoUpload::orderBy('id', 'desc')->with('category', 'user_info')->where('user_id', $userID)->paginate(9);
            $playlists = Playlist::where('user_id', $userID)->with('videos')->get();
            $channels = Channel::where('user_id', $userID)->get();
            $liveStreams = LiveStream::where('user_id', $userID)
                ->where('streamDateTime', '>', Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()))
                ->with('playListInfo', 'channel')
                ->orderBy('id', 'desc')->get();

            return view('frontend.pages.videoupload.videos', [
                'videos' => $videos,
                'playlists' => $playlists,
                'channels' => $channels,
                'liveStreams' => $liveStreams
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function videoLike(Request $r)
    {
        $id = $r->id;
        $uid = auth()->user()->id;

        $video = VideoUpload::find($id);
        $video->countlike = $video->countlike + 1;
        $video->checkLikeByUser = $video->checkLikeByUser . ',' . $uid;
        $video->update();

        echo json_encode([
            'status' => 'liked',
            'count' => $video->countlike
        ]);
    }

    public function videoDislike(Request $r)
    {
        $id = $r->id;
        $uid = auth()->user()->id;

        $video = VideoUpload::find($id);

        $arr = explode(",", $video->checkLikeByUser);
        $findKey = array_search($uid, $arr);
        unset($arr[$findKey]);

        $str = implode(",", $arr);

        $video->countlike = $video->countlike - 1;
        $video->checkLikeByUser = $str;
        $video->update();

        echo json_encode([
            'status' => 'disliked',
            'count' => $video->countlike
        ]);
    }
}
