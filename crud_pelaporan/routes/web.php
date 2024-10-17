<?php

use App\Http\Controllers\PencatatanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Pencatatan', [PencatatanController::class, 'tampil'])->name('Pencatatan.tampil');
Route::get('/Pencatatan/Tambah', [PencatatanController::class, 'tambah'])->name('Pencatatan.tambah');
Route::post('/Pencatatan/Submit',[PencatatanController::class, 'submit'])->name('Pencatatan.submit');
Route::get('/Pencatatan/Edit/{id}', [PencatatanController::class, 'edit'])->name('Pencatatan.edit');
Route::put('Pencatatan/Update/{id}', [PencatatanController::class, 'update'])->name('Pencatatan.Update');
Route::post('/Pencatatan/Delete/{id}', [PencatatanController::class, 'delete'])->name('Pencatatan.delete');