<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $login = 'admin@gmail.com';
        $hashedPassword = 'd8578edf8458ce06fbc5bb76a58c5ca4'; // md5 hash for 'qwerty'

        $inputLogin = $request->input('login');
        $inputPassword = $request->input('password');
        $inputPasswordHashed = md5($inputPassword);

        if ($inputLogin === $login && $inputPasswordHashed === $hashedPassword) {
            Session::put('isAdmin', 1);
            return redirect()->route('admin.dashboard');
        }

        Session::put('isAdmin', 0);
        return redirect()->route('admin.login')->withErrors(['login' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Session::forget('isAdmin');
        return redirect()->route('admin.login');
    }
}
