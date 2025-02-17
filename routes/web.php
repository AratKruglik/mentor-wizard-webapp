<?php

use App\Actions\Pages\Profile\DestroyProfile;
use App\Actions\Pages\Profile\GetProfilePage;
use App\Actions\Pages\Profile\UpdateProfile;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('pages.welcome');



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('pages.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', GetProfilePage::class)->name('profile.edit');
    Route::patch('/profile', UpdateProfile::class)->name('profile.update');
    Route::delete('/profile', DestroyProfile::class)->name('profile.destroy');
});

require __DIR__.'/auth.php';
