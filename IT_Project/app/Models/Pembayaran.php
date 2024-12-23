<?php

namespace App\Models;

use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $primaryKey = 'Id_Pembayaran';
    protected $guarded = [];
    protected $fillable = [
        'Referensi_Pembayaran',
        'Tanggal_Pembayaran',
        'Total_Pembayaran',
        'Status_Pembayaran',
        'Id_Penjualan',
    ];

    // app/Models/Pembayaran.php
public function penjualan()
{
    return $this->belongsTo(Penjualan::class, 'Id_Penjualan', 'Id_Penjualan');
}

    
}
