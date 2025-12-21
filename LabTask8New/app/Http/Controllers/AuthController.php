<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

class AuthController extends Controller
{
    // --- REGISTRATION ---

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Mail::to($user->email)->send(new VerifyEmail($user));

        return redirect('/login')->with('success', 'Registration successful! Please check your email to verify your account.');
    }

    // --- EMAIL VERIFICATION ---

    public function verify($id) {
        $user = User::find($id);

        if ($user) {
            $user->email_verified_at = now();
            $user->save();
            return redirect('/login')->with('success', 'Email verified! You can now login.');
        }

        return redirect('/login')->with('error', 'Invalid verification link.');
    }

    // --- LOGIN (THIS IS THE MISSING PART) ---

    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->email_verified_at == null) {
                Auth::logout();
                return back()->with('error', 'Please verify your email before logging in.');
            }

            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // --- DASHBOARD & LOGOUT ---

    public function dashboard() {
        return view('dashboard');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}