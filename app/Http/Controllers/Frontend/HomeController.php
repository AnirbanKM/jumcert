<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Chat;
use App\Models\Frontend\VideoUpload;
use App\Models\LiveStream;
use App\Models\StreamRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $videos = VideoUpload::with('user_info', 'purchasedVideo')->orderBy('id', 'DESC')->paginate(9);
        return view('frontend.pages.index', ['videos' => $videos]);
    }

    public function register(Request $r)
    {
        $name = $r->name;
        $email  = $r->email;
        $password = $r->password;

        $validator = Validator::make($r->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => [
                'required',
                'min:6',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                'confirmed'
            ],
            'password_confirmation' => 'required_with:password|same:password|min:8'
        ]);

        try {
            $obj = new User();
            $obj->name = $name;
            $obj->email  = $email;
            $obj->password  = Hash::make($password);
            $obj->user_role = 0;
            $obj->save();

            return response()->json([
                'success' => 'Registered added successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }
    }

    public function login(Request $r)
    {
        $email  = $r->email;
        $password = $r->password;

        $validator = Validator::make($r->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6',
        ]);

        $w = array(
            'email' => $email,
            'password' => $password,
        );

        if (Auth::attempt($w)) {

            $uid = Auth::user()->id;
            $authUser = User::find($uid);

            if ($authUser->upgradationDate > 0) {
                if (time() - $authUser->upgradationDate > (28 * 24 * 60 * 60)) {
                    $authUser->upgradationDate = "0";
                    $authUser->user_role = 0;
                    $authUser->update();
                }
            }

            return response()->json([
                'success' => "User is authenticated",
            ]);
        } else {
            return response()->json([
                'errors' => "Wrong credential"
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->flash('success', 'Successfully logged out');
        return redirect('/');
    }

    // fetch public video info for generate share link
    public function public_video_link()
    {
        $id = $_GET['vid'];

        $obj = VideoUpload::where('id', $id)->where('video_type', 'Public')->first();

        $link = $obj->video_id;

        $path = url('') . '/watch_video/' . $link;

        $fb = "https://www.facebook.com/sharer/sharer.php?u=" . $path;

        $wp = "https://api.whatsapp.com/send?text=" . $path;

        echo json_encode([
            'path' => $path,
            'fb' => $fb,
            'wp' => $wp
        ]);
    }
}
