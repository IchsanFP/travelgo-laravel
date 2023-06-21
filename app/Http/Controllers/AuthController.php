<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register user
    public function register(Request $request) {
        $data = $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:8|confirmed",
            "username" => "required|string",
            "roles" => "required|string"
        ]);

        // create user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'username' => $data['username'],
            'roles' => $data['roles']
        ]);

        return response([
            "user" => $user,
            "token" => $user->createToken('secret')->plainTextToken
        ]);
    }

    public function login(Request $request) {
        $data = $request->validate([
            "email" => "required|email",
            "password" => "required|min:8",
            "roles" => "required"
        ]);

        // create user
        if(!Auth::attempt($data)){
            return response([
                "message" => "Invalid credentials."
            ], 403);
        };

        return response([
            "user" => auth()->user(),
            "token" => auth()->user()->createToken('secret')->plainTextToken
        ], 200);
    }

    public function user() {
        return response([
            "user" => auth()->user()
        ], 200);
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        return response([
            "message" => "Logout success"
        ], 200);
    }

    public function getUserById(Request $request, $id) {
        $user = User::find($id);
        if ($user) {
            return response(["user" => $user], 200);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
        
    }
}
