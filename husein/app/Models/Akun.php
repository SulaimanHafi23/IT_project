<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'akun';

    // Primary key yang digunakan dalam tabel
    protected $primaryKey = 'Id_Akun';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'Username',
        'Password',
        'level'
    ];

    // Relasi dengan model Admin
    public function admin()
    {
        return $this->hasOne(Admin::class, 'Id_Akun', 'Id_Akun');
    }

    // Relasi dengan model karyawan 
    public function karyawan()
    {
        return $this->hasOne(Admin::class, 'Id_Akun', 'Id_Akun');
    }
}
