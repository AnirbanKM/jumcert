<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Frontend\Playlist;
use App\Models\Frontend\VideoUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VideoUploadController extends Controller
{
    // Video upload form function
    public function index()
    {
        $user_id = auth()->user()->id;
        $categories = Category::all();
        $playlists = Playlist::where('user_id', $user_id)->get();
        return view('frontend.pages.videoupload.video_upload', [
            'categories' => $categories,
            'playlists' => $playlists,
        ]);
    }

    // Video upload funtion
    public function video_upload_ins(Request $r)
    {
        $title = $r->title;
        $category = $r->category;
        $subcategory = $r->subcategory;
        $desc = $r->desc;

        $videoType = $r->video_type;
        $price = $r->price;

        $user_id = Auth::user()->id;
        $status = "Active";
        $video_id = rand(100000, 999999);
        $playlist = $r->playlist;

        if ($r->video_type == "Private") {
            $this->validate($r, [
                'price' => 'required'
            ]);
        } else {
            $price = 0;
        }

        $this->validate($r, [
            'video' => 'mimes:mp4,mkv,avi,wmv|max:102400',
            'thumbnail' => 'required|mimes:jpeg,jpg,png|max:2048',

            'title' => 'required',
            'subcategory' => 'required',

            'desc' => 'required|min:3|max:2000',

            'category' => 'required|exists:categories,id',
            'playlist' => 'required|exists:playlists,id',

            'video_type' => 'required',
        ]);

        // Video file
        $video =  $r->file('video');
        // Videos thumbnail
        $thumbnail =  $r->file('thumbnail');

        // Core validation & upload video file in Amazon S3
        if ($r->hasFile('video')) {
            $allowedVideoExtension = ['mp4', 'mkv', 'avi', 'wmv'];
            $extension = $video->getClientOriginalExtension();
            $checkImage = in_array($extension, $allowedVideoExtension);

            if ($checkImage == true) {
                $file = $r->file('video');
                $videoName = time() . $file->getClientOriginalName();
                $filename = pathinfo($videoName, PATHINFO_FILENAME) . rand(100000, 999999) . '.' . $extension; // Add encoding
                $path = $file->storeAs('jumcert', $filename, 's3');  // Video store in Amazon S3
                $videoLink = "https://jumcertstorage.s3.us-east-1.amazonaws.com/" . $path;
            } else {
                session()->flash('success', 'Please select a valid video format');
                return redirect()->back();
            }
        } else {
            session()->flash('success', 'Please select a valid video format');
            return redirect()->back();
        }

        // Core validation & upload image file in Amazon S3
        if ($r->hasFile('thumbnail')) {
            $allowedImageExtension = ['jpg', 'png', 'jpeg'];
            $extension = $thumbnail->getClientOriginalExtension();
            $checkImage = in_array($extension, $allowedImageExtension);

            if ($checkImage == true) {
                $file = $r->file('thumbnail');
                $thumbnailName = time() . $file->getClientOriginalName();
                $filename = pathinfo($thumbnailName, PATHINFO_FILENAME) . rand(100000, 999999) . '.' . $extension; // Add encoding
                $path = $file->storeAs('jumcert', $filename, 's3'); // Thumbnail store in Amazon S3
                $thumbnailLink = "https://jumcertstorage.s3.us-east-1.amazonaws.com/" . $path;
            } else {
                session()->flash('success', 'Please select a valid image format');
                return redirect()->back();
            }
        } else {
            session()->flash('success', 'Please select a valid image format');
            return redirect()->back();
        }

        try {
            $obj = new VideoUpload();
            // Asssing Value
            $obj->title = $title;
            $obj->category_id = $category;
            $obj->subcategory = $subcategory;
            $obj->desc = $desc;
            $obj->price = $price;
            $obj->user_id = $user_id;
            $obj->status = $status;
            $obj->video_type = $videoType;
            $obj->videoname =  $videoLink;
            $obj->thumbnail = $thumbnailLink;
            $obj->video_id = $video_id;
            $obj->playlist_id = $playlist;

            $obj->save();
            $obj->playlists()->attach($playlist);

            session()->flash('success', 'video uploaded successfully');
            return redirect()->route('videos');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // video edit function
    public function video_edit_frm()
    {
        $user_id = Auth::user()->id;
        $videos = VideoUpload::where('user_id', $user_id)->get();
        $categories = Category::all();
        $playlists = Playlist::all();
        return view('frontend.pages.videoupload.edit_video', [
            'videos' => $videos,
            'categories' => $categories,
            'playlists' => $playlists
        ]);
    }

    // fetch single video
    public function find_video()
    {
        $user_id = Auth::user()->id;
        $videoId = $_GET['videoId'];
        $query = VideoUpload::where('user_id', $user_id)->where('video_id', $videoId)->get();

        if (count($query) > 0) {
            foreach ($query as $q) {
                $html['id'] = $q->id;
                $html['title'] = $q->title;
                $html['category_id'] = $q->category_id;
                $html['video_id'] = $q->video_id;
                $html['subcategory'] = $q->subcategory;
                $html['playlist'] = $q->playlist_id;
                $html['price'] = $q->price;
                $html['desc'] = $q->desc;
                $html['success'] = 'Video details found successfully';
            }

            // Category find
            $categories = Category::all();
            $html['category'] = '<option value="">--Select Category--</option>';
            foreach ($categories as $item) {
                if ($item->id == $q->category_id) {
                    $selected = 'selected';
                } else {
                    $selected = '';
                }
                $html['category'] .= '<option value="' . $item->id . '"  ' . $selected . ' >' . $item->name . '</option>';
            }

            // Playlist find
            $playlists = Playlist::all();
            $html['playlist'] = '<option value="">--Select Playlist--</option>';
            foreach ($playlists as $item) {
                if ($item->id == $q->playlist_id) {
                    $selected = 'selected';
                } else {
                    $selected = 'xxx';
                }
                $html['playlist'] .= '<option value="' . $item->id . '"  ' . $selected . ' >' . $item->title . '</option>';
            }

            echo json_encode($html);
        } else {
            return response()->json([
                'errors' => 'Faild to find your video'
            ]);
        }
    }

    // update single video
    public function update_video(Request $r)
    {
        $id = $r->id;
        $video_id = $r->video_id; // Optional
        $title = $r->title;
        $category_id = $r->category_id;
        $subcategory = $r->subcategory;
        $playlist = $r->playlist;
        $price = $r->price;
        $desc = $r->desc;

        $validator = Validator::make($r->all(), [
            'id' => 'required|exists:video_uploads,id',
            'video_id' => 'required|exists:video_uploads,video_id',
        ]);

        try {
            $obj = VideoUpload::find($id);

            $obj->title = $title;
            $obj->category_id  = $category_id;
            $obj->subcategory  = $subcategory;
            $obj->playlist_id  = $playlist;
            $obj->price  = $price;
            $obj->desc  = $desc;
            $obj->update();

            return response()->json([
                'success' => 'video updated successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ]);
        }
    }
}
