<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function getRegister() {
        return view('register');
    }

    function getLogin() {
        return view('login');
    }

    function storeRegister(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'unique:users'],
            'password' => ['required']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login');
    }

    function storeLogin(Request $request) {
        $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        $credentials = ([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $message = Auth::user()->name. ' telah melakukan login';
            return redirect('/home');
        }

        return back()->withErrors([
            'password' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/home');
    }
}
