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
            $table->integer('Jumlah');
            $table->decimal('Harga_Satuan', 10, 2);
            $table->foreignId('Id_Penjualan')->constrained('penjualan', 'Id_Penjualan')->onDelete('cascade'); // Foreign key
            $table->foreignId('Id_Produk')->constrained('produk', 'Id_Produk')->onDelete('cascade'); // Foreign key
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
