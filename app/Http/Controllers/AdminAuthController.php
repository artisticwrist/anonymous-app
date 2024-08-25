<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    //

    public function register_admin(Request $request){
        $fields = $request->validate([
            'name'=>'required|string',
            'email'=>'bail|required|string|unique:users,email',
            'admin_type'=>'required|string',
            'password'=>'required|string|confirmed|min:6'
        ]);

        // Check if email already exists
        $existingAdmin = Admin::where('email', $fields['email'])->exists();
        if ($existingAdmin) {
            return response()->json(['error' => 'Admin Email already exists'], 422);
        }
    

        $user = Admin::create([
            'name'=> $fields['name'],
            'email'=> $fields['email'],
            'admin_type'=> $fields['admin_type'],
            'password'=> bcrypt($fields['name'])
        ]);


        $token = $user->createToken('myapptoken')->plainTextToken;


        $response = [
            'email' => $user['email'],
            'token' => $token 
        ];

        return response()->json($response, 201);
    }


    public function login_admin(Request $request){

        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $admin = Admin::where('email', $fields['email'])->first();

        if(!$admin || !Hash::check($fields['password'], $admin->password)){
            return response()->json(['message' => 'Incorrect info']);
        }

        $token = $admin->createToken('myapptoken')->plainTextToken;

        Auth::login();

        $response = [
            'admin email' => $fields['email'],
            'message' => 'admin is logged in',
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    public function logout_admin(Request $request)
    {
        $request->admin()->tokens()->delete();
    
        return response()->json(['message' => 'Logged out']);
    }

}
