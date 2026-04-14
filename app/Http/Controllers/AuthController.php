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
                    'email'=> 'Your account is inactive'
                ]);
            }

            $redirectMap = [
                'super_admin' => '/super-admin/dashboard',
                'admin' => '/admin/dashboard',
                'user' => '/user/dashboard',
            ];

            return redirect($redirectMap[$user->role] ?? '/login');
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

    // public function register(Request $request) {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6',
    //         'nisn' => 'required|numeric|digits:10|unique:users'
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password),
    //         'role' => 'user',
    //         'status' => 'non-active',
    //         'nisn' => $request->nisn,
    //     ]);


    //     return redirect('/login')->with('success', 'Account successfully created. Please wait for admin approval.');
    // }

}
