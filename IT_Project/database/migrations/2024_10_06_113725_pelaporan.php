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
        Schema::create('pelaporan', function (Blueprint $table) {
            $table->id('Id_Pelaporan');
            $table->date('Tanggal_Pelaporan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir');
            $table->foreignId('Id_Admin')->constrained('admin', 'Id_Admin')->onDelete('cascade'); // Foreign key
            $table->foreignId('Id_Penjualan')->constrained('penjualan', 'Id_Penjualan')->onDelete('cascade'); // Foreign key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaporan');
    }
};
