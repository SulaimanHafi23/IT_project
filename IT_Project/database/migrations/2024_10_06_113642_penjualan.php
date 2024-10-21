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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->string('Id_Penjualan')->primary();
            $table->decimal('Total_Harga', 10, 2);
            $table->foreignId('Id_Karyawan')->nullable()->constrained('karyawan', 'Id_Karyawan')->onDelete('cascade');
            $table->date('Tanggal_Penjualan');
            $table->string('Metode_Pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
