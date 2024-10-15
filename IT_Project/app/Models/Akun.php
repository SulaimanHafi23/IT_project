<?php

namespace App\Models;

use App\Models\Akun;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Akun as Authenticatable;

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

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
}
