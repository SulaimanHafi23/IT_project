<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenjualanController;

Route::view('/', 'Beranda')->name('Beranda'); 
Route::view('Akun.TampilAkun', 'Akun.TampilAkun')->name('TampilAkun');
Route::view('Penjualan.TampilPenjualan', 'Penjualan.TampilPenjualan')->name('TampilPenjualan');
Route::view('Produk', 'Produk')->name('Produk');
Route::view('Karyawan', 'Karyawan')->name('Karyawan');
Route::view('Laporan', 'Laporan ')->name('Laporan');
Route::view('Login', 'Login ')->name('login');

// route untuk login 
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

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
