<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::all();
        return view('karyawan', compact('karyawans'));
    }

    public function store(Request $request, $id_karyawan)
    {
        $request->validate([
            'id_karyawan' => 'required|unique:karyawans',
            'nama_karyawan' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'id_akun' => 'required',
            'tanggal_lahir' => 'required|date',
            'posisi_jabatan' => 'required',
            'tanggal_masuk' => 'required|date',
            'gaji' => 'required|numeric',
            'shift_kerja' => 'required',
        ]);

        Karyawan::create($request->all());

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function edit($id_karyawan)
{
    $karyawan = Karyawan::findOrFail($id_karyawan);
    return view('karyawan.edit', compact('karyawan'));
}
    
public function update(Request $request, $id_karyawan)
{
    // Debug untuk melihat apakah validasi berjalan
    $request->validate([
        'id_karyawan' => 'required|unique:karyawans',
            'nama_karyawan' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'id_akun' => 'required',
            'tanggal_lahir' => 'required|date',
            'posisi_jabatan' => 'required',
            'tanggal_masuk' => 'required|date',
            'gaji' => 'required|numeric',
            'shift_kerja' => 'required',
    ]);

    $karyawan = Karyawan::findOrFail($id_karyawan);
    $karyawan->update($request->all());

    return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diupdate.');
}


    public function destroy($id_karyawan)
    {
        Karyawan::findOrFail($id_karyawan)->delete();
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus');
    }
}
