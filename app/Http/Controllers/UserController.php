<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Message;

class UserController extends Controller
{
    public function view_user_message(Request $request)
    {
        // Get the currently logged-in user
        $user = Auth::user();
        
        // Check if the user exists
        if (!$user) {
            return redirect()->route('dashboard')->withErrors([
                'message' => 'User not found',
            ]);
        }
        
        $messages = $user->receivedMessages; 

        $data = $request->get('data');
        
        return view('dashboard', compact('messages', 'data'));

    }

    public function showFullMessage(Request $request)
    {
        $msgid = $request->query('msgid');
        $data = Message::find($msgid); 

        return view('message.view-full-message', compact('data'));

    }


    public function getMessageById(Request $request)
    {
        $msgid = $request->query('msgid');

        return redirect()->route('showFullMessage', ['msgid' => $msgid]);
    }

    public function viewForm(Request $request){
        $data = $request->query('data');
        return view('message.send-message-form', compact('data'));
    }

}
