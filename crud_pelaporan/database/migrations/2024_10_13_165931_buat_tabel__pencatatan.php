<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {

        {
            Schema::create('Pencatatan', function (Blueprint $table) {
                $table->id('Id_Pencatatan');  // auto-incremented ID
                $table->date('Tanggal_Pencatatan');
                $table->date('Tanggal_Mulai');
                $table->date('Tanggal_Akhir');
                $table->unsignedBigInteger('Id_Admin');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Pencatatan');
    }
};
