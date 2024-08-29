<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
class MessageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Display the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */
    public function create_message(Request $request)
    {

        // Validate the incoming request data
        $fields = $request->validate([
            'uid' => 'required|integer',
            'ruid' => 'required|integer',
            'message' => 'required|string|max:2000',
        ]);
    
        // Check if the receiver exists
        if (!User::where('id', $fields['ruid'])->exists()) {
            return response()->json([
                'message' => 'User doesn\'t exist'
            ], 404); // Use 404 status code for "Not Found"
        }
    
        // Create the message record
        Message::create([
            'sender_id' => $fields['uid'],
            'receiver_id' => $fields['ruid'],
            'message' => $fields['message'],
        ]);

    
        // Redirect to the dashboard with a success message
        $data = 'Message Delivered Successfully'; 

        return redirect()->route('dashboard')->with('data', $data);
    }
    

    public function verify(Request $request)
    {
        $userId = $request->query('user_id');
        
        return view('message.verify-refferal', ['userId' => $userId]);
    }



    public function directForm(Request $request)
    {
        $request->validate([
            'referral_code' => 'bail|required|string',
            'uid' => 'required|integer'
        ]);
    
        $referralCode = $request->input('referral_code');
        $userId = $request->input('uid');
    
        // Check if a user exists with the given referral code
        $referralUser = User::where('refferal_link', $referralCode)->first();
        
        if (!$referralUser) {
            // If no user found, redirect back with an error message
            return back()->with('error', 'User not found');
        }
    
        // If user exists, redirect to the next form page with user IDs
        return redirect()->route('send-message', [
            'uid' => $userId,
            'ruid' => $referralUser->id
        ]);
    }


    public function sendMessage(Request $request)
    {
        $request->validate([
            'uid' => 'bail|required|integer',
            'ruid' => 'required|integer'
        ]);
    
        $uid = $request->input('uid');
        $ruid = $request->input('ruid');
    
        return view('message.send-message-form', ['uid' => $uid, 'ruid' => $ruid]);
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function delete_message(string $id)
    {
        Message::destroy($id);

        return 'deleted successfully';
    }
}
