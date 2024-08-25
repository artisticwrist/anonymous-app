<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function view_user_message()
    {
        return Message::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Display the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */
    public function send_message(Request $request)
    {
        $fields = $request->validate([
            'sender_id'=>'required',
            'reciever_id'=>'required',
            'message'=>'required',
        ]);


        if(!User::where('id', $fields['reciever_id'])->exists()){
            return response()->json([
                'message' => 'User doesnt exist'
            ]);
        }

        Message::create($request->all());

        return response()->json($fields, 201);
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
