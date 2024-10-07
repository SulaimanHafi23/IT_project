<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id('Id_karyawan');
            $table->string('Nama_karyawan');
            $table->text('Alamat');
            $table->string('Nomor_Telepon');
            $table->string('Posisi_Jabatan');
            $table->date('Tanggal_Lahir');
            $table->string('Shift_Kerja');
            $table->decimal('Gaji', 10, 2);
            $table->date('Tanggal_Masuk');
            $table->string('Gambar_Karyawan')->nullable();
            $table->foreignId('Id_Akun')->constrained('akun', 'Id_Akun')->onDelete('cascade'); // Foreign key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};