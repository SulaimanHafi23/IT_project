<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    
    protected $table = 'penjualan';
    protected $primaryKey = 'Id_Penjualan';

    protected $fillable = [
        'Total_Harga',
        'Id_Karyawan',
        'Tanggal_Penjualan',
        'Metode_Pembayaran',
    ];

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'Id_Penjualan', 'Id_Penjualan');
    }
}
