<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\PenjualanController;

Route::view('/', 'Beranda')->name('Beranda'); 
Route::view('Akun.TampilAkun', 'Akun.TampilAkun')->name('TampilAkun');
Route::view('Penjualan.TampilPenjualan', 'Penjualan.TampilPenjualan')->name('TampilPenjualan');
Route::view('Produk', 'Produk')->name('Produk');
Route::view('Karyawan', 'Karyawan')->name('Karyawan');
Route::view('Laporan', 'Laporan ')->name('Laporan');

// Rute untuk Akun
Route::get('/akun', [AkunController::class, 'Tampil'])->name('TampilAkun');
Route::get('/buat/akun', [AkunController::class, 'Tambah'])->name('TambahAkun');
Route::post('/buat/akun', [AkunController::class, 'submit'])->name('buatAkun');
Route::get('/edit-akun/{Id}', [AkunController::class, 'Edit'])->name('EditAkun');
Route::post('/update-akun/{Id}', [AkunController::class, 'update'])->name('UpdateAkun');
Route::delete('/delete-akun/{id}', [AkunController::class, 'destroy'])->name('DeleteAkun');

// Rute resource untuk penjualan
Route::resource('penjualan', PenjualanController::class);
