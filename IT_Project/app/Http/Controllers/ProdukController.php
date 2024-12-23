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

    public function store(Request $request)
{
    // Validasi input form
    $request->validate([
        'Nama_Produk' => 'required',
        'Kategori' => 'required',
        'Harga_Satuan' => 'required|numeric',
        'Tanggal_Masuk' => 'required|date',
        'Stok' => 'required|numeric',
        'Keterangan' => 'nullable|string',
        'Id_Karyawan' => 'required|exists:karyawan,Id_Karyawan',
    ]);

    // Cek apakah produk dengan nama yang sama sudah ada
    $produk = Produk::where('Nama_Produk', $request->Nama_Produk)->first();

    if ($produk) {
        // Tambahkan stok baru ke stok lama
        $produk->update([
            'Kategori' => $request->Kategori,
            'Harga_Satuan' => $request->Harga_Satuan,
            'Tanggal_Masuk' => $request->Tanggal_Masuk,
            'Stok' => $produk->Stok + $request->Stok, // Tambahkan stok lama dengan stok baru
            'Keterangan' => $request->Keterangan,
            'Id_Karyawan' => $request->Id_Karyawan,
        ]);
        $message = 'Produk berhasil diperbarui dan stok telah ditambahkan!';
    } else {
        // Buat data baru jika belum ada
        Produk::create($request->all());
        $message = 'Produk berhasil ditambahkan!';
    }

    // Redirect ke halaman indeks produk dengan pesan sukses
    return redirect()->route('produks.index')->with('success', $message);
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
        'Nama_Produk' => $request->Nama_Produk,
        'Kategori' => $request->Kategori,
        'Harga_Satuan' => $request->Harga_Satuan,
        'Stok' => $request->Stok,
        'Shift_Kerja' => $request->Shift_Kerja,
        'Keterangan' => $request->Keterangan,
    ];

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