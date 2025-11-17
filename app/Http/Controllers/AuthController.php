<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('username', 'password'))) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            } elseif ($user->role === 'it') {
                return redirect('/it/dashboard');
            } else {
                return redirect('/ticket/create');
            }
        }

        return back()->with('error', 'Invalid login credentials');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
