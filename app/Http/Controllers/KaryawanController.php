<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function tampil()//Mengambil semua data karyawan dari database dan menampilkan halaman
    {
        $karyawan = Karyawan::all();
        return view('Karyawan.TampilKaryawan', compact('karyawan'));
    }

    public function Tambah()//Mengambil semua data pengguna
    {
        $user = User::all();
        return view('Karyawan.TambahKaryawan', compact('user'));
    }

    public function Submit(Request $request)//Memvalidasi data yang dikirimkan dalam permintaan untuk memastikan data karyawan valid
    {
        $request->validate([
            'Nama_Karyawan' => 'required|string|max:255',
            'Alamat' => 'required',
            'Nomor_Telepon' => 'required|string|max:15',
            'Posisi_Jabatan' => 'required|string|max:255',
            'Tanggal_Lahir' => 'required|date',
            'Shift_Kerja' => 'required|string|max:255',
            'Gaji' => 'required|numeric|min:0',
            'Tanggal_Masuk' => 'required|date',
            'Gambar_Karyawan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Id_User' => 'required|exists:user,Id_User',
        ]);

        $gambarPath = null;
        if ($request->hasFile('Gambar_Karyawan')) {
            $gambarPath = $request->file('Gambar_Karyawan')->store('karyawan', 'public');
        }

        Karyawan::create([
            'Nama_Karyawan' => $request->Nama_Karyawan,
            'Alamat' => $request->Alamat,
            'Nomor_Telepon' => $request->Nomor_Telepon,
            'Posisi_Jabatan' => $request->Posisi_Jabatan,
            'Tanggal_Lahir' => $request->Tanggal_Lahir,
            'Shift_Kerja' => $request->Shift_Kerja,
            'Gaji' => $request->Gaji,
            'Tanggal_Masuk' => $request->Tanggal_Masuk,
            'Gambar_Karyawan' => $gambarPath,
            'Id_User' => $request->Id_User,
        ]);

        return redirect()->route('TampilKaryawan')->with('success', 'Data Karyawan berhasil ditambahkan.');
    }

    public function Edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('Karyawan.EditKaryawan', compact('karyawan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nama_Karyawan' => 'required|string|max:255',
            'Alamat' => 'required|string',
            'Nomor_Telepon' => 'required|string',
            'Posisi_Jabatan' => 'required|string',
            'Tanggal_Lahir' => 'required|date',
            'Shift_Kerja' => 'required|string',
            'Gaji' => 'required|numeric',
            'Id_User' => 'required|exists:user,Id_User',
            'Gambar_Karyawan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);//Memvalidasi data yang diterima pada saat proses update

        $karyawan = Karyawan::findOrFail($id);//Mengambil data karyawan yang akan diperbarui.

        if ($request->hasFile('Gambar_Karyawan')) {
            if ($karyawan->Gambar_Karyawan && Storage::exists('public/' . $karyawan->Gambar_Karyawan)) {
                Storage::delete('public/' . $karyawan->Gambar_Karyawan);
            }
        
            $gambarPath = $request->file('Gambar_Karyawan')->store('karyawan', 'public');
            $karyawan->Gambar_Karyawan = $gambarPath;
        }
           
        $karyawan->Nama_Karyawan = $request->Nama_Karyawan;
        $karyawan->Alamat = $request->Alamat;
        $karyawan->Nomor_Telepon = $request->Nomor_Telepon;
        $karyawan->Posisi_Jabatan = $request->Posisi_Jabatan;
        $karyawan->Tanggal_Lahir = $request->Tanggal_Lahir;
        $karyawan->Shift_Kerja = $request->Shift_Kerja;
        $karyawan->Gaji = $request->Gaji;
        $karyawan->Id_User = $request->Id_User;
        $karyawan->update();
        return redirect()->route('TampilKaryawan')->with('success', 'Data karyawan berhasil diperbarui.');
    }


    public function Detail($id)//menampilkan detail karyawan
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('Karyawan.DetailKaryawan', compact('karyawan'));
    }

    
    public function delete($id)
    {
        $karyawan = Karyawan::find($id);
        if ($karyawan->Gambar_Karyawan && Storage::exists('public/' . $karyawan->Gambar_Karyawan)) {
            Storage::delete('public/' . $karyawan->Gambar_Karyawan);
        }
        $karyawan->delete();
        return redirect()->route('TampilKaryawan')->with('success', 'Karyawan berhasil dihapus.');
    }
}