<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/home');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::get('/home', App\Livewire\Home\Index::class)->name('home');

// Make sure this route exists
Route::get('/film/{slug}', \App\Livewire\Home\Show::class)->name('film.show');

Route::get('/adminpanel', function(){
    return redirect('/admin');
})->name('adminpanel');

require __DIR__.'/auth.php';
