<?php

namespace App\Models;

use App\Models\BobotCiRi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilSaw extends Model
{
    use HasFactory;

    protected $table = 'hasil_saw';

    protected $fillable = [
        'Id_Bobot',
        'Nama_Produk',
        'Skor'
    ];

    public function bobot_ci_ri(){
        return $this->belongsTo(BobotCiRi::class, 'Id_Bobot', 'id');
    }
}
