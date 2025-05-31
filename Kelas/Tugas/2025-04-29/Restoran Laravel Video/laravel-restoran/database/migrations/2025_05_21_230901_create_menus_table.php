<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id('idmenu');
            $table->string('menu');
            $table->text('deskripsi');
            $table->decimal('harga', 10, 2);
            $table->string('gambar');
            $table->unsignedBigInteger('idkategori');
            $table->foreign('idkategori')->references('idkategori')->on('kategoris')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
};
