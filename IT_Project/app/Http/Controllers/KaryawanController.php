<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function tampil() {
        $karyawan = Karyawan::all(); // Ambil semua data karyawan
        return view('Karyawan.TampilKaryawan', compact('karyawan'));
    }

    public function Tambah() {
        $user = User::all();
        return view('Karyawan.TambahKaryawan', compact('user'));
    }
    
    public function Submit(Request $request) {
        $request->validate([
            'Nama_Karyawan' => 'required|string|max:255',
            'Alamat' => 'required',
            'Nomor_Telepon' => 'required|string|max:15',
            'Posisi_Jabatan' => 'required|string|max:255',
            'Tanggal_Lahir' => 'required|date',
            'Shift_Kerja' => 'required|string|max:255',
            'Gaji' => 'required|numeric|min:0',
            'Tanggal_Masuk' => 'required|date',
            'Gambar_Karyawan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
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
    $karyawan = Karyawan::findOrFail($id); // Menemukan karyawan berdasarkan ID
    return view('Karyawan.EditKaryawan', compact('karyawan')); // Mengirim data karyawan ke view
}

public function update(Request $request, $id)
{
    // Validasi input
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

    $karyawan = Karyawan::findOrFail($id);
    $karyawan->Nama_Karyawan = $request->Nama_Karyawan;
    $karyawan->Alamat = $request->Alamat;
    $karyawan->Nomor_Telepon = $request->Nomor_Telepon;
    $karyawan->Posisi_Jabatan = $request->Posisi_Jabatan;
    $karyawan->Tanggal_Lahir = $request->Tanggal_Lahir;
    $karyawan->Shift_Kerja = $request->Shift_Kerja;
    $karyawan->Gaji = $request->Gaji;
    $karyawan->Id_User = $request->Id_User;

    // Mengupload gambar baru jika ada
    if ($request->hasFile('Gambar_Karyawan')) {
        // Hapus gambar lama jika ada
        if ($karyawan->Gambar_Karyawan) {
            $oldImagePath = storage_path('' . $karyawan->Gambar_Karyawan);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
                delete($oldImagePath);
            }
        }
        
        // Simpan gambar baru
        $file = $request->file('Gambar_Karyawan');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/karyawan', $filename);
        $karyawan->Gambar_Karyawan = $filename;
    }

    $karyawan->save(); // Simpan perubahan
    return redirect()->route('TampilKaryawan')->with('success', 'Data karyawan berhasil diperbarui.');
}

public function Detail($id)
{
    $karyawan = Karyawan::findOrFail($id); // Menemukan karyawan berdasarkan ID
    return view('Karyawan.DetailKaryawan', compact('karyawan')); // Mengirim data karyawan ke view
}


    public function delete($id)
{
    // Mencari karyawan berdasarkan ID
    $karyawan = Karyawan::find($id);

    // Memeriksa apakah karyawan ditemukan
    if ($karyawan) {
        // Menghapus file gambar jika ada
        if ($karyawan->Gambar_Karyawan) {
            $path = public_path('' . $karyawan->Gambar_Karyawan); // Path ke gambar
            if (file_exists($path)) {
                unlink($path); // Menghapus file dari server
                \Log::info('File dihapus: ' . $path);
            } else {
                \Log::info('File tidak ditemukan: ' . $path);
            }
        }

        // Menghapus karyawan
        $karyawan->delete();

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('TampilKaryawan')->with('success', 'Karyawan berhasil dihapus.');
    } else {
        // Jika tidak ditemukan, mengarahkan dengan pesan error
        return redirect()->route('TampilKaryawan')->with('error', 'Karyawan tidak ditemukan.');
    }
}

}
