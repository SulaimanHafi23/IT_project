<?php

namespace App\Models;

use App\Models\HasilSaw;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BobotCiRi extends Model
{
    use HasFactory;

    protected $table = 'bobot_ci_ri';

    protected $fillable = [
        'Tanggal_Mulai',
        'Tanggal_Akhir',
        'Harga_Satuan', 
        'Jumlah_Terjual', 
        'Stok', 
        'ci', 
        'ri',
        'cr',
    ];
    public function HasilSaw(){
        return $this->belongsTo(HasilSaw::class, 'id', 'Id_Bobot');
    }
}
