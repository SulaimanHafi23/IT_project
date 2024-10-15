<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pencatatan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'Pencatatan';

    // Kolom-kolom yang dapat diisi secara massal (mass assignable)
    protected $fillable = [
   // Sesuaikan dengan nama kolom di database
        'Tanggal_Pencatatan',
        'Tanggal_Mulai',
        'Tanggal_Akhir',
        'Id_Admin',
    ];
}