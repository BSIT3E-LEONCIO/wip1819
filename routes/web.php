<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

use App\Http\Controllers\MusicController;
Route::get('/music', [MusicController::class, 'index'])->middleware(['auth'])->name('music');
Route::post('/music', [MusicController::class, 'post'])->middleware(['auth'])->name('music.post');
Route::delete('/music/{playlist}', [MusicController::class, 'delete'])->middleware(['auth'])->name('music.delete');

require __DIR__.'/auth.php';
