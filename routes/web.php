<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/chat/{user}', [ChatController::class, 'show'])->name('chat');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/messages/{user}', [ChatController::class, 'getMessages']);
    Route::post('/messages/{user}', [ChatController::class, 'sendMessage']);
});



require __DIR__.'/auth.php';
