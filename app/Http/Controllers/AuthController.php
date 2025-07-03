<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login pakai username dan password
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        // Coba login
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Cek role pengguna
            if (auth()->user()->role === 'admin') {
                return redirect()->intended('/Dadmin');
            } elseif (auth()->user()->role === 'nasabah') {
                return redirect()->intended('/Dnasabah');
            }

            // Role tidak dikenali
            Auth::logout();
            return back()->with('error', 'Role tidak dikenali.');
        }

        return back()->with('error', 'Username atau password salah.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout.');
    }

     public function showRegistrationForm()
{
    return view('auth.register'); // Pastikan file ini ada: resources/views/auth/register.blade.php
}

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'nasabah',
            'saldo' => 0,
        ]);

        Auth::login($user);

        return redirect()->route('login')->with('success', 'Registrasi berhasil.');
    }
}
