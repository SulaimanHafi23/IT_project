<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    // Fungsi untuk menampilkan semua data akun
    public function index() {
        $akun = Akun::all();
        return view('Akun.TampilAkun')->with('akun', $akun);  // Mengarahkan ke folder 'Akun' di views
    }

    // Fungsi untuk menampilkan data akun
    function Tampil(){
        $akun = Akun::get(); // Mengambil semua data akun dari database
        return view('Akun.TampilAkun', compact('akun')); // Menampilkan view 'TampilAkun' dengan data akun
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

        // Membuat objek baru dari model Akun
        $akun = new Akun();
        $akun->username = $request->username;
        $akun->password = $request->password; // Mengenkripsi password
        $akun->level = $request->level;
        $akun->save(); // Menyimpan data ke database

        // Mengarahkan kembali ke halaman 'TampilAkun' dengan pesan sukses
        if($akun->save()){
            return redirect()->route('TampilAkun')->with('success', 'Akun berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Akun tidak bisa disimpan');
        }
    }

    // Fungsi untuk menampilkan form edit akun berdasarkan ID
    function Edit($Id){
        $akun = Akun::find($Id); // Mencari data akun berdasarkan ID
        if ($akun) {
            return view('Akun.EditAkun', compact('akun')); // Jika akun ditemukan, tampilkan view edit
        }
        return redirect()->route('TampilAkun')->with('error', 'Akun tidak ditemukan');
    }

    // Fungsi untuk mengupdate data akun yang sudah ada
    public function update(Request $request, $id) {
        // Validasi data
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        // Cari data akun berdasarkan ID
        $akun = Akun::find($id);
    
        if ($akun) {
            $akun->username = $request->username;
            $akun->password = bcrypt($request->password); // Enkripsi password
            $akun->update(); // Simpan data yang diupdate
    
            return redirect()->route('TampilAkun')->with('success', 'Akun berhasil diupdate');
        }
    
        return redirect()->route('TampilAkun')->with('error', 'Akun tidak ditemukan');
    }

    // Fungsi untuk menghapus akun
    public function destroy($Id) {
        $akun = Akun::find($Id); 
        if ($akun) {
            $akun->delete();
            return redirect()->route('TampilAkun')->with('success', 'Akun berhasil dihapus');
        }
        return redirect()->route('TampilAkun')->with('error', 'Akun tidak ditemukan');
    }
}
