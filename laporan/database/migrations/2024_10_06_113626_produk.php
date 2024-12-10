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
        Schema::create('produk', function (Blueprint $table) {
            $table->id('Id_Produk');
            $table->string('Nama_Produk');
            $table->string('Kategori');
            $table->decimal('Harga_Satuan', 10, 2);
            $table->integer('Stok');
            $table->date('Tanggal_Masuk');
            $table->text('Keterangan')->nullable();
            $table->foreignId('Id_Karyawan')->constrained('karyawan', 'Id_Karyawan')->onDelete('cascade'); // Foreign key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
