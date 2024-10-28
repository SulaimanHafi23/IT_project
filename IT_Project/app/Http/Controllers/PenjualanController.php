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
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PenjualanController extends Controller{

    public function Tampil(){
        $penjualan = Penjualan::all(); 
        return view('Penjualan.TampilPenjualan', compact('penjualan'));
    }


    public function tambah(){
        $penjualan_count = Penjualan::count();
        $total = 0; 
        $produk = Produk::all(); 
        $karyawan = Karyawan::all(); 
        return view('penjualan.TambahPenjualan', compact('produk', 'penjualan_count', 'total',  'karyawan'));
    }

    public function submit(Request $request){
        $idPenjualan = 'AH' . now()->format('dmY') . str_pad(Penjualan::count() + 1, 3, '0', STR_PAD_LEFT);

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
            return redirect()->route('Pembayaran')->with('success', 'Penjualan berhasil ditambahkan. Silakan lanjutkan ke pembayaran.');
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



public function edit($id){
    $penjualan = Penjualan::with('detailPenjualan.produk')->findOrFail($id);
    $karyawan = Karyawan::all();
    $produk = Produk::all();

    return view('penjualan.EditPenjualan', compact('penjualan', 'karyawan', 'produk'));
}


public function update(Request $request, $id){
    $request->validate([
        'Id_Karyawan' => 'required',
        'Tanggal_Penjualan' => 'required|date',
        'Id_Produk' => 'required|array',
        'Jumlah' => 'required|array',
        'Jumlah.*' => 'required|integer|min:1',
        'Metode_Pembayaran' => 'required|string',
        'Total_Harga' => 'required|numeric|min:0',
    ]);


    DB::beginTransaction();
    try {

        $penjualan = Penjualan::findOrFail($id);

        $detailPenjualanLama = DetailPenjualan::where('Id_Penjualan', $penjualan->Id_Penjualan)->get();


        foreach ($detailPenjualanLama as $detail) {
            $produk = Produk::findOrFail($detail->Id_Produk);
            $produk->Stok += $detail->Jumlah; 
            $produk->save();
        }


        DetailPenjualan::where('Id_Penjualan', $penjualan->Id_Penjualan)->delete();


        $penjualan->update([
            'Id_Karyawan' => $request->Id_Karyawan,
            'Tanggal_Penjualan' => $request->Tanggal_Penjualan,
            'Metode_Pembayaran' => $request->Metode_Pembayaran,
            'Total_Harga' => $request->Total_Harga,
        ]);


        foreach ($request->Id_Produk as $index => $Id_Produk) {

            $produk = Produk::findOrFail($Id_Produk);
            $Harga_Satuan = $produk->Harga_Satuan;


            if ($produk->Stok >= $request->Jumlah[$index]) {
                $produk->Stok -= $request->Jumlah[$index];
                $produk->save();
            } else {

                DB::rollBack(); 
                return redirect()->back()->withErrors(['error' => 'Stok produk ' . $produk->Nama_Produk . ' tidak mencukupi.']);
            }


            DetailPenjualan::create([
                'Id_Penjualan' => $penjualan->Id_Penjualan,
                'Id_Produk' => $Id_Produk,
                'Harga_Satuan' => $Harga_Satuan,
                'Jumlah' => $request->Jumlah[$index],
            ]);
        }


        DB::commit();
        return redirect()->route('TampilPenjualan')->with('success', 'Penjualan berhasil diperbarui.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
}

public function destroy($id)
{
    try {
        $penjualan = Penjualan::findOrFail($id); 
        $penjualan->delete();
        return redirect()->route('TampilPenjualan')->with('success', 'Penjualan berhasil dihapus');
    } catch (ModelNotFoundException $e) {
        return redirect()->route('TampilPenjualan')->with('error', 'Data penjualan tidak ditemukan');
    }
}

    public function generateIdPenjualan(){
        $tanggalSekarang = Carbon::now()->format('dmY'); 
        $inisialUsaha = 'AH';

        
        $nomorUrutHariIni = DB::table('penjualan')
            ->whereDate('created_at', Carbon::today()) 
            ->count() + 1; 


        $idPenjualan = $inisialUsaha . $tanggalSekarang . str_pad($nomorUrutHariIni, 3, '0', STR_PAD_LEFT);

        return response()->json(['Id_Penjualan' => $idPenjualan]);
    }

}
