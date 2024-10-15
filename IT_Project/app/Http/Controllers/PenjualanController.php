<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Illuminate\Routing\Controller;

class PenjualanController extends Controller
{
    public function index()
{
    $penjualan = Penjualan::all(); // Ambil semua data penjualan

    return view('Penjualan.TampilPenjualan')->with('penjualan', $penjualan);
}

    public function Tampil()
{
    $penjualan = Penjualan::get(); // Ambil semua data penjualan

    return view('Penjualan.TampilPenjualan', compact('penjualan'));

}

    public function Tambah()
    {
        return view('Penjualan.TambahPenjualan');
    }

    public function submit(Request $request)
{
    try {
        // Validasi input (tanpa Id_Karyawan dan Id_Produk karena belum tersambung sebagai FK)
        $request->validate([
            'Total_Harga' => 'required|numeric',
            'Tanggal_Penjualan' => 'required|date',
            'Metode_Pembayaran' => 'required|string',
            'detail_penjualan.*.Harga_Satuan' => 'required|numeric',
            'detail_penjualan.*.Jumlah' => 'required|integer',
        ]);

        // Simpan Penjualan
        $penjualan = Penjualan::create([
            'Total_Harga' => $request->Total_Harga,
            // 'Id_Karyawan' => $request->Id_Karyawan, // Optional
            'Tanggal_Penjualan' => $request->Tanggal_Penjualan,
            'Metode_Pembayaran' => $request->Metode_Pembayaran,
        ]);

        // Simpan Detail Penjualan (tanpa Id_Produk karena belum tersambung sebagai FK)
        foreach ($request->detail_penjualan as $detail) {
            DetailPenjualan::create([
                'Id_Penjualan' => $penjualan->Id_Penjualan,
                // 'Id_Produk' => $detail['Id_Produk'], // Optional
                'Harga_Satuan' => $detail['Harga_Satuan'],
                'Jumlah' => $detail['Jumlah'],
            ]);
        }

        return redirect()->route('TampilPenjualan')->with('success', 'Penjualan berhasil ditambahkan.');
    } catch (Exception $e) {
        return back()->with('error', 'Error: ' . $e->getMessage());
    }
}



    public function Detail($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $details = $penjualan->detailPenjualan;
        return view('Penjualan.DetailPenjualan', compact('penjualan', 'details'));
    }

    public function Edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        return view('Penjualan.EditPenjualan', compact('penjualan'));
    }

    public function Update(Request $request, $id)
    {
        $penjualan = Penjualan::findOrFail($id);
        if ($penjualan) {
            $penjualan->update($request->all());
            return redirect()->route('TampilPenjualan')->with('success', 'Penjualan berhasil diupdate');
        }
        return redirect()->route('TampilPenjualan')->with('error', 'Penjualan tidak ditemukan');
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
}
