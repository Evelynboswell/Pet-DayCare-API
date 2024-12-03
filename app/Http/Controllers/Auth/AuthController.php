<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return response()->json(User::latest()->get());
    }
    public function registerView()
    {
        return view('register');
    }
    public function loginView()
    {
        return view('login');
    }
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string|unique:customers',
            'email' => 'required|string|unique:customers',
            'gender' => 'required|string',
            'address' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'phone_number' => $fields['phone_number'],
            'email' => $fields['email'],
            'gender' => $fields['gender'],
            'address' => $fields['address'],
            'photo' => null,
            'password' => bcrypt($fields['password'])
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'verify-email',
            now()->addMinutes(60),
            ['user' => $user->customer_id]
        );

        Mail::to($user->email)->send(new VerifyEmail($verificationUrl));

        return response()->redirectToRoute('verifyEmail');
    }

    public function verifyEmail(Request $request, $user)
    {
        if (!$request->hasValidSignature()) {
            return response()->json(['message' => 'Invalid or expired verification link.'], 403);
        }

        $user = User::findOrFail($user);

        if ($user->email_verified_at) {
            return redirect()->route('loginView')->with('message', 'Email already verified.');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('loginView')->with('message', 'Email verified successfully. Please log in.');
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !$user->email_verified_at || !Hash::check($fields['password'], $user->password)) {
            $errorMessage = ['loginError' => 'Invalid credentials or unverified email.'];

            if ($request->expectsJson()) {
                return response()->json($errorMessage, 401);
            }

            return back()->withErrors($errorMessage)->withInput();
        }

        auth()->login($user);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $user->createToken('doggocare')->plainTextToken,
            ], 200);
        }

        return redirect()->route('dashboard')->with('message', 'Login successful!');
    }

    public function getUserProfile(Request $request)
    {
        return response()->json($request->user(), 200);
    }

    public function updateUserProfile(Request $request, $id)
    {
        if (auth()->id() != $id) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            return back()->withErrors(['error' => 'Unauthorized'])->withInput();
        }
        $fields = $request->validate([
            'name' => 'sometimes|string',
            'phone_number' => 'sometimes|string|unique:customers,phone_number,' . $id . ',customer_id',
            'gender' => 'sometimes|string',
            'address' => 'sometimes|string',
        ]);
        $user = auth()->user();
        $user->update($fields);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Profile updated successfully.',
                'user' => $user
            ], 200);
        }
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function deleteAccount(Request $request)
    {
        $user = $request->user();
        $user->delete();
        $user->tokens()->delete();
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Account deleted successfully.'], 200);
        }
        return redirect()->route('welcomeDoggoCare')->with('status', 'Account deleted successfully.');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
    public function logoutWeb(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcomeDoggoCare');
    }

    public function dashboard()
    {
        $user = auth()->user();

        $bookings = $user->bookings()
            ->with(['dogs', 'boardings'])
            ->get();

        return view('dashboard', compact('bookings'));
    }
    public function editProfile()
    {
        $user = auth()->user();
        if (!$user) {
            abort(403, 'No authenticated user found');
        }
        return view('profile.edit', compact('user'));
    }
    public function updatePassword(Request $request, $id)
    {
        if (auth()->id() != $id) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            return back()->withErrors(['error' => 'Unauthorized'])->withInput();
        }

        $fields = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'new_password.confirmed' => 'The new password confirmation does not match.',
        ]);

        $user = auth()->user();

        if (!\Hash::check($fields['current_password'], $user->password)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Current password is incorrect.'], 400);
            }
            return back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
        }

        $user->password = \Hash::make($fields['new_password']);
        $user->save();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Password updated successfully.'], 200);
        }

        return redirect()->route('profile.edit')->with('success', 'Password updated successfully.');
    }
    public function updatePhoto(Request $request, $id)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096']);

        $user = User::findOrFail($id);

        if ($request->hasFile('photo')) {
            if ($user->photo && file_exists(public_path('storage/' . $user->photo))) {
                unlink(public_path('storage/' . $user->photo));
            }

            $photo = $request->file('photo');

            $photoName = time() . '.' . $photo->getClientOriginalExtension();

            $photo->storeAs('public/profile_photos', $photoName);

            $user->photo = 'profile_photos/' . $photoName;
            $user->save();
        }
        return redirect()->route('profile.edit')->with('success', 'Profile photo updated successfully');
    }
}
