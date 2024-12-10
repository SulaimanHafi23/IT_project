<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProdukController extends Controller
{

    public function index()//mengambil semua data produk menggunakan Produk::all()
    {
        $produk = Produk::all();
        return view('produks.index', compact('produk'));
    }


    public function create()//mengambil semua data karyawan menggunakan Karyawan::all(), yang mungkin diperlukan untuk memilih karyawan yang terkait dengan produk
    {
        $karyawan = Karyawan::all();
        return view('produks.create', compact('karyawan'));
    }

    public function store(Request $request)//menerima input dari form dan memvalidasinya
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

        Produk::create($request->all());//Membuat entitas produk baru di database menggunakan data yang diterima dari input form

        return redirect()->route('produks.index')->with('success', 'Produk berhasil ditambahkan');//Mengarahkan pengguna kembali ke halaman produks.index dengan pesan sukses bahwa produk berhasil ditambahkan
    }

    public function show($id)//menampilkan detail produk tertentu berdasarkan ID
    {
        $produk = Produk::findOrFail($id);
        return view('produks.show', compact('produk'));
    }

    public function edit($id)//mengambil data karyawan dan produk tertentu berdasarkan ID
    {
        $karyawan = Karyawan::all();
        $produk = Produk::findOrFail($id);
        return view('produks.edit', compact('produk', 'karyawan'));
    }
    public function update(Request $request, $id)//menerima input untuk memperbarui data produk berdasarkan ID
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
    ];//Menyimpan data baru yang akan digunakan untuk memperbarui produk

    $produk->update($data);//Memperbarui produk dengan data baru yang diinput
    return redirect()->route('produks.index')->with('success', 'Data Produk berhasil diperbarui.');
}

    public function detail($id)//mengambil data produk beserta data karyawan yang terkait
    {

        $produk = Produk::with('karyawan')->findOrFail($id);        

        return view('produks.detail', compact('produk'));
    }

        public function destroy($id)//mencari produk berdasarkan ID untuk dihapus
    {
        $produk = Produk::findOrFail($id);

        if ($produk->delete()) {
            return redirect()->route('produks.index')->with('success', 'Produk berhasil dihapus.');
        } else {
            return redirect()->route('produks.index')->with('error', 'Produk gagal dihapus. Silakan coba lagi.');
        }
    }
}