<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function tampil()//mengambil semua data karyawan menggunakan Karyawan::all().
    {
        $karyawan = Karyawan::all();
        return view('Karyawan.TampilKaryawan', compact('karyawan'));
    }

    public function Tambah()//mengambil semua data pengguna (User) untuk ditampilkan pada tampilan Karyawan.TambahKaryawan
    {
        $users = User::all();
        return view('Karyawan.TambahKaryawan', compact('users'));
    }

    public function Submit(Request $request)// menerima input dari form
    {
        $request->validate([// untuk memvalidasi data input sesuai aturan
            'Nama_Karyawan' => 'required|string|max:255',
            'Alamat' => 'required',
            'Nomor_Telepon' => 'required|string|max:15',
            'Posisi_Jabatan' => 'required|string|max:255',
            'Tanggal_Lahir' => 'required|date',
            'Shift_Kerja' => 'required|string|max:255',
            'Gaji' => 'required|numeric|min:0',
            'Tanggal_Masuk' => 'required|date',
            'Gambar_Karyawan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Id_User' => 'required|exists:users,id',
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
        ]);//Membuat entitas karyawan baru di database menggunakan data yang diambil dari form input

        return redirect()->route('TampilKaryawan')->with('success', 'Data Karyawan berhasil ditambahkan.');//Mengarahkan kembali pengguna ke halaman tampil karyawan dengan pesan sukses
    }

    public function Edit($id)//mengambil data karyawan berdasarkan ID
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('Karyawan.EditKaryawan', compact('karyawan'));
    }

    public function update(Request $request, $id)//menerima input form untuk memperbarui data karyawan berdasarkan ID
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
        ]);

        $karyawan = Karyawan::findOrFail($id);//Mencari karyawan berdasarkan ID. Jika tidak ditemukan, fungsi ini akan memunculkan error

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


    public function Detail($id)//menampilkan detail karyawan tertentu berdasarkan ID
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('Karyawan.DetailKaryawan', compact('karyawan'));
    }

    
    public function delete($id)// menghapus data karyawan berdasarkan ID
    {
        $karyawan = Karyawan::find($id);
        if ($karyawan->Gambar_Karyawan && Storage::exists('public/' . $karyawan->Gambar_Karyawan)) {
            Storage::delete('public/' . $karyawan->Gambar_Karyawan);
        }
        $karyawan->delete();
        return redirect()->route('TampilKaryawan')->with('success', 'Karyawan berhasil dihapus.');
    }
}
