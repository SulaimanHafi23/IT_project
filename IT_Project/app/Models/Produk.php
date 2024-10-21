<?php

namespace App\Models;

use App\Models\Karyawan;
use App\Models\DetailPenjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $primaryKey = 'Id_Produk';

    protected $fillable = [
        'Nama_Produk',
        'Kategori',
        'Tanggal_Masuk',
        'Ketarangan',
        'Stok',
        'Harga_Satuan',
        'Id_Karyawan',
    ];

    public function karyawan()
    {
        return $this->hashOne(Karyawan::class, 'Id_Karyawan');
    }
    
    // Relasi dengan Detail Penjualan
    public function detailPenjualan()
    {
        return $this->belongsTo(DetailPenjualan::class, 'Id_Produk', 'Id_Produk');
    }
}
