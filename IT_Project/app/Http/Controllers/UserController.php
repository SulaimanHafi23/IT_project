<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan semua user
    public function Tampil()
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            $user = User::all();

            return view('Akun.TampilAkun', compact('user'));
        }

        return redirect()->back()->with('warning', 'Anda tidak memiliki hak akses untuk melihat halaman ini.');
    }

    // Menampilkan halaman tambah user
    public function Tambah()
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            return view('Akun.TambahAkun');
        }

        return redirect()->back()->with('warning', 'Anda tidak memiliki hak akses untuk melihat halaman ini.');
    }

    // Menyimpan user baru
    public function submit(Request $request)
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'level' => 'required|in:admin,user',
                'password' => 'required|min:6',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'level' => $request->level,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('TampilAkun')->with('success', 'Berhasil menambahkan akun baru.');
        }

        return redirect()->back()->with('warning', 'Anda tidak memiliki hak akses untuk melakukan tindakan ini.');
    }

    // Menampilkan halaman edit user
    public function Edit($id)
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            $user = User::findOrFail($id);

            return view('Akun.EditAkun', compact('user'));
        }

        return redirect()->back()->with('warning', 'Anda tidak memiliki hak akses untuk melihat halaman ini.');
    }

    // Memperbarui data user
    public function update(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            $user = User::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|min:6',
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->route('TampilAkun')->with('success', 'Berhasil memperbarui data akun.');
        }

        return redirect()->back()->with('warning', 'Anda tidak memiliki hak akses untuk melakukan tindakan ini.');
    }

    // Menghapus user
    public function delete($id)
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            $user = User::findOrFail($id);
            try {
                $user->delete();
                
                return redirect()->route('TampilAkun')->with('success', 'Berhasil menghapus akun.');

            } catch (\Exception $e) {
        
                // Tampilkan pesan error umum
                return redirect()->back()->with('error', 'Tidak dapat menghapus data Akun, silahkan Hapus data karyawan terlebih dahulu.');
            }
        }

        return redirect()->back()->with('warning', 'Anda tidak memiliki hak akses untuk melakukan tindakan ini.');
    }
}
