<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use App\Models\Message;


class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
public function view_user_message(Request $request)
{
    // Retrieve the user by the provided ID
    $user = User::find($request->id);

    // Check if the user exists
    if (!$user) {
        return response()->json([
            'message' => 'User not found',
        ], 404);
    }

    // Retrieve all messages where the user is the receiver
    $messages = $user->receivedMessages;

    // foreach ($messages as $message) {
    //     echo $message->content;
    // }


    // Return JSON response with the list of messages
    return response()->json([
        'message' => 'successful',
        'messages' => $messages
    ]);
}

    


}
