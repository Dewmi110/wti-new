<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('backend.sessions.create');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // Only super_admin and admin can access the panel
        if (! $user->role || ! in_array($user->role->slug, ['super_admin', 'admin','user'])) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'You do not have permission to access the admin panel.',
            ])->withInput();
        }

        session(['is_admin' => true]);
        return redirect()->intended('/admin/dashboard');
        }

        // if (Auth::attempt($credentials, $remember)) {
        //     $request->session()->regenerate();
        //     session(['is_admin' => true]);
        //     return redirect()->intended('/admin/dashboard');
        // }

        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
