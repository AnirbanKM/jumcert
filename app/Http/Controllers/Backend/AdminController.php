<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Frontend\VideoUpload;
use App\Models\LiveStream;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $admin = Auth::user();
        $allUsers = User::all();
        $freeUser = User::where('user_role', 0)->get();
        $proUser = User::where('user_role', 1)->get();
        $businessUser = User::where('user_role', 2)->get();
        $videos = VideoUpload::all();
        $liveStreams = LiveStream::all();
        $completedLiveStreams = LiveStream::where('status', 'Completed')->get();
        $pendingLiveStreams = LiveStream::where('status', 'Pending')->get();
        $cancelledLiveStreams = LiveStream::where('status', 'Cancelled')->get();
        $streamingLiveStreams = LiveStream::where('status', 'Streaming')->get();

        return view('backend.pages.dashboard', [
            'admin' => $admin,

            'allUsers' => $allUsers,
            'freeUser' => $freeUser,
            'proUser' => $proUser,
            'businessUser' => $businessUser,

            'videos' => $videos,

            'liveStreams' => $liveStreams,
            'completedLiveStreams' => $completedLiveStreams,
            'pendingLiveStreams' => $pendingLiveStreams,
            'cancelledLiveStreams' => $cancelledLiveStreams,
            'streamingLiveStreams' => $streamingLiveStreams,
        ]);
    }

    public function view_profile()
    {
        $admin = Admin::first();
        return view('backend.pages.profile.profile', ['admin' => $admin]);
    }

    public function get_admin_info()
    {
        $id = $_GET['id'];
        $admin = Admin::find($id);
        echo json_encode($admin);
    }

    public function update_admin_info(Request $r)
    {
        $id = $r->id;
        $email = $r->email;
        $pno = $r->pno;
        $name = $r->name;
        $address = $r->address;

        $admin = Admin::find($id);
        $admin->name = $name;
        $admin->email = $email;
        $admin->phone_no = $pno;
        $admin->address = $address;
        $admin->update();

        return redirect()->route('admin.view_profile')->with('success', 'Your Profile Updated Successfully');
    }

    public function admin_settings()
    {
        $admin = Admin::first();
        return view('backend.pages.profile.settings', ['admin' => $admin]);
    }

    public function admin_pass_upd(Request $r)
    {
        $id = $r->id;
        $current_password = $r->current_password;
        $password = $r->password;

        $this->validate($r, [
            'password' => ['required', 'min:8'],
            'cpassword' => ['required_with:password|same:password'],
        ]);

        $obj = Admin::find($id);

        $hashedPassword = $obj->password;
        if (Hash::check($current_password, $hashedPassword)) {

            $obj->password  = Hash::make($password);
            $obj->update();

            return redirect()->route('admin.admin_settings')->with('success', 'Your password updated successfully');
        } else {
            return redirect()->route('admin.admin_settings')->with('error', 'Your current password is not matching');
        }
    }
}


// $2y$10$66/3UT71WRLQG8RXxTKLbOWDY/ofE9s/o2rpHiL1D9HX12hZNNWiK
