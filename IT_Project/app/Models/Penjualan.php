<?php

namespace App\Models;

use App\Models\Karyawan;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    protected $table = 'penjualan'; 
    protected $primaryKey = 'Id_Penjualan'; 
    public $incrementing = false; 
    protected $keyType = 'string'; 
    protected $fillable = ['Id_Penjualan', 'Total_Harga', 'Id_Karyawan', 'Tanggal_Penjualan', 'Metode_Pembayaran'];

    // Relasi ke detail penjualan
    public function detailPenjualan()
    {
    return $this->hasMany(DetailPenjualan::class, 'Id_Penjualan', 'Id_Penjualan');
    }


    // Relasi ke karyawan
    public function karyawan()
    {
    return $this->belongsTo(Karyawan::class, 'Id_Karyawan', 'Id_Karyawan');
    }
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'Id_Penjualan');
    }
}
