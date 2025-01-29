<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{

    /**
     * This function will redirect user to the google authentication page
     * @params NA
     */
    public function googleRedirect(){
        return Socialite::driver('google')->redirect();
    }

    /**
     * This function for get the instance of authenticated user
     * @params NA
     */
    public function googleCallback(){
        $googleAccount = Socialite::driver('google')->stateless()->user();

        $user = User::query()->updateOrCreate([
            'google_id' => $googleAccount->id,
        ], [
            'google_id' => $googleAccount->id,
            'name' => $googleAccount->name,
            'email' =>  $googleAccount->email,
            'avatar_url' => $googleAccount->avatar
        ]);

        auth('web')->login($user);
        return redirect()->route('clientarea.dashboard');
    }
}
