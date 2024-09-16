<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;

class FeedbackController extends Controller
{

    public function feedback(Request $request){
        $data = $request->get('data');
        return view('feedback', compact('data'));
    }

    public function sendFeedback(Request $request)
    {
        // Validate the input fields
        $fields = $request->validate([
            'email' => 'required|email',
            'feedback' => 'required|string',
        ]);

        // Check if sender email exists in the users table
        $sender = User::where('email', $fields['email'])->first();
        if (!$sender) {
            return response()->json(['error' => 'Cannot send feedback unless you are a registered user. Sign up today.'], 404);
        }

        // Create a new feedback record
        try {
            $feedback = Feedback::create([
                'email' => $fields['email'],
                'feedback' => $fields['feedback'],
            ]);

            // Send the feedback confirmation email
            Mail::to($fields['email'])->queue(new FeedbackMail($feedback));

            // Return JSON response indicating success
            // return response()->json([
            //     'message' => 'Feedback sent successfully',
            //     'email' => $feedback->email,
            //     'feedback' => $feedback->feedback,
            // ], 201);

            $data = 'Feedback Delivered Successfully'; 
            return redirect()->route('feedback', ['data' => $data]);

        } catch (\Exception $e) {
            // Return JSON response indicating failure
            return response()->json([
                'error' => 'Failed to send feedback',
                'message' => $e->getMessage(),
            ], 500);
        }


    }

    
}
