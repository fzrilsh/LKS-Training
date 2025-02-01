<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Middleware\LoggedInMiddleware;
use App\Livewire\Auth\Login;
use App\Livewire\ClientPage\Dashboard;
use App\Livewire\ClientPage\PublishModule;
use App\Livewire\ClientPage\UploadAssets;
use App\Livewire\LandingPage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', LandingPage::class)->name('dashboard');
Route::middleware([LoggedInMiddleware::class])->get('/login', Login::class)->name('login');

Route::middleware(['auth:web'])->group(function () {
    Route::get('/logout', function () {
        auth('web')->logout();

        return redirect()->route('login');
    })->name('logout');

    Route::group(['prefix' => 'clientarea', 'as' => 'clientarea'], function () {
        Route::get('/', Dashboard::class)->name('.dashboard');
        Route::get('/upload-assets', UploadAssets::class)->name('.upload-assets');
        Route::get('/publish-module', PublishModule::class)->name('.publish-module');
    });
});

Route::controller(SocialiteController::class)->group(function () {
    Route::get('/auth/google', 'googleRedirect')->name('auth.google');
    Route::get('/auth/google/callback', 'googleCallback')->name('auth.google.callback');
});

Route::get('/user-{path?}', function ($path = '') {
    $file = Storage::get($path);
    if (! $file) {
        abort(404, 'File not found.');
    }
    $filePath = Storage::path($path);

    if (str_ends_with($path, '.php')) {

        $disallowedFunctions = ['phpinfo', 'system', 'exec', 'shell_exec', 'passthru', 'eval'];
        foreach ($disallowedFunctions as $function) {
            if (stripos($file, $function.'(') !== false) {
                abort(403, 'File contains disallowed function.');
            }
        }

        ob_start();
        include $filePath;
        $output = ob_get_clean();

        return response($output);
    }

    return response()->file($filePath, [
        'Content-Type' => 'text/html',
    ]);
})->where('path', '.*')->name('user-assets');
