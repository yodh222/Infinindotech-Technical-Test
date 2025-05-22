<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return redirect()->route('dashboard')->with('success', 'You are logged in!');
        } else {
            return redirect()->route('login')->with('error', 'Invalid credentials!');
        }
    }
}
