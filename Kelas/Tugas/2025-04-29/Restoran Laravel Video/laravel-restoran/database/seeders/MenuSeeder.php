<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('menus')->truncate();

        DB::table('menus')->insert([
            // Makanan (idkategori: 1)
            [
                'idkategori' => 1,
                'menu' => 'Nasi Goreng Spesial',
                'deskripsi' => 'Nasi goreng dengan telur, ayam, dan sayuran',
                'harga' => 25000,
                'gambar' => 'nasigoreng.jpg'
            ],
            [
                'idkategori' => 1,
                'menu' => 'Mie Goreng',
                'deskripsi' => 'Mie goreng dengan telur dan sayuran',
                'harga' => 22000,
                'gambar' => 'miegoreng.jpg'
            ],

            // Minuman (idkategori: 2)
            [
                'idkategori' => 2,
                'menu' => 'Es Teh Manis',
                'deskripsi' => 'Teh manis dengan es batu',
                'harga' => 5000,
                'gambar' => 'esteh.jpg'
            ],
            [
                'idkategori' => 2,
                'menu' => 'Jus Alpukat',
                'deskripsi' => 'Jus alpukat segar dengan susu',
                'harga' => 15000,
                'gambar' => 'jusalpukat.jpg'
            ],

            // Appetizer (idkategori: 3)
            [
                'idkategori' => 3,
                'menu' => 'Spring Roll',
                'deskripsi' => 'Lumpia isi sayuran',
                'harga' => 18000,
                'gambar' => 'springroll.jpg'
            ],
            [
                'idkategori' => 3,
                'menu' => 'Soup',
                'deskripsi' => 'Sup ayam dengan sayuran',
                'harga' => 20000,
                'gambar' => 'soup.jpg'
            ],

            // Dessert (idkategori: 4)
            [
                'idkategori' => 4,
                'menu' => 'Es Krim',
                'deskripsi' => 'Es krim vanilla dengan topping coklat',
                'harga' => 12000,
                'gambar' => 'eskrim.jpg'
            ],
            [
                'idkategori' => 4,
                'menu' => 'Puding',
                'deskripsi' => 'Puding coklat dengan vla vanilla',
                'harga' => 10000,
                'gambar' => 'puding.jpg'
            ],

            // Snack (idkategori: 5)
            [
                'idkategori' => 5,
                'menu' => 'French Fries',
                'deskripsi' => 'Kentang goreng crispy',
                'harga' => 15000,
                'gambar' => 'frenchfries.jpg'
            ],
            [
                'idkategori' => 5,
                'menu' => 'Chicken Wings',
                'deskripsi' => 'Sayap ayam goreng crispy',
                'harga' => 25000,
                'gambar' => 'chickenwings.jpg'
            ],
        ]);
    }
}
