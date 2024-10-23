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
        Schema::create('admin', function (Blueprint $table) {
            $table->id('Id_Admin'); // Primary key
            $table->string('Nama_Admin');
            $table->text('Alamat');
            $table->string('Nomor_telepon');
            $table->string('Gambar_Admin')->nullable();
            // $table->foreignId('Id_User')->constrained('user', 'Id_User')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
