<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::prefix('dashboard/')->middleware('auth:web')->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('home');
    Route::get('profile', function () {
        return view('profile.user-profile-information');
    })->name('dashboard.profile.info');
    Route::get('settings', function () {
        return view('profile.settings');
    })->name('dashboard.profile.settings');
    Route::get('profile/update-password', function () {
        return view('auth.user-password');
    })->name('dashboard.profile.update-password');
});
