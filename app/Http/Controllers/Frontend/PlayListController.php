<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayListController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $playlists = Playlist::where('user_id', $user_id)->get();
        return view('frontend.pages.playlist.playlist', ['playlists' => $playlists]);
    }

    public function create(Request $r)
    {
        $user_id  = Auth::user()->id;
        $title = $r->title;
        $desc = $r->desc;

        $this->validate($r, [
            'title' => 'required|unique:playlists,title',
            'image' => 'required',
            'desc' => 'required'
        ]);

        if ($r->hasFile('image')) {
            $file = $r->file('image');
            $fileName = time() . $file->getClientOriginalName();
            $path = $file->storeAs('jumcert', $fileName, 's3');
            $img_path = "https://jumcertstorage.s3.us-east-1.amazonaws.com/" . $path;
        }

        try {
            $obj = new Playlist();
            $obj->title = $title;
            $obj->user_id = $user_id;
            $obj->image = $img_path;
            $obj->desc = $desc;
            $obj->save();

            session()->flash('success', 'Playlist Created successfully');
            return redirect()->route('playlist');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(Request $r)
    {
        $id = $_GET['id'];
        $query = Playlist::where('id', $id)->get();

        if (count($query) > 0) {
            foreach ($query as $q) {
                $html['id'] = $q->id;
                $html['title'] = $q->title;
                $html['image'] = $q->image;
                $html['desc'] = $q->desc;
            }
            echo json_encode($html);
        } else {
            return redirect()->back();
        }
    }

    public function update(Request $r)
    {
        $playlistsId = $r->id;
        $title = $r->utitle;
        $desc = $r->udesc;

        $validate = $this->validate($r, [
            'utitle' => 'required',
            'udesc' => 'required'
        ]);

        try {
            if ($r->hasFile('uimage')) {
                $file = $r->file('uimage');
                $fileName = time() . $file->getClientOriginalName();
                $path = $file->storeAs('jumcert', $fileName, 's3');
                $fileLink = "https://jumcertstorage.s3.us-east-1.amazonaws.com/" . $path;

                $playlist = Playlist::find($playlistsId);
                $playlist->title = $title;
                $playlist->desc = $desc;
                $playlist->image = $fileLink;
            } else {
                $playlist = Playlist::find($playlistsId);
                $playlist->title = $title;
                $playlist->desc = $desc;
            }
            $playlist->update();

            session()->flash('success', 'Playlist updated successfully');
            return redirect()->route('playlist');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
