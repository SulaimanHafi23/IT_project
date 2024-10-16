<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenjualanController;

Route::view('/', 'Beranda')->name('Beranda'); 
Route::view('Akun.TampilAkun', 'Akun.TampilAkun')->name('TampilAkun');
Route::view('Penjualan.TampilPenjualan', 'Penjualan.TampilPenjualan')->name('TampilPenjualan');
Route::view('Produk', 'Produk')->name('Produk');
Route::view('Karyawan', 'Karyawan')->name('Karyawan');
Route::view('Laporan.TampilLaporan', 'Laporan.TampilLaporan ')->name('TampilLaporan');
Route::view('Login', 'Login ')->name('login');

// route untuk login 
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login');

// Rute untuk Akun
Route::get('/akun', [UserController::class, 'Tampil'])->name('TampilAkun');
Route::get('/buat/akun', [UserController::class, 'Tambah'])->name('TambahAkun');
Route::post('/buat/akun', [UserController::class, 'submit'])->name('buatAkun');
Route::get('/edit-akun/{Id}', [UserController::class, 'Edit'])->name('EditAkun');
Route::post('/update-akun/{Id}', [UserController::class, 'update'])->name('UpdateAkun');
Route::delete('/delete-akun/{id}', [UserController::class, 'destroy'])->name('DeleteAkun');

// Rute resource untuk penjualan
Route::get('/penjulan', [PenjualanController::class, 'Tampil'])->name('TampilPenjualan');
Route::get('/buat/penjualan', [PenjualanController::class, 'Tambah'])->name('TambahPenjualan');
Route::post('/buat/penjualan', [PenjualanController::class, 'submit'])->name('BuatPenjualan');
Route::get('/edit-penjualan/{id}', [PenjualanController::class, 'Edit'])->name('EditPenjualan');
Route::get('/Detail-penjualan/{id}', [PenjualanController::class, 'Detail'])->name('DetailPenjualan');
Route::post('/update-penjualan/{id}', [PenjualanController::class, 'update'])->name('UpdatePenjualan');
Route::delete('/delete-penjualan/{id}', [PenjualanController::class, 'destroy'])->name('DeletePenjualan');

// Route untuk Laporan
Route::get('/laporan', [LaporanController::class, 'Tampil'])->name('TampilLaporan');
Route::get('/buat/laporan', [LaporanController::class, 'Tambah'])->name('TambahLaporan');
Route::post('/buat/laporan', [LaporanController::class, 'submit'])->name('BuatLaporan');
Route::get('/edit-laporan/{id}', [LaporanController::class, 'Edit'])->name('EditLaporan');
Route::get('/Detail-laporan/{id}', [LaporanController::class, 'Detail'])->name('DetailLaporan');
Route::post('/update-laporan/{id}', [LaporanController::class, 'update'])->name('UpdateLaporan');
Route::put('/update-laporan/{id}', [LaporanController::class, 'update'])->name('UpdateLaporan');
Route::delete('/delete-laporan/{id}', [LaporanController::class, 'delete'])->name('DeleteLaporan');