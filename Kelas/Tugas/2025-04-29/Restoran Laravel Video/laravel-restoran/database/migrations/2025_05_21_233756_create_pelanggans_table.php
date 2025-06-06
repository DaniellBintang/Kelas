<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id('idpelanggan');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nama');
            $table->text('alamat');
            $table->string('telp');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelanggans');
    }
};
