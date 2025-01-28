<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    }
}
