<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->string('id_karyawan')->primary(); // Kolom id_karyawan sebagai primary key
            $table->string('nama_karyawan');
            $table->string('alamat');
            $table->string('nomor_telepon');
            $table->string('id_akun');
            $table->date('tanggal_lahir');
            $table->string('posisi_jabatan');
            $table->date('tanggal_masuk');
            $table->decimal('gaji', 10, 2);
            $table->string('shift_kerja');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('karyawans');
    }
}
