<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Karyawan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BerandaController extends Controller
{
    public function beranda()
    {
        // Mengambil tanggal hari ini dalam format Y-m-d untuk query
        $today = now()->toDateString();

        // Menghitung jumlah penjualan hari ini
        $penjualan = Penjualan::whereDate('Tanggal_Penjualan', $today)->count();

        // Menghitung total produk
        $produk = Produk::count();

        // Menghitung total karyawan
        $karyawan = Karyawan::count();

        // Menghitung total pendapatan hari ini
        $pendapatan = Penjualan::whereDate('Tanggal_Penjualan', $today)->sum('Total_Harga');

        // Mengirim data ke view
        return view('beranda', compact('penjualan', 'produk', 'karyawan', 'pendapatan'));
    }
}
