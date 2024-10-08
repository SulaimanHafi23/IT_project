<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'penjualan';

    // Primary key
    protected $primaryKey = 'Id_Penjualan';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'Tanggal_Penjualan',
        'Metode_Pembayaran',
    ];

    // Relasi dengan Detail Penjualan
    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'Id_Penjualan', 'Id_Penjualan');
    }

    // Relasi dengan Karyawan (penjualan dilakukan oleh karyawan)
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'Id_Karyawan', 'Id_Karyawan');
    }

    // Relasi dengan Pembayaran
    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'Id_Pembayaran', 'Id_Pembayaran');
    }
}
