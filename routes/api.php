<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Models\Message;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Authentication System
Route::POST('/register', [AuthController::class, 'register']);
Route::POST('/login', [AuthController::class, 'login']);


// Protected Routes 
Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::GET('/messages', [MessageController::class, 'show_messages']);
    Route::POST('/messages', [MessageController::class, 'send_message']);
    Route::DELETE('/messages/{id}', [MessageController::class, 'delete_message']);
});


