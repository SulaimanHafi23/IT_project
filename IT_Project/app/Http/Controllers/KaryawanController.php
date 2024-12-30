<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    // Menampilkan semua data karyawan
    public function tampil()
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            $karyawan = Karyawan::all();
            return view('Karyawan.TampilKaryawan', compact('karyawan'));
        }

        return redirect()->back()->with('warning', 'Anda tidak memiliki akses ke halaman ini.');
    }

    // Menampilkan form tambah karyawan
    public function Tambah()
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            $user = User::all();
            return view('Karyawan.TambahKaryawan', compact('user'));
        }

        return redirect()->back()->with('warning', 'Anda tidak memiliki akses ke halaman ini.');
    }

    // Menyimpan data karyawan baru
   public function Submit(Request $request)
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            $request->validate([
                'Nama_Karyawan'   => 'required|string|max:255',
                'Alamat'          => 'required|string',
                'Nomor_Telepon'   => 'required|string|max:15',
                'Posisi_Jabatan'  => 'required|string|max:255',
                'Tanggal_Lahir'   => 'required|date',
                'Shift_Kerja'     => 'required|string|max:255',
                'Gaji'            => 'required|numeric|min:0',
                'Tanggal_Masuk'   => 'required|date',
                'Gambar_Karyawan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'Id_User'         => 'required|exists:users,id|unique:karyawan,Id_User',
            ], [
                'Id_User.unique' => 'Akun ini sudah digunakan oleh karyawan lain.',
            ]);

            $gambarPath = null;
            if ($request->hasFile('Gambar_Karyawan')) {
                $gambarPath = $request->file('Gambar_Karyawan')->store('karyawan', 'public');
            }

            Karyawan::create([
                'Nama_Karyawan'   => $request->Nama_Karyawan,
                'Alamat'          => $request->Alamat,
                'Nomor_Telepon'   => $request->Nomor_Telepon,
                'Posisi_Jabatan'  => $request->Posisi_Jabatan,
                'Tanggal_Lahir'   => $request->Tanggal_Lahir,
                'Shift_Kerja'     => $request->Shift_Kerja,
                'Gaji'            => $request->Gaji,
                'Tanggal_Masuk'   => $request->Tanggal_Masuk,
                'Gambar_Karyawan' => $gambarPath,
                'Id_User'         => $request->Id_User,
            ]);

            return redirect()->route('TampilKaryawan')->with('success', 'Berhasil menambahkan karyawan.');
        }

        return redirect()->back()->with('warning', 'Anda tidak memiliki akses untuk melakukan tindakan ini.');
    }

    // Menampilkan form edit karyawan
    public function Edit($id)
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            $karyawan = Karyawan::findOrFail($id);
            return view('Karyawan.EditKaryawan', compact('karyawan'));
        } 

        return redirect()->back()->with('warning', 'Anda tidak memiliki akses ke halaman ini.');
    }

    // Memperbarui data karyawan
    public function update(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            $karyawan = Karyawan::findOrFail($id);

            $request->validate([
                'Nama_Karyawan'   => 'required|string|max:255',
                'Alamat'          => 'required|string',
                'Nomor_Telepon'   => 'required|string|max:15',
                'Posisi_Jabatan'  => 'required|string|max:255',
                'Tanggal_Lahir'   => 'required|date',
                'Shift_Kerja'     => 'required|string|max:255',
                'Gaji'            => 'required|numeric|min:0',
                'Gambar_Karyawan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'Id_User'         => 'required|exists:users,id|unique:karyawan,Id_User',
            ], [
                'Id_User.unique' => 'Akun ini sudah digunakan oleh karyawan lain.',
            ]);

            if ($request->hasFile('Gambar_Karyawan')) {
                if ($karyawan->Gambar_Karyawan && Storage::exists('public/' . $karyawan->Gambar_Karyawan)) {
                    Storage::delete('public/' . $karyawan->Gambar_Karyawan);
                }
                $gambarPath = $request->file('Gambar_Karyawan')->store('karyawan', 'public');
                $karyawan->Gambar_Karyawan = $gambarPath;
            }

            $karyawan->update($request->except('Gambar_Karyawan'));

            return redirect()->route('TampilKaryawan')->with('success', 'Berhasil memperbarui data karyawan.');
        }

        return redirect()->back()->with('warning', 'Anda tidak memiliki akses untuk melakukan tindakan ini.');
    }

    // Menampilkan detail karyawan
    public function Detail($id)
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            $karyawan = Karyawan::findOrFail($id);
            return view('Karyawan.DetailKaryawan', compact('karyawan'));
        }

        return redirect()->back()->with('warning', 'Anda tidak memiliki akses ke halaman ini.');
    }

    // Menghapus data karyawan
    public function delete($id)
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            try {
                $karyawan = Karyawan::findOrFail($id);
    
                if ($karyawan->Gambar_Karyawan && Storage::exists('public/' . $karyawan->Gambar_Karyawan)) {
                    Storage::delete('public/' . $karyawan->Gambar_Karyawan);
                }
    
                $karyawan->delete();
    
                return redirect()->route('TampilKaryawan')->with('success', 'Berhasil menghapus data karyawan.');
            } catch (\Exception $e) {
        
                return redirect()->back()->with('error', 'Tidak dapat menghapus data Karyawan, silahkan Hapus data yang bersngkutan dengan karyawan terlebih dahulu.');
            }
        }

        return redirect()->back()->with('warning', 'Anda tidak memiliki akses untuk melakukan tindakan ini.');
    }
}
