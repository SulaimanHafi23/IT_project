<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PembayaranController extends Controller
{
    // Menampilkan halaman pembayaran dengan QR Code
    public function lihat()
    {
        return view('Pembayaran.Pembayaran'); // menampilkan view 'pembayaran' yang kamu buat
    }
    public function Tampil()
{
    $penjualan = Penjualan::all(); // Atau bisa menggunakan query sesuai kebutuhan
    return view('Penjualan.TampilPenjualan', compact('penjualan'));
}

    // Fungsi ini dipanggil ketika pembayaran selesai dan redirect ke halaman penjualan
    public function kembali()
    {
        return redirect()->route('TampilPenjualan')->with('success', 'Pembayaran berhasil dilakukan!');
    }

    // Fungsi untuk menambahkan penjualan jika kembali
    public function tambah()
    {
        return redirect()->route('KembaliTambahPenjualan');
    }

    public function detail($id_penjualan)
    {
        // $penjualan = Penjualan::find($id_penjualan);
        // Mengambil data penjualan berdasarkan id_penjualan
        $penjualan = Penjualan::with('pembayaran')->where('Id_Penjualan', $id_penjualan)->first();

        if (!$penjualan) {
            return redirect()->back()->with('error', 'Data penjualan tidak ditemukan.');
        }

        return view('Pembayaran.DetailPembayaran', compact('penjualan'));
    }
}
