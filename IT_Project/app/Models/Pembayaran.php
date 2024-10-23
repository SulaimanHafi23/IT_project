<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'pembayaran';

    // Primary key
    protected $primaryKey = 'Id_Pembayaran';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'Jenis_Pembayaran',
        'Status_Pembayaran',
    ];

    // Relasi dengan Penjualan
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'Id_Penjualan');
    }
}
