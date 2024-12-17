<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('login'); // view login yang benar
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'Username' => 'required',
            'Password' => 'required'
        ]);

        // Mencoba autentikasi dengan credentials yang benar
        $credentials = [
            'username' => $request->input('Username'),  // Sesuaikan dengan field username di database
            'password' => $request->input('Password')
        ];

        if (Auth::attempt($credentials)) {
            // Jika sukses, redirect ke halaman dashboard
            return redirect()->route('Beranda')->with('success', 'Login berhasil!');
        }

        // Jika gagal, kembali ke halaman login dengan pesan error
        return redirect()->back()->withErrors(['error' => 'Username atau password salah.']);
    }

    // Proses logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}