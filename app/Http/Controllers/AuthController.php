<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Registration logic
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $user->createToken('ExpenseTrackerApp')->plainTextToken;

        return response()->json([
            'message' => 'User created successfully',
            'user'    => $user,
            'token'   => $token,
        ], 201);
    }

    // Login logic
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($validated)) {
            $user = Auth::user();
            return response()->json([
                'message' => 'Login successful',
                'token' => $user->createToken('ExpenseTrackerApp')->plainTextToken,
                'user' => $user
            ]);
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
    // Logout logic
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }


    // Get authenticated user
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
