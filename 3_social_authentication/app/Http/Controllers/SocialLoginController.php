<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Socialite;

use App\User;

class SocialLoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();

        $existingUser = User::where('provider_id', $user->id)->first();

        if (! $existingUser) {
            auth()->login(User::create([
                'provider' => 'google',
                'provider_id' => $user->id,
                'email' => $user->email,
            ]));

            return view('home');
        }

        auth()->login($existingUser);

        return view('welcome');
    }
}
