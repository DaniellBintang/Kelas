<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        Menu::create([
            'name' => 'Ayam Goreng',
            'description' => 'Ayam goreng klasik dengan rasa gurih yang menggoda.',
            'price' => 20000,
            'image' => 'images/ayamgoreng.jpg',
        ]);

        Menu::create([
            'name' => 'Ayam Pop Corn',
            'description' => 'Ayam pop corn renyah dengan rasa yang lezat.',
            'price' => 25000,
            'image' => 'images/ayampop.jpg',
        ]);

        Menu::create([
            'name' => 'Ayam Potong',
            'description' => 'Potongan ayam pilihan dengan bumbu spesial.',
            'price' => 22000,
            'image' => 'images/chicken-strips.jpg',
        ]);

        Menu::create([
            'name' => 'Ayam Katsu',
            'description' => 'Ayam katsu renyah dengan saus khas Jepang.',
            'price' => 23000,
            'image' => 'images/chickenkatsu.jpg',
        ]);

        Menu::create([
            'name' => 'Ayam Karage',
            'description' => 'Ayam karage dengan tekstur lembut dan rasa gurih.',
            'price' => 24000,
            'image' => 'images/karage.jpg',
        ]);

        Menu::create([
            'name' => 'Ayam Telur Asin',
            'description' => 'Ayam goreng dengan saus telur asin creamy.',
            'price' => 21000,
            'image' => 'images/saltedegg.jpg',
        ]);
    }
}
