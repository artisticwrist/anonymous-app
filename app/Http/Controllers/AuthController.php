<?php

namespace App\Http\Controllers;

use app\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //

    public function register(Request $request){
        $fields = $request->validate([
            'full_name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed'
        ]);

        // Check if email already exists
        $existingUser = User::where('email', $fields['email'])->exists();
        if ($existingUser) {
            return response()->json(['error' => 'Email already exists'], 422);
        }
    
        // Generate referral link
        $referralLink = $request->full_name . '-' . Str::random(5);
        
        if(User::where('referral_link', $referralLink)){
            $referralLink = $fields['full_name'] . '-' . Str::random(5);
        }


        $user = User::create([
            'full_name'=> $fields['full_name'],
            'email'=> $fields['email'],
            'refferal_link'=> $referralLink,
            'password'=> bcrypt($fields['full_name'])
        ]);


        $token = $user->createToken('myapptoken')->plainTextToken;


        $response = [
            'email' => $user['email'],
            'token' => $token 
        ];

        return response()->json($response, 201);
    }


    public function login(Request $request){

        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response()->json(['message' => 'Incorrect info']);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        Auth::login();

        $response = [
            'user email' => $fields['email'],
            'message' => 'log in successful',
            'token' => $token
        ];


        return response()->json($response, 201);

    }
}
