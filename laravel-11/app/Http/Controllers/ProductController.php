<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Tampilkan semua produk (Read)
    public function index()
    {
        $products = Product::all();
        return view('produks.index', compact('products')); // Ganti ke 'produks.index'
    }

    // Tampilkan form untuk membuat produk baru (Create)
    public function create()
    {
        return view('produks.create'); // Ganti ke 'produks.create'
    }

    // Simpan produk baru ke database (Create)
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'kategori' => 'required',
            'tanggal_masuk' => 'required|date',
            'keterangan' => 'required',
            'harga_satuan' => 'required|numeric',
            'id_karyawan' => 'required|exists:karyawans,id',
        ]);

        Product::create($request->all());

        return redirect()->route('produks.index')->with('success', 'Produk berhasil ditambahkan.'); // Ganti ke 'produks.index'
    }

    // Tampilkan detail produk (Read)
    public function show(Product $product)
    {
        return view('produks.show', compact('product')); // Ganti ke 'produks.show'
    }

    // Tampilkan form untuk edit produk (Update)
    public function edit(Product $product)
    {
        return view('produks.edit', compact('product')); // Ganti ke 'produks.edit'
    }

    // Update produk di database (Update)
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_produk' => 'required',
            'kategori' => 'required',
            'tanggal_masuk' => 'required|date',
            'keterangan' => 'required',
            'harga_satuan' => 'required|numeric',
            'id_karyawan' => 'required|exists:karyawans,id',
        ]);

        $product->update($request->all());

        return redirect()->route('produks.index')->with('success', 'Produk berhasil diperbarui.'); // Ganti ke 'produks.index'
    }

    // Hapus produk dari database (Delete)
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('produks.index')->with('success', 'Produk berhasil dihapus.'); // Ganti ke 'produks.index'
    }
}
