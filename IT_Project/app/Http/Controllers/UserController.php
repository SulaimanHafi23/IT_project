<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Auth\Events\Registered;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Contracts\RegisterViewResponse;

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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'level' => 'required'
        ]);

        if ($request->level === 'admin'){
            $admin = new Admin();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = bcrypt($request->password);
            $admin->save();
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); 
        $user->save();

        return redirect()->route('TampilAkun')->with('success', 'Akun berhasil ditambahkan');
    }
    
    function edit($id){
        $user = User::find($id); 
        return view('Akun.EditAkun', compact('user')); 
    }

    public function update(Request $request, $id) {
        
        $user = User::find($id);
        
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); 
        $user->update();

        return redirect()->route('TampilAkun')->with('success', 'Akun berhasil diupdate');
    }

    public function delete($id) {
        $user = User::find($id); 
        $user->delete(); 
        return redirect()->route('TampilAkun')->with('success', 'Akun berhasil dihapus');
    }
}
