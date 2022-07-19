<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function google_submit()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::updateOrCreate([
                'email' => $googleUser->email,
            ], [
                'google_id' => $googleUser->id,
                'name' => $googleUser->name,
                'user_role' => 0,
                'password' => Hash::make($googleUser->getName() . '@' . $googleUser->getId()),
                'google_token' => $googleUser->token
            ]);

            Auth::login($user);

            return redirect()->route('home')->with('success', 'successfully logged in with facebook');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('home')->with('error', 'something went wrong, please try again later');
        }
    }
}
