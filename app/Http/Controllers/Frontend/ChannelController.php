<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Channel;
use App\Models\Frontend\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChannelController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $channels = Channel::where('user_id', $user_id)->get();
        $playlists = Playlist::where('user_id', $user_id)->get();
        return view('frontend.pages.channel.channel', [
            'channels' => $channels,
            'playlists' => $playlists
        ]);
    }

    public function store(Request $r)
    {

        $validate =  $this->validate($r, [
            'name' => 'required|unique:channels,name',
            'desc' => 'required',
            'channel_Image' => 'required|mimes:jpeg,jpg,png,gif|max:3000',
        ]);

        $user_id = auth()->user()->id;
        $playlist_id  = 0;
        $title = $r->name;
        $slugUrl = $r->slug;
        $desc = $r->desc;

        if (auth()->user()->user_role == 1) {
            $slug = uniqid();
        } else if (auth()->user()->user_role == 2) {
            $slug = Str::slug($slugUrl, '_');
        } else {
            $slug = uniqid();
        }

        if ($r->hasFile('channel_Image')) {
            $file = $r->file('channel_Image');
            $fileName = time() . $file->getClientOriginalName();
            $path = $file->storeAs('jumcert', $fileName, 's3');
            $fileLink = "https://jumcertstorage.s3.us-east-1.amazonaws.com/" . $path;
        }

        try {
            $obj = new Channel();
            $obj->name = $title;
            $obj->image = $fileLink;
            $obj->slug  = $slug;
            $obj->desc  = $desc;
            $obj->user_id = $user_id;
            $obj->playlist_id = $playlist_id;
            $obj->save();
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('channel')->with('success', 'Channel Created Successfully');
    }

    public function edit(Request $r)
    {
        $id = $_GET['id'];
        $query = Channel::where('id', $id)->get();

        if (count($query) > 0) {
            foreach ($query as $q) {
                $html['id'] = $q->id;
                $html['name'] = $q->name;
                $html['image'] = $q->image;
                $html['desc'] = $q->desc;
            }
            echo json_encode($html);
        } else {
            $html['msg'] = 'Something went wrong plz try again';
            echo json_encode($html);
        }
    }

    public function update(Request $r)
    {
        $channelId = $r->id;
        $user_id  = Auth::user()->id;
        $name = $r->cname;
        $desc = $r->cdesc;

        $validate = $this->validate($r, [
            'cname' => 'required',
            'cimage' => 'image',
            'cdesc' => 'required'
        ]);

        if ($r->hasFile('cimage')) {
            $file = $r->file('cimage');
            $fileName = time() . $file->getClientOriginalName();
            $path = $file->storeAs('jumcert', $fileName, 's3');
            $fileLink = "https://jumcertstorage.s3.us-east-1.amazonaws.com/" . $path;

            try {
                $channel = Channel::find($channelId);
                $channel->name = $name;
                $channel->desc = $desc;
                $channel->image = $fileLink;
                $channel->update();

                session()->flash('success', 'Playlist updated successfully');
                return redirect()->route('channel');
            } catch (\Throwable $th) {
                throw $th;
            }
        } else {
            try {
                $channel = Channel::find($channelId);
                $channel->name = $name;
                $channel->desc = $desc;
                $channel->update();

                session()->flash('success', 'Playlist updated successfully');
                return redirect()->route('channel');
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }

    public function channel_playlist_create(Request $r)
    {
        $id = $r->id;
        $playlist = implode(",", $r->playlistId);

        try {
            $obj = Channel::find($id);
            $obj->playlist_id = $playlist;
            $obj->update();

            session()->flash('success', 'Playlist added successfully');
            return redirect()->route('channel');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function search_channel_result(Request $r)
    {
        $searchTerm = $r->cname;

        $obj = Channel::where('name', 'LIKE', "%{$searchTerm}%")
            ->orWhere('slug', 'LIKE', "%{$searchTerm}%")->get();

        return view('frontend.pages.search.channel', ['channels' => $obj]);
    }
}
