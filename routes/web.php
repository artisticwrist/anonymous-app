<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/verify-refferal', [MessageController::class, 'verify'])
    ->name('verify-refferal');

// Route::get('/send-message-form', [MessageController::class, 'directForm'])
//     ->name('send-message-form');

Route::get('/send-message-form', [MessageController::class, 'directForm'])
     ->name('send-message-form');

Route::get('/send-message', [MessageController::class, 'sendMessage'])
    ->name('send-message');


// Route for displaying the dashboard with messages for the logged-in user
Route::get('/dashboard', [UserController::class, 'view_user_message'])
    ->middleware(['auth', 'verified']) // Ensure the user is authenticated and email is verified
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
