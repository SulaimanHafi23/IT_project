<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProdukController extends Controller
{

    public function index()
    {
        $produk = Produk::all();
        return view('produks.index', compact('produk'));
    }


    public function create()
    {
        $karyawan = Karyawan::all();
        return view('produks.create', compact('karyawan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nama_Produk' => 'required',
            'Kategori' => 'required',
            'Harga_Satuan' => 'required|numeric',
            'Tanggal_Masuk' => 'required|date',
            'Stok' => 'required',
            'Keterangan' => 'nullable|string',
            'Id_Karyawan' => 'required|exists:karyawan,Id_Karyawan',
        ]);

        Produk::create($request->all());

        return redirect()->route('produks.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produks.show', compact('produk'));
    }

    public function edit($id)
    {
        $karyawan = Karyawan::all();
        $produk = Produk::findOrFail($id);
        return view('produks.edit', compact('produk', 'karyawan'));
    }
    public function update(Request $request, $id)
{

    $request->validate([
        'Nama_Produk' => 'required',
        'Kategori' => 'required',
        'Harga_Satuan' => 'required|numeric',
        'Tanggal_Masuk' => 'nullable|date',
        'Stok' => 'required',
        'Keterangan' => 'required|string',
    ]);

    $produk = Produk::findOrFail($id);

    $data = [
        'Nama_Produk' => $request->Kategori,
        'Kategori' => $request->Kategori,
        'Harga_Satuan' => $request->Harga_Satuan,
        'Stok' => $request->Stok,
        'Shift_Kerja' => $request->Shift_Kerja,
        'Keterangan' => $request->Keterangan,
    ];

    $produk->update($data);
    return redirect()->route('produks.index')->with('success', 'Data Produk berhasil diperbarui.');
}

    public function detail($id)
    {

        $produk = Produk::with('karyawan')->findOrFail($id);        

        return view('produks.detail', compact('produk'));
    }

    public function destroy($id)
{

    $produk = Produk::findOrFail($id);

    if ($produk->delete()) {
        return redirect()->route('produks.index')->with('success', 'Produk berhasil dihapus.');
    } else {
        return redirect()->route('produks.index')->with('error', 'Produk gagal dihapus. Silakan coba lagi.');
    }
}

}