<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function login()
    {
        return view('backend.login');
    }

    public function login_check(Request $r)
    {
        $email = $r->email;
        $password = $r->password;
        $rememderCheck = $r->rememderCheck;

        $validator = Validator::make($r->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6',
        ]);

        $remember_me  = (!empty($rememderCheck)) ? TRUE : FALSE;

        $w = array(
            'email' => $email,
            'password' => $password
        );

        $adminAuth = Auth::guard('admin')->attempt($w, $remember_me);

        if ($adminAuth) {
            return response()->json([
                'result' => $adminAuth,
                'status' => 200,
                "message" => "Admin is authenticated"
            ]);
        } else {
            return response()->json([
                'result' => $adminAuth,
                "message" => "Admin is not Unauthenticated",
                'status' => 401
            ]);
        }
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Successfully logged out');
    }
}
