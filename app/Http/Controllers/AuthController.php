<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivationMail;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

        if ($user->status !== 'active') {
            Auth::logout();

            return back()->withErrors([
                'email'=> 'Your accoount is inactive'
            ]);
        }

        if ($user->role === 'super_admin') {
            return redirect('/super-admin/dashboard');
        } elseif ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role === 'user') {
            return redirect('/user/dashboard');
        }
        
        }
        return back()->withErrors([
        'email' => 'Email atau password salah.',
        ]);

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showRegister(){
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user',
            'status' => 'non-active',
            'activation_token' => Str::random(60),
        ]);

        Mail::to($user->email)->send(new ActivationMail($user->activation_token));

        return redirect('/login')->with('success', 'account successfully created');
    }

    public function activate($token) {
        $user = User::where('activation_token', $token)->first();

        if(!$user) {
            return "Invalid token.";
        }

        $user->update([
            'status' => 'active',
            'activation_token' => null,
        ]);

        return "Account successfully activated. Please log in.";

    }
}
