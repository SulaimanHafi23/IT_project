<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'laporan';

    // Primary key
    protected $primaryKey = 'Id_Laporan';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'tanggal_laporan',
        'tanggal_mulai',
        'tanggal_akhir',
    ];

    // Relasi dengan Karyawan (pelaporan dibuat oleh karyawan)
    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'Tanggal_Penjualan', 'tanggal_mulai')
                    ->whereBetween('Tanggal_Penjualan', [$this->tanggal_mulai, $this->tanggal_akhir]);
    }
}
