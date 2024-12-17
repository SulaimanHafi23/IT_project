<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function Tampil(){
        $user = User::get(); 
        return view('Akun.TampilAkun', compact('user'));
    }
    
    function Tambah(){
        return view('Akun.TambahAkun');
    }

    
    function submit(Request $request){

        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'level' => 'required'
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->password = bcrypt($request->password); 
        $user->level = $request->level;
        $user->save();

        return redirect()->route('TampilAkun')->with('success', 'Akun berhasil ditambahkan');
    }

    function Edit($Id){
        $user = User::find($Id); 
        return view('Akun.EditAkun', compact('user')); 
    }

    public function update(Request $request, $id) {

        $request->validate([
            'Username' => 'required',
            'Password' => 'required',
        ]);
        $user = User::find($id);
    
        $user->Username = $request->Username;
        $user->Password = bcrypt($request->Password); 
        $user->update();

        return redirect()->route('TampilAkun')->with('success', 'Akun berhasil diupdate');
    }

    public function delete($Id) {
        $akun = User::find($Id); 
        $akun->delete(); 
        return redirect()->route('TampilAkun')->with('success', 'Akun berhasil dihapus');
    }


    public function login(Request $request)
    {
        $login = $request->validate([
            'Username' => 'required',
            'Password' => 'required'
        ]);

        if (Auth::attempt(['Username' => $login['Username'], 'Password' => $login['Password']])) {
            $request->session()->regenerate();
            return redirect()->route('Beranda')->with('success', 'Login berhasil!');
        }

        return redirect()->back()->withErrors(['error' => 'Usernamea tau password salah.']);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}
