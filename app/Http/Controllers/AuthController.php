<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman form login
     */
    public function showLoginForm(): View
    {
        return view('auth.login'); // resources/views/auth/login.blade.php
    }

    /**
     * Proses login user
     */
    public function login(Request $request): RedirectResponse
    {
        // Validasi input dari form login
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:4',
        ]);

        // Cek username & password
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect berdasarkan role user
            if ($user->role === 'admin') {
                return redirect()->route('dashboard');
            } elseif ($user->role === 'member') {
                return redirect()->route('member.dashboard');
            } else {
                // Jika role tidak dikenali
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'username' => 'Role pengguna tidak dikenali.',
                ]);
            }
        }

        // Jika login gagal
        return back()->withErrors([
            'username' => 'Username atau password salah!',
        ])->onlyInput('username');
    }

    /**
     * Logout user
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
