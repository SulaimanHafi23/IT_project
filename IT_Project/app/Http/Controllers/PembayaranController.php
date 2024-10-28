<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PembayaranController extends Controller
{

    public function lihat()
    {
        return view('Pembayaran.Pembayaran');
    }

    public function submit()
    {
        return redirect()->route('TampilPenjualan')->with('success', 'Pembayaran berhasil dilakukan!');
    }

    public function tambah()
    {
        return redirect()->route('KembaliTambahPenjualan');
    }

    public function detail($id_penjualan)
    {
        $penjualan = Penjualan::with('pembayaran')->where('Id_Penjualan', $id_penjualan)->first();

        if (!$penjualan) {
            return redirect()->back()->with('error', 'Data penjualan tidak ditemukan.');
        }

        return view('Pembayaran.DetailPembayaran', compact('penjualan'));
    }
}
