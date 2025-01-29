<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Middleware\LoggedInMiddleware;
use App\Livewire\Auth\Login;
use App\Livewire\ClientPage\Dashboard;
use App\Livewire\ClientPage\UploadAssets;
use App\Livewire\LandingPage;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPage::class)->name('dashboard');
Route::middleware([LoggedInMiddleware::class])->get('/login', Login::class)->name('login');

Route::middleware(['auth:web'])->group(function(){
    Route::get('/logout', function(){
        auth('web')->logout();
        return redirect()->route('login');
    })->name('logout');

    Route::group(['prefix' => 'clientarea', 'as' => 'clientarea'], function(){
        Route::get('/', Dashboard::class)->name('.dashboard');
        Route::get('/upload-assets', UploadAssets::class)->name('.upload-assets');
    });
});


Route::controller(SocialiteController::class)->group(function(){
    Route::get('/auth/google', 'googleRedirect')->name('auth.google');
    Route::get('/auth/google/callback', 'googleCallback')->name('auth.google.callback');
});