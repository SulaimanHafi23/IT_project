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
            'Stok' => 'required|numeric',
            'Keterangan' => 'nullable|string',
        ]);

        $user = auth()->user();
        $karyawan = Karyawan::where('Id_User', $user->id)->first();

        if (!$karyawan) {
            return redirect()->back()->with('error', 'Akun Anda tidak terhubung dengan data karyawan. Silakan hubungi admin.');
        }

        $produk = Produk::where('Nama_Produk', $request->Nama_Produk)->first();

        if ($produk) {
            $produk->update([
                'Kategori' => $request->Kategori,
                'Harga_Satuan' => $request->Harga_Satuan,
                'Tanggal_Masuk' => $request->Tanggal_Masuk,
                'Stok' => $produk->Stok + $request->Stok,
                'Keterangan' => $request->Keterangan,
                'Id_Karyawan' => $karyawan->Id_Karyawan,
            ]);
            return redirect()->route('produks.index')->with('success', 'Stok produk berhasil diperbarui!');
        } else {
            Produk::create([
                'Nama_Produk' => $request->Nama_Produk,
                'Kategori' => $request->Kategori,
                'Harga_Satuan' => $request->Harga_Satuan,
                'Tanggal_Masuk' => $request->Tanggal_Masuk,
                'Stok' => $request->Stok,
                'Keterangan' => $request->Keterangan,
                'Id_Karyawan' => $karyawan->Id_Karyawan,
            ]);
            return redirect()->route('produks.index')->with('success', 'Produk baru berhasil ditambahkan!');
        }
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
            'Stok' => 'required|numeric',
            'Keterangan' => 'required|string',
        ]);

        $user = auth()->user();
        $karyawan = Karyawan::where('Id_User', $user->id)->first();

        if (!$karyawan) {
            return redirect()->back()->with('error', 'Akun Anda tidak terhubung dengan data karyawan. Silakan hubungi admin.');
        }

        $produk = Produk::findOrFail($id);

        $produk->update([
            'Nama_Produk' => $request->Nama_Produk,
            'Kategori' => $request->Kategori,
            'Harga_Satuan' => $request->Harga_Satuan,
            'Tanggal_Masuk' => $request->Tanggal_Masuk,
            'Stok' => $request->Stok,
            'Keterangan' => $request->Keterangan,
            'Id_Karyawan' => $karyawan->Id_Karyawan,
        ]);

        return redirect()->route('produks.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function detail($id)
    {
        $produk = Produk::with('karyawan')->findOrFail($id);
        return view('produks.detail', compact('produk'));
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        try {
            $produk->delete();
            
            return redirect()->route('produks.index')->with('success', 'Produk berhasil dihapus.');

        } catch (\Exception $e) {
            // Tampilkan pesan error umum
            return redirect()->back()->with('error', 'Tidak dapat menghapus data Produk, silahkan Hapus data penjualan yang bersangkutan terlebih dahulu.');
        }
    }
}
