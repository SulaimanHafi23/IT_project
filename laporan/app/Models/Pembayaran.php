<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $primaryKey = 'Id_Pembayaran';
    protected $fillable = [
        'Referensi_Pembayaran',
        'Jenis_Pembayaran',
        'Tanggal_Pembayaran',
        'Status_Pembayaran',
        'Id_Penjualan',
    ];

    public function penjualan(){
        return $this->belongsTo(Penjualan::class, 'Id_Penjualan');
    }
}
