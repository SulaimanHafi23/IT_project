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
            $table->string('Referensi_Pembayaran')->nullable();
            $table->date('Tanggal_Pembayaran');
            $table->string('Status_Pembayaran');
            $table->BigInteger('Total_Pembayaran');
            $table->string('Id_Penjualan');
            $table->foreign('Id_Penjualan')->references('Id_Penjualan')->on('penjualan')->onDelete('cascade');
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
