<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'produk';

    // Primary key
    protected $primaryKey = 'Id_Produk';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'Nama_Produk',
        'Harga_Satuan',
        'Stok',
        'Keterangan',
    ];

    // Relasi dengan Detail Penjualan
    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'Id_Produk', 'Id_Produk');
    }
}
