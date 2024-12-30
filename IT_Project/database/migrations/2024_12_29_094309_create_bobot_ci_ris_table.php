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
        Schema::create('bobot_ci_ri', function (Blueprint $table) {
            $table->id();
            $table->date('Tanggal_Mulai');
            $table->date('Tanggal_Akhir');
            $table->decimal('Harga_Satuan', 10, 4);
            $table->decimal('Jumlah_Terjual', 10, 4);
            $table->decimal('Stok', 10, 4);
            $table->decimal('ci', 10, 4);
            $table->decimal('ri', 10, 4);
            $table->decimal('cr', 10, 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bobot_ci_ri');
    }
};
