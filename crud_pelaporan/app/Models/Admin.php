<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'admin';

    // Primary key yang digunakan dalam tabel
    protected $primaryKey = 'Id_Admin';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'Nama_Admin',
        'Alamat',
        'Nomor_telepon',
        'Gambar_Admin',
        'Id_Akun'
    ];

    // Relasi dengan model Akun
    public function akun()
    {
        return $this->belongsTo(Akun::class, 'Id_Akun', 'Id_Akun');
    }
}
