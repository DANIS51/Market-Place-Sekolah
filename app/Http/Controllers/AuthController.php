<?php

namespace App\Http\Controllers;

// Import class yang dibutuhkan
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
        // Mengembalikan view dari folder resources/views/auth/login.blade.php
        return view('auth.login');
    }

    /**
     * Proses login user
     */
    public function login(Request $request): RedirectResponse
    {
        // Validasi input dari form login
        $credentials = $request->validate([
            'username' => 'required|string', // Username wajib diisi
            'password' => 'required|string|min:4', // Password wajib diisi minimal 4 karakter
        ]);

        // Cek apakah username & password cocok dengan data di database
        if (Auth::attempt($credentials)) {
            // Jika cocok, buat session baru untuk keamanan
            $request->session()->regenerate();

            // Redirect berdasarkan role user
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('dashboard'); // Member juga ke dashboard, tapi bisa disesuaikan
            }
        }

        // Jika login gagal, kirim pesan error kembali ke halaman login
        return back()->withErrors([
            'username' => 'Username atau password salah!', // Pesan error
        ])->onlyInput('username'); // Hanya simpan input username, password dikosongkan
    }

    /**
     * Logout user
     */
    public function logout(Request $request): RedirectResponse
    {
        // Hapus session login user saat ini
        Auth::logout();

        // Hapus semua data session
        $request->session()->invalidate();

        // Regenerasi token CSRF agar lebih aman
        $request->session()->regenerateToken();

        // Kembali ke halaman login setelah logout
        return redirect()->route('login');
    }
}
