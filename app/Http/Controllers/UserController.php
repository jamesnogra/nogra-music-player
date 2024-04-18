<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function registerForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validate request data if needed
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Create the user
        $user = User::create([
            'username' => $validatedData['username'],
            'password' => bcrypt($validatedData['password']), // Hash the password for security
        ]);

        // Optionally, you can return the created user or a success message
        return response()->json(['user' => $user], 201);
    }

    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validate request data if needed
        $validatedData = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);
        // Attempt to authenticate the user
        if (Auth::attempt(
            [
                'username' => $validatedData['username'],
                'password' => $validatedData['password']
            ]
        )) {
            // Authentication successful
            $user = Auth::user();
            return response()->json(['user' => $user], 200);
        } else {
            // Authentication failed
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }
}
