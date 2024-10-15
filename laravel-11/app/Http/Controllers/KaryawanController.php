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

    public function store(Request $request)
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

    public function edit($id)
{
    $karyawan = Karyawan::findOrFail($id);
    return view('edit', compact('karyawan'));
}
    
public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'nomor_telepon' => 'required|string|max:15',
        'id_akun' => 'required|integer',
        'tanggal_lahir' => 'required|date',
        'posisi_jabatan' => 'required|string|max:255',
        'tanggal_masuk' => 'required|date',
        'gaji' => 'required|numeric',
        'shift_kerja' => 'required|string|max:255',
    ]);

    $karyawan = Karyawan::findOrFail($id);
    $karyawan->update([
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'nomor_telepon' => $request->nomor_telepon,
        'id_akun' => $request->id_akun,
        'tanggal_lahir' => $request->tanggal_lahir,
        'posisi_jabatan' => $request->posisi_jabatan,
        'tanggal_masuk' => $request->tanggal_masuk,
        'gaji' => $request->gaji,
        'shift_kerja' => $request->shift_kerja,
    ]);

    return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diupdate.');
}
    public function destroy($id_karyawan)
    {
        Karyawan::findOrFail($id_karyawan)->delete();
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus');
    }
}
