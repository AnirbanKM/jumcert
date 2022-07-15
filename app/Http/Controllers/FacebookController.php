<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function facebook_submit()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebook_callback()
    {
        $facebookUser = Socialite::driver('facebook')->user();

        $user = User::updateOrCreate([
            'facebook_id' => $facebookUser->id,
        ], [
            'name' => $facebookUser->name,
            'email' => $facebookUser->email,
            'user_role' => 0,
            'password' => Hash::make($facebookUser->getName() . '@' . $facebookUser->getId()),
            'facebook_token' => $facebookUser->token
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }
}
