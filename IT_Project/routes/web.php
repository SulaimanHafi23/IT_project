<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TPKController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PembayaranController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    if (Auth::check() && Auth::user()->level === 'admin') {
    }
    Route::get('/profile', [BerandaController::class, 'profile'])->name('profile');
    Route::get('/', [BerandaController::class, 'beranda'])->name('Beranda');


    // Rute untuk Akun
    Route::get('/akun', [UserController::class, 'Tampil'])->name('TampilAkun');
    Route::get('/buat/akun', [UserController::class, 'Tambah'])->name('TambahAkun');
    Route::post('/buat/akun', [UserController::class, 'submit'])->name('buatAkun');
    Route::get('/edit-akun/{id}', [UserController::class, 'Edit'])->name('EditAkun');
    Route::put('/update-akun/{id}', [UserController::class, 'update'])->name('UpdateAkun');
    Route::delete('/delete-akun/{id}', [UserController::class, 'delete'])->name('DeleteAkun');

    // Rute resource untuk penjualan
    Route::get('/penjulan', [PenjualanController::class, 'Tampil'])->name('TampilPenjualan');
    Route::get('/buat/penjualan', [PenjualanController::class, 'Tambah'])->name('TambahPenjualan');
    Route::post('/buat/penjualan', [PenjualanController::class, 'submit'])->name('BuatPenjualan');
    Route::get('/Detail-penjualan/{id}', [PenjualanController::class, 'Detail'])->name('DetailPenjualan');
    Route::delete('/delete-penjualan/{id}', [PenjualanController::class, 'destroy'])->name('DeletePenjualan');
    Route::get('/generate-id-penjualan', [PenjualanController::class, 'generateIdPenjualan']);


    Route::get('/pembayaran', [PembayaranController::class, 'lihat'])->name('LihatPembayaran');
    Route::get('/penjualan/{id_penjualan}/pembayaran', [PembayaranController::class, 'Detail'])->name('DetailPembayaran');


    // Route untuk Laporan
    Route::get('/laporan', [LaporanController::class, 'Tampil'])->name('TampilLaporan');
    Route::get('/buat/laporan', [LaporanController::class, 'Tambah'])->name('TambahLaporan');
    Route::post('/buat/laporan', [LaporanController::class, 'submit'])->name('BuatLaporan');
    Route::get('/edit-laporan/{id}', [LaporanController::class, 'Edit'])->name('EditLaporan');
    Route::put('/update-laporan/{id}', [LaporanController::class, 'update'])->name('UpdateLaporan');
    Route::get('/Detail-laporan/{id}', [LaporanController::class, 'Detail'])->name('DetailLaporan');
    Route::delete('/delete-laporan/{id}', [LaporanController::class, 'delete'])->name('DeleteLaporan');
    Route::get('/laporan/cetak/{id}', [LaporanController::class, 'cetak'])->name('laporan.cetak');
    
    Route::get('/TPK-Tampi', [TPKController::class, 'Tampil'])->name('TampilTPK');
    Route::get('/TPK-Tambah', [TPKController::class, 'Tambah'])->name('TambahTPK');
    Route::post('/TPK-Tambah-Submit', [TPKController::class, 'Submit'])->name('SubmitTPK');
    Route::get('/TPK-Detail/{id}', [TPKController::class, 'Detail'])->name('DetailTPK');
    Route::delete('/TPK-Hapus-Data/{id}', [TPKController::class, 'Delete'])->name('DeleteTPK');

    Route::get('/products', [ProdukController::class, 'index'])->name('produks.index');
    Route::get('/products/create', [ProdukController::class, 'create'])->name('produks.create');
    Route::post('/products', [ProdukController::class, 'store'])->name('produks.store');
    Route::get('/products/edit/{id}', [ProdukController::class, 'edit'])->name('produks.edit');
    Route::put('/products/update/{id}', [ProdukController::class, 'update'])->name('produks.update');
    Route::get('/produk/detail/{id}', [ProdukController::class, 'detail'])->name('produks.detail');
    Route::delete('/produk/delete/{id}', [ProdukController::class, 'destroy'])->name('produks.destroy');


    // Route untuk Laporan
    Route::get('/Karyawan', [KaryawanController::class, 'Tampil'])->name('TampilKaryawan');
    Route::get('/buat/Karyawan', [KaryawanController::class, 'Tambah'])->name('TambahKaryawan');
    Route::post('/buat/Karyawan', [KaryawanController::class, 'submit'])->name('BuatKaryawan');
    Route::get('/Detail-Karyawan/{id}', [KaryawanController::class, 'Detail'])->name('DetailKaryawan');
    Route::get('/edit-Karyawan/{id}', [KaryawanController::class, 'Edit'])->name('EditKaryawan');
    Route::put('/update-Karyawan/{id}', [KaryawanController::class, 'update'])->name('UpdateKaryawan');
    Route::delete('/delete-Karyawan/{id}', [KaryawanController::class, 'delete'])->name('DeleteKaryawan');
});
