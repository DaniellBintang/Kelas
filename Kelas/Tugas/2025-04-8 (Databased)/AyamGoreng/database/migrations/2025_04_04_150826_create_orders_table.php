<?php
// filepath: e:\xampp\htdocs\AyamGoreng\database\migrations\xxxx_xx_xx_xxxxxx_create_orders_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke tabel users
            $table->text('items'); // Menyimpan detail pesanan (JSON)
            $table->decimal('total_price', 10, 2); // Total harga pesanan
            $table->string('status')->default('pending'); // Status pesanan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
