<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'detail_penjualan';

    // Primary key
    protected $primaryKey = 'Id_DetailPenjualan';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'Id_Produk',
        'Jumlah',
    ];

    // Relasi dengan Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'Id_Produk', 'Id_Produk');
    }

    // Relasi dengan Penjualan
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'Id_Penjualan', 'Id_Penjualan');
    }
}
