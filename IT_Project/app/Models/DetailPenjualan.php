<?php

namespace App\Models;

use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $table = 'detail_penjualan';
    protected $primaryKey = 'Id_Detail_Penjualan'; // Ganti dengan nama kolom primary key Anda

    protected $fillable = [
        'Id_Penjualan',
        'Id_Produk',
        'Harga_Satuan',
        'Jumlah',
    ];

    // Relasi ke penjualan
    public function penjualan()
    {
    return $this->belongsTo(Penjualan::class, 'Id_Penjualan', 'Id_Penjualan');
    }

    // Relasi ke produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'Id_Produk');
    }

}
