<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;

Route::get('/', function (){
    return view('Beranda');
});

Route::view('/', 'Beranda')->name('Beranda'); 
Route::view('TampilAkun', 'TampilAkun')->name('TampilAkun');
Route::view('TambahAkun', 'TambahAkun')->name('TambahAkun');
Route::view('Admin', 'Admin')->name('Admin');
Route::view('Produk', 'Produk')->name('Produk');
Route::view('Karyawan', 'Karyawan')->name('Karyawan');
Route::view('Penjualan', 'Penjualan')->name('Penjualan');
Route::view('Penjualan', 'Penjualan')->name('Penjualan');
Route::view('Laporan', 'Laporan ')->name('Laporan');

//blog post related routes
Route::get('/akun', [AkunController::class, 'Tampil'])->name('Akun');
Route::get('/TampilAkun', [AkunController::class, 'Tampil']);
Route::get('/buat/akun', [AkunController::class, 'Tambah'])->name('TambahAkun');
Route::post('/buat/akun', [AkunController::class, 'submit'])->name('buatAkun');
Route::get('/edit-akun/{Id_Akun}', [AkunController::class, 'Edit'])->name('EditAkun');
Route::post('/update-akun/{Id_Akun}', [AkunController::class, 'update'])->name('UpdateAkun');
Route::delete('/delete-akun/{id}', [AkunController::class, 'destroy'])->name('DeleteAkun');