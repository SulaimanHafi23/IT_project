<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'Id_User';

    // Menentukan atribut yang dapat diisi secara massal
    protected $fillable = [
        'Username',
        'Level',
        'Password',
    ];

    // Menyembunyikan password dan token saat serialisasi
    protected $hidden = [
        'Password',
        'remember_token',
    ];

    // Menetapkan casting untuk atribut tertentu
    protected $casts = [
        'password' => 'hashed',
    ];

    // Override method untuk menggunakan kolom Password
    public function getAuthPassword()
    {
        return $this->Password;
    }

    // Enkripsi password otomatis saat diset
    public function setPasswordAttribute($value)
    {
        $this->attributes['Password'] = Hash::make($value);
    }
}
