<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return response()->json(User::latest()->get());
    }
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string|unique:customers',
            'email' => 'required|string|unique:customers',
            'gender' => 'required|string',
            'address' => 'required|string',
            'photo' => 'string',
            'password' => 'required|string'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'phone_number' => $fields['phone_number'],
            'email' => $fields['email'],
            'gender' => $fields['gender'],
            'address' => $fields['address'],
            'photo' => $fields['photo'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('doggocare')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Retrieve user by email
        $user = User::where('email', $fields['email'])->first();

        // Check if user exists and password matches
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json(['message' => 'Credentials are not valid'], 401);
        }

        // Create and return token if authentication is successful
        $token = $user->createToken('doggocare')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
