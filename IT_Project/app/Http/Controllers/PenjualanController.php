<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Produk;
use App\Models\Karyawan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
{
    $penjualan = Penjualan::all(); // Ambil semua data penjualan

    return view('Penjualan.TampilPenjualan')->with('penjualan', $penjualan);
}

    public function Tampil()
{
    $penjualan = Penjualan::all(); // Atau bisa menggunakan query sesuai kebutuhan
    return view('Penjualan.TampilPenjualan', compact('penjualan'));
}


    public function tambah()
    {
    // Fetch products from database, adjust based on your models

    $penjualan_count = Penjualan::count(); // Get total count for ID generation
    $total = 0; // Initialize total or calculate based on current cart
    $produk = Produk::all(); // Ambil semua produk
    $karyawan = Karyawan::all(); // Ambil semua karyawan
    return view('penjualan.TambahPenjualan', compact('produk', 'penjualan_count', 'total',  'karyawan'));
    }


    public function submit(Request $request)
{
    $idPenjualan = 'AH' . date('Ymd') . str_pad(Penjualan::count() + 1, 3, '0', STR_PAD_LEFT);

    // Validasi input
    $request->validate([
        'Id_Karyawan' => 'required',
        'Tanggal_Penjualan' => 'required|date',
        'produk_id' => 'required|array',
        'Jumlah' => 'required|array',
        'Jumlah.*' => 'required|integer|min:1',
    ]);

    // Buat data penjualan
    $penjualan = Penjualan::create([
        'Id_Penjualan' => $idPenjualan,
        'Id_Karyawan' => $request->Id_Karyawan,
        'Tanggal_Penjualan' => $request->Tanggal_Penjualan,
        'Metode_Pembayaran' => $request->Metode_Pembayaran,
        'Total_Harga' => $request->Total_Harga,
    ]);

    // Menyimpan detail penjualan
    foreach ($request->produk_id as $index => $produkId) {
        // Ambil harga satuan dari produk
        $produk = Produk::findOrFail($produkId);
        $Harga_Satuan = $produk->Harga_Satuan;

        DetailPenjualan::create([
            'Id_Penjualan' => $penjualan->Id_Penjualan, // Pastikan ini adalah string
            'Id_Produk' => $produkId,
            'Harga_Satuan' => $Harga_Satuan,
            'Jumlah' => $request->Jumlah[$index],
        ]);
    }

    return redirect()->route('TampilPenjualan')->with('success', 'Penjualan berhasil ditambahkan');
}

public function Detail($id)
{
    $penjualan = Penjualan::findOrFail($id);
    $detail_penjualan = DetailPenjualan::where('Id_Penjualan', $id)
        ->join('produk', 'detail_penjualan.Id_Produk', '=', 'produk.Id_Produk')
        ->select('detail_penjualan.*', 'produk.Nama_Produk', 'produk.Harga_Satuan')
        ->get();    

    return view('Penjualan.DetailPenjualan', compact('penjualan', 'detail_penjualan'));
}



public function edit($id)
{
    $penjualan = Penjualan::with('detailPenjualan.produk')->findOrFail($id);
    $karyawan = Karyawan::all();
    $produk = Produk::all();

    return view('penjualan.EditPenjualan', compact('penjualan', 'karyawan', 'produk'));
}


public function update(Request $request, $id)
{
    // Validasi data yang diterima
    $request->validate([
        'Id_Karyawan' => 'required|exists:karyawan,Id_Karyawan',
        'Tanggal_Penjualan' => 'required|date',
        'Metode_Pembayaran' => 'required|string',
        'Total_Harga' => 'required|numeric',
        'produk_id' => 'required|array',
        'produk_id.*' => 'required|exists:produk,Id_Produk',
        'Jumlah' => 'required|array',
        'Jumlah.*' => 'required|integer|min:1',
    ]);

    // Temukan penjualan berdasarkan ID
    $penjualan = Penjualan::findOrFail($id);

    // Perbarui informasi penjualan
    $penjualan->update([
        'Id_Karyawan' => $request->Id_Karyawan,
        'Tanggal_Penjualan' => $request->Tanggal_Penjualan,
        'Metode_Pembayaran' => $request->Metode_Pembayaran,
        'Total_Harga' => $request->Total_Harga,
    ]);

    // Hapus semua detail penjualan yang ada
    DetailPenjualan::where('Id_Penjualan', $penjualan->Id_Penjualan)->delete();

    // Tambahkan detail penjualan baru
    $produkIds = $request->input('produk_id', []); // Default to an empty array
    $jumlahs = $request->input('Jumlah', []); // Default to an empty array

    foreach ($request->produk_id as $index => $produkId) {
        DetailPenjualan::create([
            'Id_Penjualan' => $penjualan->Id_Penjualan,
            'Id_Produk' => $produkId,
            'Harga_Satuan' => $request->Harga_Satuan[$index], // Ambil dari input
            'Jumlah' => $request->Jumlah[$index],
        ]);
    }

    return redirect()->route('TampilPenjualan')->with('success', 'Data penjualan berhasil diperbarui.');
}




    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        if ($penjualan) {
            $penjualan->delete(); // Menghapus data akun
            return redirect()->route('TampilPenjualan')->with('success', 'penjualan berhasil dihapus');
        }
        return redirect()->route('TampilPenjualan')->with('error', 'Penjualan tidak ditemukan');

    }

    public function generateIdPenjualan()
{
    $tanggalSekarang = Carbon::now()->format('dmY'); // Format tanggal seperti '12062024'
    $inisialUsaha = 'AH'; // Prefix usaha

    // Menghitung nomor urut berdasarkan transaksi yang dibuat hari ini
    $nomorUrutHariIni = DB::table('penjualan')
        ->whereDate('created_at', Carbon::today()) // Membatasi pada transaksi hari ini
        ->count() + 1; // Menambah 1 untuk nomor urut

    // Format ID Penjualan: AH + tanggal + nomor urut
    $idPenjualan = $inisialUsaha . $tanggalSekarang . str_pad($nomorUrutHariIni, 3, '0', STR_PAD_LEFT);

    return response()->json(['Id_Penjualan' => $idPenjualan]);
}

}
