<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::group([
    'as' => 'dashboard.',
    'prefix' => 'dashboard/',
    'middleware' => ['auth:web', 'verified'],
], function () {
    Route::resource('posts', PostController::class);
    Route::get('profile', function () {
        return view('dashboard.profile.user-profile-information');
    })->name('profile.info');

    Route::get('settings', function () {
        return view('dashboard.profile.settings');
    })->name('profile.settings');

    Route::get('profile/update-password', function () {
        return view('auth.user-password');
    })->name('profile.update-password');

    Route::delete('profile/{user}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
