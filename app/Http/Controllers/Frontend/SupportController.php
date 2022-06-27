<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SupportController extends Controller
{
    public function index()
    {
        return view('frontend.pages.supports');
    }

    public function create(Request $r)
    {

        $validation = $this->validate($r, [
            'name' => 'required',
            'email' => 'required',
            'msg' => 'required',
        ], [
            'msg.required' => 'The message field is required.'
        ]);

        $name = $r->name;
        $email = $r->email;
        $phone = $r->phone;
        $country = $r->country;
        $msg = $r->msg;

        try {
            $mail = Mail::send(
                'email.feedback',
                ['name' => $name, 'email' =>  $email, 'comment' =>  $msg],
                function ($message) use ($name, $email) {
                    $message->from('anirbanshow@kreativemachinez.net');
                    $message->to($email, $name)->subject('Your Website Contact Form');
                }
            );

            $obj = new Support();
            $obj->name = $name;
            $obj->email = $email;
            $obj->phone = $phone;
            $obj->country = $country;
            $obj->desc  = $msg;
            $obj->save();

            return redirect()->route('supports')->with('success', 'Your feedback successfully send to the jumcert');
        } catch (\Throwable $th) {
            return redirect()->route('supports')->with('error', 'Something went wrong please try again');
            // throw $th;
        }
    }
}
