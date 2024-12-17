<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';
    protected $primaryKey = 'Id_Laporan';
    protected $fillable = [
        'tanggal_laporan',
        'tanggal_mulai',
        'tanggal_akhir',
    ];

    public function penjualan(){
        return $this->hasMany(Penjualan::class, 'Tanggal_Penjualan', 'tanggal_mulai')
                    ->whereBetween('Tanggal_Penjualan', [$this->tanggal_mulai, $this->tanggal_akhir]);
    }
    public function karyawan(){
        return $this->belongsTo(Karyawan::class, 'Id_Karyawan', 'Id_Karyawan');
    }
}
