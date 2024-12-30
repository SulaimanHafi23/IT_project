<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LaporanController extends Controller
{
    public function tampil()
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            $laporan = Laporan::all();
            return view('Laporan.TampilLaporan', compact('laporan'));
        }
        return redirect()->back()->with('warning', 'Anda tidak memiliki akses untuk melakukan tindakan ini.');
    }

    public function tambah()
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            return view('Laporan.TambahLaporan');
        }
        return redirect()->back()->with('warning', 'Anda tidak memiliki akses untuk melakukan tindakan ini.');
    }

    public function submit(Request $request)
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            $request->validate([
                'tanggal_laporan' => 'required|date',
                'tanggal_mulai' => 'required|date',
                'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
            ]);

            Laporan::create([
                'tanggal_laporan' => $request->tanggal_laporan,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_akhir' => $request->tanggal_akhir,
            ]);

            return redirect()->route('TampilLaporan')->with('success', 'Laporan berhasil ditambahkan.');
        }
        return redirect()->back()->with('warning', 'Anda tidak memiliki akses untuk melakukan tindakan ini.');
    }

    public function edit($id)
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            $laporan = Laporan::find($id);

            if (!$laporan) {
                return redirect()->route('TampilLaporan')->with('error', 'Data laporan tidak ditemukan.');
            }

            return view('Laporan.EditLaporan', compact('laporan'));
        }
        return redirect()->back()->with('warning', 'Anda tidak memiliki akses untuk melakukan tindakan ini.');
    }

    public function update(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            $request->validate([
                'tanggal_mulai' => 'required|date',
                'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
            ]);

            $laporan = Laporan::findOrFail($id);

            $laporan->update([
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_akhir' => $request->tanggal_akhir,
            ]);

            return redirect()->route('TampilLaporan')->with('success', 'Laporan berhasil diperbarui.');
        }
        return redirect()->back()->with('warning', 'Anda tidak memiliki akses untuk melakukan tindakan ini.');
    }

    public function detail($id)
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            $laporan = Laporan::find($id);

            if (!$laporan) {
                return redirect()->route('TampilLaporan')->with('error', 'Data laporan tidak ditemukan.');
            }

            $penjualan = Penjualan::whereBetween('Tanggal_Penjualan', [
                $laporan->tanggal_mulai,
                $laporan->tanggal_akhir,
            ])->get();

            return view('Laporan.DetailLaporan', compact('laporan', 'penjualan'));
        }
        return redirect()->back()->with('warning', 'Anda tidak memiliki akses untuk melakukan tindakan ini.');
    }

    public function delete($id)
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            $laporan = Laporan::find($id);

            if (!$laporan) {
                return redirect()->route('TampilLaporan')->with('error', 'Data laporan tidak ditemukan.');
            }

            $laporan->delete();

            return redirect()->route('TampilLaporan')->with('success', 'Data laporan berhasil dihapus.');
        }
        return redirect()->back()->with('warning', 'Anda tidak memiliki akses untuk melakukan tindakan ini.');
    }

    public function cetak(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            $laporan = Laporan::find($id);

            if (!$laporan) {
                return redirect()->route('TampilLaporan')->with('error', 'Data laporan tidak ditemukan.');
            }

            $penjualan = Penjualan::whereBetween('Tanggal_Penjualan', [
                $laporan->tanggal_mulai,
                $laporan->tanggal_akhir,
            ])->get();

            $pendapatan = Penjualan::whereBetween('Tanggal_Penjualan', [
                $laporan->tanggal_mulai,
                $laporan->tanggal_akhir,
            ])->sum('Total_Harga');

            return view('Laporan.CetakLaporan', compact('laporan', 'penjualan', 'pendapatan'));
        }
        return redirect()->back()->with('warning', 'Anda tidak memiliki akses untuk melakukan tindakan ini.');
    }
}
