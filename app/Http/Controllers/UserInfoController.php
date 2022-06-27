<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends Controller
{
    public function get_user_info()
    {
        $userId = Auth::user()->id;
        $query = User::with('userprofile')->where('id', $userId)->get();

        if ($query[0]->userprofile != null) {
            foreach ($query as $q) {

                $html['name'] = $q->name;
                $html['email'] = $q->email;
                $html['userProfileId'] = $q->userprofile->id;
                $html['birthday'] = $q->userprofile->birthday;
                $html['ugender'] = $q->userprofile->gender;
                $html['secondary_email'] = $q->userprofile->secondary_email;
                $html['phone'] = $q->userprofile->phone;
                $html['image'] = $q->userprofile->image;
                $html['address'] = $q->userprofile->address;
                $html['status'] = 200;
            }

            if ($q->userprofile->gender == "Male") {
                $selected = 'selected';
            } else {
                $selected = 'selected';
            }

            $html['gender'] = '<option value="Male" ' . $selected . ' >Male</option>';
            $html['gender'] .= '<option value="Female" ' . $selected . '>Female</option>';

            echo json_encode($html);
        } else {
            echo json_encode([
                'msg' => "Profile info not found",
                'status' => false
            ]);
        }
    }
}
