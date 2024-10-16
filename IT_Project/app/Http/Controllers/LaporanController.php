<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LaporanController extends Controller
{
    function tampil() {
        $laporan = Laporan::get();
        return view('Laporan.TampilLaporan', compact('laporan'));
    }

    function tambah() {
        return view('Laporan.TambahLaporan');
    }

    function submit(Request $request) {
        $laporan = new Laporan();
        $laporan->tanggal_laporan = $request->tanggal_laporan;
        $laporan->tanggal_mulai = $request->tanggal_mulai;
        $laporan->tanggal_akhir = $request->tanggal_akhir;
        $laporan->save();

        return redirect()->route('TampilLaporan');
    }

    function edit($id) {
        $laporan = Laporan::find($id);
        return view('Laporan.EditLaporan', compact('laporan'));
    }

    function update(Request $request, $id) {
        $laporan = Laporan::find($id);
        $laporan->tanggal_mulai = $request->tanggal_mulai;
        $laporan->tanggal_akhir = $request->tanggal_akhir;
        $laporan->update();

        return redirect()->route('TampilLaporan');
    }

    public function detail($id) {
        $laporan = Laporan::find($id);
        
        // Ambil penjualan berdasarkan tanggal mulai dan akhir dari laporan
        $penjualan = Penjualan::whereBetween('Tanggal_Penjualan', [$laporan->tanggal_mulai, $laporan->tanggal_akhir])->get();
        
        return view('Laporan.DetailLaporan', compact('laporan', 'penjualan'));
    }    

    function delete($id) {
        $laporan = Laporan::find($id);
        $laporan->delete();
        return redirect()->route('TampilLaporan');
    }
}
