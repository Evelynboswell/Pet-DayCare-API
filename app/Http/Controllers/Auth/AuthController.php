<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;

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

        $verificationUrl = URL::temporarySignedRoute(
            'verify-email',
            now()->addMinutes(60),
            ['user' => $user->customer_id]
        );

        Mail::to($user->email)->send(new VerifyEmail($verificationUrl));

        return response()->json(['message' => 'User registered successfully. Please verify your email.'], 201);
    }
    public function verifyEmail(Request $request, $user)
    {
        if (!$request->hasValidSignature()) {
            return response()->json(['message' => 'Invalid or expired verification link.'], 403);
        }

        $user = User::findOrFail($user);

        if ($user->email_verified_at) {
            return response()->json(['message' => 'Email already verified.'], 400);
        }

        $user->email_verified_at = now();
        $user->save();

        return response()->json(['message' => 'Email verified successfully.']);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !$user->email_verified_at || !Hash::check($fields['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials or unverified email.'], 401);
        }

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
