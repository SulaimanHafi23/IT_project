<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawans'; // Nama tabel
    protected $primaryKey = 'id_karyawan'; // Primary key yang bukan auto-increment
    public $incrementing = false; // Tidak auto-increment
    protected $keyType = 'string'; // Tipe primary key adalah string

    protected $fillable = [
        'id_karyawan',
        'nama_karyawan',
        'alamat',
        'nomor_telepon',
        'id_akun',
        'tanggal_lahir',
        'posisi_jabatan',
        'tanggal_masuk',
        'gaji',
        'shift_kerja',
    ]; // Field yang dapat diisi
}