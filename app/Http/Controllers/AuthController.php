<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // =============================
    // TAMPILKAN HALAMAN LOGIN
    // =============================
    public function showLogin()
    {
        return view('auth.login');
    }

    // =============================
    // PROSES LOGIN
    // =============================
   public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        $user = Auth::user();

        // paksa login ke guard web
        Auth::login($user);

        return redirect()->route($user->role.'.dashboard');
    }

    return back()->with('error','Email atau Password salah');
}

    // =============================
    // LOGOUT
    // =============================
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
