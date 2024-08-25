<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\Comments;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Js;

class CommentController extends Controller
{
    //
    public function postComment(Request $request){
        $fields = $request->validate([
            'message_id' => 'bail|required|string',
            'email' => 'required|string',
            'comment' => 'required|string',
        ]);

        // Check if email already exists
        $existingUser = User::where('email', $fields['email'])->exists();
        if(!$existingUser){
            return response()->json('Email isnt a user', 201);
        }

        $existingMessage = Message::where('id', $fields['message_id'])->exists();
        if(!$existingMessage){
            return response()->json('Message doesnt exist', 201);
        }

        Comments::create([
            'message_id' => $fields['message_id'],
            'email' => $fields['email'],
            'comment' => $fields['comment'],
        ]);

        return response()->json('Comments posted successfully', 201);
        

    }

    public function viewComments(Request $request, string $id)
    {
        // Find the message by ID
        $message = Message::find($id);
    
        // Check if the message exists
        if (!$message) {
            return response()->json('Message doesn\'t exist', 404);
        }
    
        // Fetch all comments associated with the message
        $comments = Comments::where('message_id', $id)->get();
    
        // Return the comments as a JSON response
        return response()->json([
            'message' => 'successful',
            'comments' => $comments
        ], 200);
    }
}    
