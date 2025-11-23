<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        // ✅ Try normal login (hashed passwords)
        if (Auth::attempt($request->only('username', 'password'))) {
            return $this->loginRedirect();
        }

        // 🔁 If hashed login fails, check old/unhashed or MD5 passwords
        $user = \App\Models\User::where('username', $request->username)->first();

        if ($user && ($user->password === $request->password || $user->password === md5($request->password))) {
            
            // 🔐 Auto convert OLD password to secure hashing
            $user->password = Hash::make($request->password);
            $user->save();

            // Login user
            Auth::login($user);
            return $this->loginRedirect();
        }

        return back()->with('error', 'Invalid login credentials');
    }

    // 🔀 Redirect user based on role
    private function loginRedirect()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // ⬅️ Now redirecting admin directly to Tickets Page
            return redirect()->route('admin.tickets');
        } 
        elseif ($user->role === 'it') {
            return redirect('/it/dashboard');
        } 
        else {
            return redirect('/ticket/create');
        }
    }

    // 🚪 Logout user
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
