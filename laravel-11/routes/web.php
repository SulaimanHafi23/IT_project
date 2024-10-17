<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;

Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index'); // Menampilkan list karyawan
Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create'); // Form tambah karyawan
Route::post('/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store'); // Simpan data karyawan

Route::get('/karyawan/{karyawan}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
// Route::put('/karyawan/{karyawan}', [KaryawanController::class, 'update'])->name('karyawan.update'); // Update data karyawan
Route::put('/karyawan/{karyawan}', [KaryawanController::class, 'update'])->name('karyawan.update');


Route::delete('/karyawan/{karyawan}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy'); // Hapus data karyawan
