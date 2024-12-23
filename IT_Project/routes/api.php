<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\PembayaranController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/buat/pembayaran', [PembayaranController::class, 'submit'])->name('BuatPembayaran');
Route::apiResource('/produk', ProdukController::class);