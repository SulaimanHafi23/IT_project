<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PembayaranController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('admin:admin')->group(function(){
    Route::get('admin/login', [AdminController::class, 'loginForm']);
    Route::post('admin/login', [AdminController::class, 'store'])->name('admin.login');

});

Route::middleware([
    'auth:sanctum,admin',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/admin/dashboard', [BerandaController::class, 'Beranda'])->name('Beranda');
    // Rute untuk Akun
    Route::get('/admin/akun', [UserController::class, 'Tampil'])->name('TampilAkun');
    Route::get('/admin/buat/akun', [UserController::class, 'Tambah'])->name('TambahAkun');
    Route::post('/admin/buat/akun', [UserController::class, 'submit'])->name('buatAkun');
    Route::get('/admin/edit-akun/{id}', [UserController::class, 'Edit'])->name('EditAkun');
    Route::put('/admin/update-akun/{id}', [UserController::class, 'update'])->name('UpdateAkun');
    Route::delete('/admin/delete-akun/{id}', [UserController::class, 'delete'])->name('DeleteAkun');
    // Route untuk Laporan
    Route::get('/admin/laporan', [LaporanController::class, 'Tampil'])->name('TampilLaporan');
    Route::get('/admin/buat/laporan', [LaporanController::class, 'Tambah'])->name('TambahLaporan');
    Route::post('/admin/buat/laporan', [LaporanController::class, 'submit'])->name('BuatLaporan');
    Route::get('/admin/edit-laporan/{id}', [LaporanController::class, 'Edit'])->name('EditLaporan');
    Route::put('/admin/update-laporan/{id}', [LaporanController::class, 'update'])->name('UpdateLaporan');
    Route::get('/admin/Detail-laporan/{id}', [LaporanController::class, 'Detail'])->name('DetailLaporan');
    Route::delete('/admin/delete-laporan/{id}', [LaporanController::class, 'delete'])->name('DeleteLaporan');
    Route::get('/admin/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
    // Route untuk Laporan
    Route::get('/admin/Karyawan', [KaryawanController::class, 'Tampil'])->name('TampilKaryawan');
    Route::get('/admin/buat/Karyawan', [KaryawanController::class, 'Tambah'])->name('TambahKaryawan');
    Route::post('/admin/buat/Karyawan', [KaryawanController::class, 'submit'])->name('BuatKaryawan');
    Route::get('/admin/Detail-Karyawan/{id}', [KaryawanController::class, 'Detail'])->name('DetailKaryawan');
    Route::get('/admin/edit-Karyawan/{id}', [KaryawanController::class, 'Edit'])->name('EditKaryawan');
    Route::put('/admin/update-Karyawan/{id}', [KaryawanController::class, 'update'])->name('UpdateKaryawan');
    Route::delete('/admin/delete-Karyawan/{id}', [KaryawanController::class, 'delete'])->name('DeleteKaryawan');
    // Route untuk Penjualan
    Route::get('/admin/penjulan', [PenjualanController::class, 'Tampil'])->name('TampilPenjualan');
    Route::get('/admin/buat/penjualan', [PenjualanController::class, 'Tambah'])->name('TambahPenjualan');
    Route::post('/admin/buat/penjualan', [PenjualanController::class, 'submit'])->name('BuatPenjualan');
    Route::get('/admin/Detail-penjualan/{id}', [PenjualanController::class, 'Detail'])->name('DetailPenjualan');
    Route::delete('/admin/delete-penjualan/{id}', [PenjualanController::class, 'destroy'])->name('DeletePenjualan');
    Route::get('/admin/generate-id-penjualan', [PenjualanController::class, 'generateIdPenjualan']);
    // Route untuk Pembayaran
    Route::get('/admin/pembayaran', [PembayaranController::class, 'lihat'])->name('LihatPembayaran');
    Route::get('/admin/penjualan/{id_penjualan}/pembayaran', [PembayaranController::class, 'Detail'])->name('DetailPembayaran');
    //Route untuk Produk    
    Route::get('/admin/products', [ProdukController::class, 'index'])->name('produks.index');
    Route::get('/admin/products/create', [ProdukController::class, 'create'])->name('produks.create');
    Route::post('/admin/products', [ProdukController::class, 'store'])->name('produks.store');
    Route::get('/admin/products/edit/{id}', [ProdukController::class, 'edit'])->name('produks.edit');
    Route::put('/admin/products/update/{id}', [ProdukController::class, 'update'])->name('produks.update');
    Route::get('/admin/produk/detail/{id}', [ProdukController::class, 'detail'])->name('produks.detail');
    Route::delete('/admin/produk/delete/{id}', [ProdukController::class, 'destroy'])->name('produks.destroy');
});

// login
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [BerandaController::class, 'Beranda'])->name('Beranda');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Rute resource untuk penjualan
    Route::get('/penjulan', [PenjualanController::class, 'Tampil'])->name('TampilPenjualan');
    Route::get('/buat/penjualan', [PenjualanController::class, 'Tambah'])->name('TambahPenjualan');
    Route::post('/buat/penjualan', [PenjualanController::class, 'submit'])->name('BuatPenjualan');
    Route::get('/Detail-penjualan/{id}', [PenjualanController::class, 'Detail'])->name('DetailPenjualan');
    Route::delete('/delete-penjualan/{id}', [PenjualanController::class, 'destroy'])->name('DeletePenjualan');
    Route::get('/generate-id-penjualan', [PenjualanController::class, 'generateIdPenjualan']);

    Route::get('/pembayaran', [PembayaranController::class, 'lihat'])->name('LihatPembayaran');
    Route::get('/penjualan/{id_penjualan}/pembayaran', [PembayaranController::class, 'Detail'])->name('DetailPembayaran');

    Route::get('/products', [ProdukController::class, 'index'])->name('produks.index');
    Route::get('/products/create', [ProdukController::class, 'create'])->name('produks.create');
    Route::post('/products', [ProdukController::class, 'store'])->name('produks.store');
    Route::get('/products/edit/{id}', [ProdukController::class, 'edit'])->name('produks.edit');
    Route::put('/products/update/{id}', [ProdukController::class, 'update'])->name('produks.update');
    Route::get('/produk/detail/{id}', [ProdukController::class, 'detail'])->name('produks.detail');
    Route::delete('/produk/delete/{id}', [ProdukController::class, 'destroy'])->name('produks.destroy');

});
