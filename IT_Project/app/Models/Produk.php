<?php

namespace App\Models;

// use App\Models\Produk;
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
        'Keterangan',
        'Stok',
        'Harga_Satuan',
        'Id_Karyawan',
    ];
    // Relasi dengan Detail Penjualan
    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_produk');
    }


    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'Id_Karyawan', 'Id_Karyawan');
    }
}
