<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Livewire\Auth\Login;
use App\Livewire\ClientPage\Dashboard;
use App\Livewire\LandingPage;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPage::class)->name('dashboard');

Route::middleware(['auth:web'])->group(function(){
    Route::group(['prefix' => 'clientarea', 'as' => 'clientarea'], function(){
        Route::get('/', Dashboard::class)->name('.dashboard');
    });
});

Route::get('/login', Login::class)->name('login');

Route::controller(SocialiteController::class)->group(function(){
    Route::get('/auth/google', 'googleRedirect')->name('auth.google');
    Route::get('/auth/google/callback', 'googleCallback')->name('auth.google.callback');
});