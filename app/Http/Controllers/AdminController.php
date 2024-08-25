<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function view_all_messages()
    {
        // Return all messages as a JSON response
        $response = Message::all();
        return response()->json($response, 200);
    }

    public function view_all_users(Request $request)
    {
        // Return all users as a JSON response
        return response()->json(User::all(), 201);
    }

    public function search_user(string $id)
    {
        // Logic to search for a user by ID
        // Example:
        $user = User::find($id);
        if ($user) {
            return response()->json($user, 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_user(Request $request, string $id)
    {
        // Logic to update a user by ID
        $user = User::find($id);
        if ($user) {
            $user->update($request->all());
            return response()->json(['message' => 'User updated successfully'], 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_user(string $id)
    {
        // Logic to delete a user by ID
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}
