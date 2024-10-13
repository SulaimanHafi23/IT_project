<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $table = 'detail_penjualan';
    protected $primaryKey = 'Id_Detail_Penjualan';

    protected $fillable = [
        'Id_Produk',
        'Id_Penjualan',
        'Harga_Satuan',
        'Jumlah',
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'Id_Penjualan', 'Id_Penjualan');
    }
}
