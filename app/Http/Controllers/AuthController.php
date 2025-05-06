<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function loginForm()
    {
        return view('auth.loginForm');
    }

    public function login(Request $request)
    {
        $successful = Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        if ($successful) {
            return redirect()->route('profile.index');
        } else {
            return redirect()->route('auth.loginForm')->with('error', 'Invalid credentials');
        }
    }
}
