<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;



Route::post('/feedback', [FeedbackController::class, 'sendFeedback'])->name('feedback.send');
Route::get('/view_comments/{id}', [CommentController::class, 'viewComments'])->name('comment.view');



// Protected Routes (requires auth via Sanctum)
Route::group(['middleware' => ['auth:sanctum']], function () {

    // TESTED ROUTES
    Route::post('/messages', [MessageController::class, 'send_message'])->name('send_message.send');
    Route::get('/user/{id}/messages', [UserController::class, 'view_user_message'])->name('user.messages.view');
    Route::delete('/messages/{id}', [MessageController::class, 'delete_message'])->name('messages.delete');

    // Comment routes
    Route::post('/post_comment', [CommentController::class, 'postComment'])->name('comment.post');

    


    
    // Admin routes
    Route::get('/view_all_users', [AdminController::class, 'view_all_users'])->name('admin.users.view');
    Route::get('/search_user/{id}', [AdminController::class, 'search_user'])->name('admin.user.search');
    Route::delete('/delete_user/{id}', [AdminController::class, 'delete_user'])->name('admin.user.delete');
});

// Publicly accessible admin route
Route::get('/view_all_messages', [AdminController::class, 'view_all_messages'])->name('admin.messages.view');
