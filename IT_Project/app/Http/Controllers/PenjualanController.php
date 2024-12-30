<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Produk;
use App\Models\Karyawan;
use App\Models\Penjualan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PenjualanController extends Controller
{
    public function Tampil()
    {
        $penjualan = Penjualan::all();

        return view('Penjualan.TampilPenjualan', compact('penjualan'));
    }

    public function tambah()
    {
        $idPenjualan = $this->generateIdPenjualan();
        $total = 0;

        $produk = Produk::all();
        $karyawan = Karyawan::all();

        return view('penjualan.TambahPenjualan', compact('produk', 'total', 'karyawan', 'idPenjualan'));
    }

    public function submit(Request $request)
    {
        $idPenjualan = $this->generateIdPenjualan();

        $request->validate([
            'Tanggal_Penjualan' => 'required|date',
            'Id_Produk' => 'required|array',
            'Jumlah' => 'required|array',
            'Jumlah.*' => 'required|integer|min:1',
        ]);

        $user = auth()->user();

        // Cek apakah user memiliki relasi dengan karyawan
        $karyawan = Karyawan::where('Id_User', $user->id)->first();

        if (!$karyawan) {
            return redirect()->back()->with('error', 'Akun Anda tidak terhubung dengan data karyawan. Silakan hubungi admin.');
        }

        // Buat data penjualan baru
        $penjualan = Penjualan::create([
            'Id_Penjualan' => $idPenjualan,
            'Id_Karyawan' => $karyawan->Id_Karyawan,
            'Tanggal_Penjualan' => $request->Tanggal_Penjualan,
            'Metode_Pembayaran' => $request->Metode_Pembayaran,
            'Total_Harga' => $request->Total_Harga,
        ]);

        $errors = [];

        // Proses detail penjualan dan stok produk
        foreach ($request->Id_Produk as $index => $Id_Produk) {
            $produk = Produk::findOrFail($Id_Produk);
            $hargaSatuan = $produk->Harga_Satuan;
            $jumlah = $request->Jumlah[$index];

            if ($produk->Stok >= $jumlah) {
                DetailPenjualan::create([
                    'Id_Penjualan' => $penjualan->Id_Penjualan,
                    'Id_Produk' => $Id_Produk,
                    'Harga_Satuan' => $hargaSatuan,
                    'Jumlah' => $jumlah,
                ]);

                $produk->Stok -= $jumlah;
                $produk->save();
            } else {
                $errors[] = 'Stok produk ' . $produk->Nama_Produk . ' tidak mencukupi untuk jumlah yang diminta.';
            }
        }

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Pesan sukses berdasarkan metode pembayaran
        if ($request->Metode_Pembayaran === 'Tunai') {
            return redirect()->route('TampilPenjualan')->with('success', 'Penjualan berhasil ditambahkan.');
        } else if ($request->Metode_Pembayaran === 'Transfer') {
            return redirect()->route('LihatPembayaran')->with('success', 'Penjualan berhasil ditambahkan. Silakan lanjutkan ke pembayaran.');
        }

        return redirect()->route('TampilPenjualan')->with('success', 'Penjualan berhasil diproses.');
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

    public function destroy($Id)
    {
        $penjualan = Penjualan::find($Id);

        if (!$penjualan) {
            return redirect()->route('TampilPenjualan')->with('error', 'Data Penjualan tidak ditemukan.');
        }

        $penjualan->delete();
        return redirect()->route('TampilPenjualan')->with('success', 'Data Penjualan berhasil dihapus.');
    }

    public function generateIdPenjualan()
    {
        $inisialUsaha = 'AH';
    
        // Ambil ID Penjualan terakhir
        $penjualanTerakhir = Penjualan::orderBy('Id_Penjualan', 'desc')->first();
    
        // Jika tidak ada penjualan sebelumnya, nomor urut dimulai dari 1
        $nomorUrut = 1;
    
        if ($penjualanTerakhir) {
            // Ambil nomor urut dari ID Penjualan terakhir, yang berada setelah inisial
            $lastId = $penjualanTerakhir->Id_Penjualan;
            $nomorUrut = (int)substr($lastId, 2) + 1; // Ambil angka setelah 'AH' dan tambahkan 1
        }
    
        // Generate ID Penjualan dengan nomor urut yang baru
        $idPenjualan = $inisialUsaha . str_pad($nomorUrut, 5, '0', STR_PAD_LEFT);
    
        return $idPenjualan;
    }    
}
