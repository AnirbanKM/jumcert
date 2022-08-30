<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function send_reset_password_email(Request $r)
    {
        $email = $r->email;

        try {
            // Check user's email exists or not
            $user = User::where('email', '=', $r->email)->first();

            if ($user !== null) {

                // Check if user email address already exists in passwordreset table
                $checkEmail = PasswordReset::where('email', '=', $r->email)->get();

                if (count($checkEmail) > 0) {

                    $html['msg'] = 'Password reset email already send, check your email';
                    $html['status'] = "success";
                    $html['code'] = 200;
                    echo json_encode($html);
                } else {

                    // Generate Token
                    $token = Str::random(60);

                    // Sending Email with pasword reset view
                    $mailSend = Mail::send('email.reset_link', ['token' => $token], function (Message $message) use ($email) {
                        $message->subject('Reset your password');
                        $message->to($email);
                    });

                    // Saving data to the password reset table
                    PasswordReset::create([
                        'email' => $r->email,
                        'token' => $token,
                        'created_at' => Carbon::now()
                    ]);

                    $html['msg'] = 'Password reset email sent successfully, check your email';
                    $html['status'] = "success";
                    $html['code'] = 200;

                    echo json_encode($html);
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }

        // return response()->json([
        //     'msg' => 'Provided credentials are incorrect. Please try again',
        //     'status' => 'error',
        // ]);
    }

    public function reset($token)
    {
        return view('email.reset_password', ['token' => $token]);
    }

    public function reset_password(Request $r)
    {
        $r->validate([
            'password' => 'required',
        ]);

        $passwordreset = PasswordReset::where('token', $r->emailtoken)->first();

        if ($passwordreset == null) {

            return redirect()->route('home')->with('error', 'Token is invalid or expired');
        }

        $user = User::where('email', $passwordreset->email)->first();
        $user->password = Hash::make($r->password);
        $user->save();


        //Delete the token after resetting the password
        $deleteToken = PasswordReset::where('email', $user->email)->delete();
        return redirect()->route('home')->with('success', 'Password changed successfully');
    }
}
