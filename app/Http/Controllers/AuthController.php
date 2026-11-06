<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan form login
     */
    public function showLoginForm()
    {
        // Jika sudah login, langsung arahkan ke dashboard admin
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    /**
     * Memproses percobaan login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $remember = $request->has('remember');

        // Cek login dengan status aktif
        if (Auth::attempt(array_merge($credentials, ['status' => 'aktif']), $remember)) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')
                ->with('success', 'Selamat datang kembali, '.Auth::user()->nama.'!');
        }

        // Cek apakah akun ada tapi nonaktif
        $userNonaktif = \App\Models\User::where('username', $request->username)
            ->where('status', '!=', 'aktif')
            ->first();

        if ($userNonaktif) {
            return back()->withInput($request->only('username', 'remember'))
                ->withErrors(['username' => 'Akun Anda sedang dinonaktifkan. Silakan hubungi pengelola.']);
        }

        return back()->withInput($request->only('username', 'remember'))
            ->withErrors(['username' => 'Username atau password yang dimasukkan salah.']);
    }

    /**
     * Memproses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}

