<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin(){
        return view('content.login');
    }

    public function checkLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/content');
        }
        return back()->withError([
            'email' => 'Credentials do not match our records',
        ]);
    }
}
