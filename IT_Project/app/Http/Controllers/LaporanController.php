<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

        $request->validate([
            'tanggal_laporan' => 'required|date',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai', 
        ]);
    
        try {
            $laporan = new Laporan();
            $laporan->tanggal_laporan = $request->tanggal_laporan;
            $laporan->tanggal_mulai = $request->tanggal_mulai;
            $laporan->tanggal_akhir = $request->tanggal_akhir;
            $laporan->save();
            return redirect()->route('TampilLaporan')->with('success', 'Laporan berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()->route('TampilLaporan')->with('error', 'Gagal menambahkan laporan: ' . $e->getMessage());
        }
    }
    

    function edit($id) {
        $laporan = Laporan::find($id);
        return view('Laporan.EditLaporan', compact('laporan'));
    }

    function update(Request $request, $id) {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai', 
        ]);
    
        try {
            $laporan = Laporan::findOrFail($id); 
            $laporan->tanggal_mulai = $request->tanggal_mulai;
            $laporan->tanggal_akhir = $request->tanggal_akhir;
            $laporan->save();
    
            return redirect()->route('TampilLaporan')->with('success', 'Laporan berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('TampilLaporan')->with('error', 'Gagal memperbarui laporan: ' . $e->getMessage());
        }
    }
    

    public function detail($id) {
        $laporan = Laporan::find($id);
        $penjualan = Penjualan::whereBetween('Tanggal_Penjualan', [$laporan->tanggal_mulai, $laporan->tanggal_akhir])->get();
        
        return view('Laporan.DetailLaporan', compact('laporan', 'penjualan'));
    }    

    function delete($id) {
        try {
            $laporan = Laporan::findOrFail($id);
            $laporan->delete();
    
            return redirect()->route('TampilLaporan')->with('success', 'Laporan berhasil dihapus');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('TampilLaporan')->with('error', 'Laporan tidak ditemukan');
        } catch (Exception $e) {
            return redirect()->route('TampilLaporan')->with('error', 'Gagal menghapus laporan: ' . $e->getMessage());
        }
    }
    
}
