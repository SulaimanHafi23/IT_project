<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'karyawan';

    // Primary key
    protected $primaryKey = 'Id_Karyawan';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'Nama_Karyawan',
        'Alamat',
        'Nomor_Telepon',
        'Jabatan',
        'Gaji',
        'tanggal_Masuk',
        'Shift_Kerja',
        'Posisi_Jabatan',
        'Gambar_Karyawan',
        'Tanggal_Lahir',
    ];

    // Relasi dengan Penjualan (karyawan melakukan penjualan)
    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'Id_Karyawan', 'Id_Karyawan');
    }
}
