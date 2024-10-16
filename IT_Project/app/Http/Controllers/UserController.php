<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Fungsi untuk menampilkan semua data akun
    public function index() {
        $user = User::all();
        return view('Akun.TampilAkun')->with('user', $user);  // Mengarahkan ke folder 'Akun' di views
    }

    // Fungsi untuk menampilkan data akun
    function Tampil(){
        $user = User::get(); // Mengambil semua data akun dari database
        return view('Akun.TampilAkun', compact('user')); // Menampilkan view 'TampilAkun' dengan data akun
    }

    // Fungsi untuk menampilkan form tambah akun
    function Tambah(){
        return view('Akun.TambahAkun');  // Menampilkan view 'TambahAkun' di dalam folder Akun
    }

    // Fungsi untuk menyimpan data akun baru ke database
    function submit(Request $request){
        // Validasi data
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'level' => 'required'
        ]);

        // Membuat objek baru dari model User
        $user = new User();
        $user->username = $request->username;
        $user->password = bcrypt($request->password); // Mengenkripsi password
        $user->level = $request->level;
        $user->save();

        // Mengarahkan kembali ke halaman 'TampilAkun' dengan pesan sukses
        return redirect()->route('TampilAkun')->with('success', 'Akun berhasil ditambahkan');
    }

    // Fungsi untuk menampilkan form edit akun berdasarkan ID
    function Edit($Id){
        $user = User::find($Id); // Mencari data akun berdasarkan ID
        if ($user) {
            return view('Akun.EditAkun', compact('user')); // Jika akun ditemukan, tampilkan view edit
        }
        return redirect()->route('TampilAkun')->with('error', 'Akun tidak ditemukan');
    }

    // Fungsi untuk mengupdate data akun yang sudah ada
    public function update(Request $request, $id) {
        // Validasi data
        $request->validate([
            'Username' => 'required',
            'Password' => 'required',
        ]);
    
        // Cari data akun berdasarkan ID
        $user = User::find($id);
    
        if ($user) {
            $user->Username = $request->Username;
            $user->Password = bcrypt($request->Password); // Enkripsi password
            $user->update(); // Simpan data yang diupdate
    
            // Redirect ke halaman tampil akun dengan pesan sukses
            return redirect()->route('TampilAkun')->with('success', 'Akun berhasil diupdate');
        }
    
        // Jika akun tidak ditemukan, kembalikan pesan error
        return redirect()->route('TampilAkun')->with('error', 'Akun tidak ditemukan');
    }

    // Fungsi untuk menghapus akun
    public function destroy($Id) {
        $akun = User::find($Id); // Mencari data akun berdasarkan ID
        if ($akun) {
            $akun->delete(); // Menghapus data akun
            return redirect()->route('TampilAkun')->with('success', 'Akun berhasil dihapus');
        }
        return redirect()->route('TampilAkun')->with('error', 'Akun tidak ditemukan');
    }

    // Fungsi untuk login
    public function login(Request $request)
    {
        // Validasi iput
        $login = $request->validate([
            'Username' => 'required',
            'Password' => 'required'
        ]);

        // Mencoba autentikasi dengan credentials yang benar
        if (Auth::attempt(['Username' => $login['Username'], 'Password' => $login['Password']])) {
            $request->session()->regenerate();
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
