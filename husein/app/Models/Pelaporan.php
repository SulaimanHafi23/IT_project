<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelaporan extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'pelaporan';

    // Primary key
    protected $primaryKey = 'Id_Pelaporan';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'Tanggal_Pelaporan',
        'Total_mulai',
        'Total_akhir',
    ];

    // Relasi dengan Karyawan (pelaporan dibuat oleh karyawan)
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'Id_Karyawan', 'Id_Karyawan');
    }
}
