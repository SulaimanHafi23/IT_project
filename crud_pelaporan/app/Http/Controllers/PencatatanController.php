<?php

namespace App\Http\Controllers;

use App\Models\Pencatatan;
use Illuminate\Http\Request;

class PencatatanController extends Controller
{
    function tampil() {
        $Pencatatan = Pencatatan::get();
        return view('Pencatatan.tampil', compact('Pencatatan'));
    }

    function tambah() {
        return view('Pencatatan.tambah');
    }

    function submit(Request $request) {
        $pencatatan = new Pencatatan();
        $pencatatan->Tanggal_Pencatatan = $request->Tanggal_Pencatatan;
        $pencatatan->Tanggal_Mulai = $request->Tanggal_Mulai;
        $pencatatan->Tanggal_Akhir = $request->Tanggal_Akhir;
        $pencatatan->Id_Admin = $request->Id_Admin;
        $pencatatan->save();

        return redirect()->route('Pencatatan.tampil');
    }

    function edit($id) {
        $pencatatan = Pencatatan::find($id);
        return view('pencatatan.edit', compact('pencatatan'));
    }

    function update(Request $request, $id) {
        $pencatatan = Pencatatan::find($id);
        $pencatatan->Tanggal_Pencatatan = $request->Tanggal_Pencatatan;
        $pencatatan->Tanggal_Mulai = $request->Tanggal_Mulai;
        $pencatatan->Tanggal_Akhir = $request->Tanggal_Akhir;
        $pencatatan->Id_Admin = $request->Id_Admin;
        $pencatatan->update();

        return redirect()->route('Pencatatan.tampil');
    }

    function delete($id) {
        $pencatatan = Pencatatan::find($id);
        $pencatatan->delete();
        return redirect()->route('Pencatatan.tampil');
    }
}
