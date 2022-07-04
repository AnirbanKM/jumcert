<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserProfileInfo;
use Illuminate\Support\Facades\Auth;

class PersonalInfoController extends Controller
{

    public function index()
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->with('userprofile')->first();
        // dd($user);

        return view('frontend.pages.personal_info', ['user' => $user]);
    }

    public function user_info_create(Request $r)
    {
        $user_id = Auth::user()->id;

        $name = $r->name;
        $email = $r->email;

        $birthday = $r->birthday;
        $gender = $r->gender;
        $secondary_email  = $r->secondary_email;
        $phone  = $r->phone;
        $address  = $r->address;
        $file =  $r->file('profileImage');

        $validate = $this->validate($r, [
            'name' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'secondary_email' =>  'required',
            'phone' => 'required'
        ]);

        if ($r->hasFile('profileImage')) {
            $file = $r->file('profileImage');
            $fileName = time() . $file->getClientOriginalName();
            $path = $file->storeAs('jumcert', $fileName, 's3');
            $filepath = "https://jumcertstorage.s3.us-east-1.amazonaws.com/" . $path;
        } else {
            $filepath =  'public/defaultImage/user.png';
        }

        try {
            $userinfo = UserProfileInfo::updateOrCreate([
                'user_id' => Auth::user()->id,
            ], [
                'birthday' => $birthday,
                'gender' => $gender,
                'secondary_email' => $secondary_email,
                'phone' => $phone,
                'image' => $filepath,
                'address' => $address
            ]);

            $user = User::find($user_id);
            $user->name = $name;
            // $user->email = $email;
            $user->update();

            return redirect()->route('personal_info')->with('success', 'Profile created successfully');;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
