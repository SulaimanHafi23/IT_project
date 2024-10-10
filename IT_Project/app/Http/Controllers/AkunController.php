<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use App\Http\Controllers\AkunController;

class AkunController extends Controller
{
    public function index() {
        $akun = Akun::all();
        return view('TampilAkun')->with('akun', $akun);
    }

    function Tampil(){
        $akun = Akun::get();
        
        return view('TampilAkun', compact('akun'));
    }

    function Tambah(){
        return view('TambahAkun');
    }

    function submit(Request $request){
        $akun = new Akun();
        $akun->id_akun =$request->id_akun;
        $akun->username =$request->username;
        $akun->password =$request->password;
        $akun->level =$request->level;
        $akun->save();

        return redirect('TampilAkun');
    }

    function Edit($Id){
        $akun = Akun::find($Id);
        return view('EditAkun', compact('akun'));
    }

    function Update(Request $request, $Id){
        $akun = Akun::find($Id);
        $akun->id_akun =$request->id_akun;
        $akun->username =$request->username;
        $akun->password =$request->password;
        $akun->level =$request->level;
        $akun->update();

        return redirect('TampilAkun');
    }

    public function destroy($Id) {
        $akun = Akun::find($Id);
        if ($akun) {
            $akun->delete();
            return redirect()->route('Akun')->with('success', 'Akun berhasil dihapus');
        }
        return redirect()->route('Akun')->with('error', 'Akun tidak ditemukan');
    }
}
