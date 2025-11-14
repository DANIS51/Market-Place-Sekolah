<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;

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
            $user = Auth::user();

            // Cek status user
            if ($user->status !== 'approved') {
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'username' => 'Akun Anda belum disetujui oleh admin. Silakan tunggu konfirmasi.',
                ]);
            }

            $request->session()->regenerate();

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
     * Menampilkan halaman form register
     */
    public function showRegisterForm(): View
    {
        return view('auth.register'); // resources/views/auth/register.blade.php
    }

    /**
     * Proses register user
     */
    public function register(Request $request): RedirectResponse
    {
        // Validasi input dari form register
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kontak' => 'required|string|max:13',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:4',
        ]);

        // Buat user baru dengan role member dan status pending
        User::create([
            'nama' => $validated['nama'],
            'kontak' => $validated['kontak'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => 'member',
            'status' => 'pending',
        ]);

        // Redirect ke login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
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
