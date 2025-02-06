<?php

use App\Actions\Auth\Socialite\SocialiteCallback;
use App\Actions\Auth\Socialite\SocialiteRedirect;
use App\Actions\Pages\WelcomePage;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomePage::class)->name('pages.welcome');

Route::prefix('/auth')->group(function () {
    Route::get('/redirect/{driver}', SocialiteRedirect::class)->name('auth.redirect');
    Route::get('/callback/{driver}', SocialiteCallback::class)->name('auth.callback');
});

