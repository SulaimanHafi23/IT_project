<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('nama_produk');
            $table->string('kategori');
            $table->date('tanggal_masuk');
            $table->string('keterangan');
            $table->decimal('harga_satuan', 8, 2);
            $table->timestamps();

            // Tambahkan kolom id_karyawan
            $table->string('id_karyawan'); // menyesuaikan dengan tipe data id_karyawan di tabel karyawans

            // Definisikan foreign key pada id_karyawan
            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawans')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}