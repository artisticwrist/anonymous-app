<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Message;

class UserController extends Controller
{
    public function view_user_message()
    {
        // Get the currently logged-in user
        $user = Auth::user();
        
        // Check if the user exists
        if (!$user) {
            return redirect()->route('dashboard')->withErrors([
                'message' => 'User not found',
            ]);
        }
        
        // Retrieve messages for the user
        $messages = $user->receivedMessages; // Use property access
        
        // Pass messages to the view
        return view('dashboard', ['messages' => $messages]);
    }
    
}
