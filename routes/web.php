<?php

use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(SocialiteController::class)->group(function(){
    Route::get('/auth/google', 'googleRedirect')->name('auth.google');
    Route::get('/auth/google/callback', 'googleCallback')->name('auth.google.callback');
});