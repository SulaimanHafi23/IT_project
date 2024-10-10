<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Akun extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'akun';

    // Primary key yang digunakan dalam tabel
    protected $primaryKey = 'Id_Akun';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'Id_Akun',
        'Username',
        'Password',
        'level'
    ];
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];

        
    }
}
