<?php

namespace App\Models;

use App\Models\User;
use App\Models\Karyawan;
use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
  use HasFactory;
    // Uncomment this line if you're using SoftDeletes
    // use SoftDeletes;

    protected $table = 'karyawan';
    protected $primaryKey = 'Id_Karyawan';
    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'Nama_Karyawan',
        'Alamat',
        'Nomor_Telepon',
        'Jabatan',
        'Gaji',
        'Tanggal_Masuk',
        'Shift_Kerja',
        'Posisi_Jabatan',
        'Gambar_Karyawan',
        'Tanggal_Lahir',
        'Id_User',
    ];

    // Relasi dengan Penjualan (karyawan melakukan penjualan)
    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'Id_Karyawan', 'Id_Karyawan');
    }
    public function user() {
        return $this->belongsTo(User::class, 'Id_User');
    }
    public function produk()
    {
        return $this->hasMany(Produk::class, 'Id_Karyawan', 'Id_Karyawan');
    }
}
