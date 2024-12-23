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
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->id('Id_Detail_Penjualan');
            $table->decimal('Harga_Satuan', 10, 2);
            $table->string('Id_Penjualan');
            $table->foreign('Id_Penjualan')->references('Id_Penjualan')->on('penjualan')->onDelete('cascade');
            $table->foreignId('Id_Produk')->constrained('produk', 'Id_Produk')->onDelete('cascade');
            $table->integer('Jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualan');
    }
};
