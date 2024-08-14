<?php

namespace App\Http\Controllers;


use app\Models\User;
use app\Models\feedback;
use Illuminate\Http\Request;

class feedbackController extends Controller
{
    //
    public function sendFeedback(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'feedback' => 'required|string',
        ]);
    
        // Check if sender email exists
        $sender = User::where('email', $request->email)->first();
        if (!$sender) {
            return response()->json(['error' => 'Cant send unless you are a user. Sign up today'], 404);
        }
    
        try {
            $feedback = Feedback::create([
                'email' => $request->sender_email,
                'feedback' => $request->feedback,
            ]);
    
            // Return JSON response indicating success
            return response()->json([
                'message' => 'Feedback sent successfully',
                'email' => $feedback['email'],
                'feedback' => $feedback['feedback'],
            ], 201);
        } catch (\Exception $e) {
            // Return JSON response indicating failure
            return response()->json([
                'error' => 'Failed to send feedback',
            ], 500);
        }
    }
}
