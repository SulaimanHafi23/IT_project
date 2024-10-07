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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('Id_Pembayaran');
            $table->integer('Referensi_Pembayaran');
            $table->date('Tanggal_Pembayaran');
            $table->enum('Status_Pembayaran', ['berhasil', 'gagal'])->default('berhasil');
            $table->foreignId('Id_Penjualan')->constrained('penjualan', 'Id_Penjualan')->onDelete('cascade'); // Foreign key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
