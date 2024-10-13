<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
{
    // Mengambil data penjualan dari model 'Penjualan'
    $penjualans = Penjualan::all(); // Ambil semua data penjualan

    // Kirim data tersebut ke view 'TampilPenjualan'
    return view('Penjualan.TampilPenjualan', compact('penjualans'));

}

    public function create()
    {
        return view('Penjualan.TambahPenjualan');
    }

    public function store(Request $request)
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

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil ditambahkan.');
    } catch (\Exception $e) {
        return back()->with('error', 'Error: ' . $e->getMessage());
    }
}



    public function show($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $details = $penjualan->detailPenjualan;
        return view('Penjualan.DetailPenjualan', compact('penjualan', 'details'));
    }

    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        return view('Penjualan.EditPenjualan', compact('penjualan'));
    }

    public function update(Request $request, $id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->update($request->all());
        return redirect()->route('penjualan.index');
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();
        return redirect()->route('penjualan.index');
    }
}
