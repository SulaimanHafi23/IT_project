<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Karyawan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller {
    public function beranda(Request $request) {
        // Pastikan pengguna sudah login dan memiliki level 'admin'
        if (Auth::check() && Auth::user()->level === 'admin') {
            // Mengambil tanggal hari ini dalam format Y-m-d untuk query
            $today = now()->toDateString();

            // Menghitung jumlah penjualan hari ini
            $penjualan = Penjualan::whereDate('Tanggal_Penjualan', $today)->count();

            // Menghitung total produk
            $produks = Produk::count();

            // Menghitung total karyawan
            $karyawan = Karyawan::count();

            // Menghitung total pendapatan hari ini
            $pendapatan = Penjualan::whereDate('Tanggal_Penjualan', $today)->sum('Total_Harga');

            // Mengambil data produk dan menghitung jumlah terjual
            $produkTerjual = Produk::withSum('detailPenjualan as Jumlah', 'Jumlah')
                ->paginate(5);

            $user = Auth::user();

            // Ambil data karyawan berdasarkan Id_User
            $karyawans = Karyawan::where( 'Id_User', $user->id )->first();
            // Jika request melalui AJAX, hanya kirimkan tabel produk
            if ($request->ajax()) {
                return view('partials.produk-table', compact('produkTerjual'))->render();
                return view('Layouts.sidebar', compact('karyawans'))->render();
            }

            return view('beranda', [
                'penjualan' => $penjualan,
                'produk' => $produks,
                'karyawan' => $karyawan,
                'pendapatan' => $pendapatan,
                'produkTerjual' => $produkTerjual,
            ]);
        } else {
            // Redirect jika pengguna bukan admin
            return redirect()->route('produks.index');
        }
    }

    public function profile() {
        // Pastikan user sudah login
        if ( Auth::check() ) {
            // Ambil data user yang login
            $user = Auth::user();

            // Ambil data karyawan berdasarkan Id_User
            $karyawan = Karyawan::where( 'Id_User', $user->id )->first();

            // Jika karyawan tidak ditemukan, kembalikan pesan error
            if ( !$karyawan ) {
                return redirect()->back()->with('!karyawan', true);
            }

            // Kirim data karyawan ke view
            return view( 'profile', compact( 'karyawan' ) );
        } else {
            return redirect()->route( 'login' )->with( 'error', 'Anda harus login terlebih dahulu.' );
        }
    }

}
