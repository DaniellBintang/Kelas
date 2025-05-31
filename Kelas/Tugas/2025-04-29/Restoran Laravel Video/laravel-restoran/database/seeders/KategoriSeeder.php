<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        // Menghapus semua data yang ada
        DB::table('kategoris')->truncate();

        // Memasukkan data baru yang diinginkan
        DB::table('kategoris')->insert([
            ['kategori' => 'Makanan'],
            ['kategori' => 'Minuman'],
            ['kategori' => 'Appetizer'],
            ['kategori' => 'Dessert'],
            ['kategori' => 'Snack'],
        ]);
    }
}
