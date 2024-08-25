<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Message;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// // Authentication System
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);
Route::post('/feedback', [FeedbackController::class, 'sendFeedback']);

// Protected Routes 
Route::group(['middleware' => ['auth:sanctum']], function (){

    // user dashboard
    Route::post('/messages', [MessageController::class, 'send_user_message']);
    Route::get('/view_messages', [MessageController::class, 'view_messages']);
    Route::delete('/messages/{id}', [MessageController::class, 'delete_message']);

    // Comments
    Route::post('/post_comment', [CommentController::class, 'postComment']);
    Route::get('/view_comments/{id}', [CommentController::class, 'viewComments']);

    // Protected admin routes
    Route::get('/view_all_users', [AdminController::class, 'view_all_users']);
    Route::get('/search_user/{id}', [AdminController::class, 'search_user']);
    Route::delete('/delete_user/{id}', [AdminController::class, 'delete_user']);
});


// ADMIN ROUTES
Route::get('/view_all_messages', [AdminController::class, 'view_all_messages']);
// Route::post('/register_admin', [AdminAuthController::class, 'register_admin']);
// Route::post('/login_admin', [AdminAuthController::class, 'login_admin']);
