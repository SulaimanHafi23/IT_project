<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProdukController extends Controller
{
    // Tampilkan semua produk (Read)
    public function index()
    {
        $produk = Produk::all();
        return view('produks.index', compact('produk'));
    }

    // Tampilkan form untuk membuat produk baru (Create)
    public function create()
    {
        $karyawan = Karyawan::all();
        return view('produks.create', compact('karyawan'));
    }

    // Simpan produk baru ke database (Create)
    public function store(Request $request)
    {
        $request->validate([
            'Nama_Produk' => 'required',
            'Kategori' => 'required',
            'Harga_Satuan' => 'required|numeric',
            'Tanggal_Masuk' => 'required|date',
            'Stok' => 'required',
            'Keterangan' => 'nullable|string',
            'Id_Karyawan' => 'nullable|exists:karyawan,Id_karyawan',
        ]);

        Produk::create($request->all());

        return redirect()->route('produks.index')->with('success', 'Produk berhasil ditambahkan');
    }

    // Tampilkan detail produk (Read)
    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produks.show', compact('produk'));
    }

    // Tampilkan form untuk edit produk (Update)
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produks.edit', compact('produk'));
    }

    // Update produk di database (Update)
    public function update(Request $request, $id)
{
    // Validasi request
    $request->validate([
        'Nama_Produk' => 'required',
        'Kategori' => 'required',
        // 'Tanggal_Masuk' => 'required|date',
        'Stok' => 'required|integer', // Pastikan stok adalah integer
        'Keterangan' => 'nullable|numeric', // Validasi harga_satuan seharusnya ada dan angka
        'Id_Karyawan' => 'nullable|exists:karyawan,Id_karyawan', // Jika tidak wajib, gunakan nullable
    ]);

    // Cari produk berdasarkan ID
    $produk = Produk::findOrFail($id);

    // Update data produk dengan input yang divalidasi
    $produk->update($request->only([
        'Nama_Produk',
        'Kategori',
        // 'Tanggal_Masuk',
        'Stok',
        'Keterangan',
        'Id_Karyawan'
    ]));

    // Redirect dengan pesan sukses
    return redirect()->route('produks.index')->with('success', 'Produk berhasil diperbarui.');
}


    // Hapus produk dari database (Delete)
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produks.index')->with('success', 'Produk berhasil dihapus.');
    }
}