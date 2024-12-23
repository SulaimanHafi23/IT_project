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

class PenjualanController extends Controller{

    public function Tampil(){
        $penjualan = Penjualan::all(); 
        return view('Penjualan.TampilPenjualan', compact('penjualan'));
    }

    public function tambah(){
        $penjualan_count = Penjualan::count();
        $idPenjualan = 'AH' . str_pad($penjualan_count + 1, 5, '0', STR_PAD_LEFT);
        $total = 0; 
        $produk = Produk::all(); 
        $karyawan = Karyawan::all(); 
        return view('penjualan.TambahPenjualan', compact('produk', 'penjualan_count', 'total', 'karyawan', 'idPenjualan'));
    }

    public function submit(Request $request){
        $idPenjualan = $this->generateIdPenjualan();

        $request->validate([
            'Id_Karyawan' => 'required',
            'Tanggal_Penjualan' => 'required|date',
            'Id_Produk' => 'required|array',
            'Jumlah' => 'required|array',
            'Jumlah.*' => 'required|integer|min:1',
        ]);

        $penjualan = Penjualan::create([
            'Id_Penjualan' => $idPenjualan,
            'Id_Karyawan' => $request->Id_Karyawan,
            'Tanggal_Penjualan' => $request->Tanggal_Penjualan,
            'Metode_Pembayaran' => $request->Metode_Pembayaran,
            'Total_Harga' => $request->Total_Harga,
        ]);

        $errors = []; 

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
            return redirect()->back()->withErrors($errors);
        }

        if ($request->Metode_Pembayaran === 'Tunai') {
            return redirect()->route('TampilPenjualan')->with('success', 'Penjualan berhasil ditambahkan.');
        } else if ($request->Metode_Pembayaran === 'Transfer') {
            return redirect()->route('LihatPembayaran')->with('success', 'Penjualan berhasil ditambahkan. Silakan lanjutkan ke pembayaran.');
        }
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

    public function destroy($Id) {
        $penjualan = Penjualan::find($Id); 
        $penjualan->delete();
        return redirect()->route('TampilPenjualan')->with('success', 'Data Penjualan berhasil dihapus');
    }

    public function generateIdPenjualan(){
        $inisialUsaha = 'AH';
        $nomorUrut = Penjualan::count() + 1;
        $idPenjualan = $inisialUsaha . str_pad($nomorUrut, 5, '0', STR_PAD_LEFT);
    
        return $idPenjualan;
    }
    
}
