<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,      // First, create users
            ProductSeeder::class,   // Then create products
            OrderSeeder::class,     // Then create orders that reference users
            OrderItemSeeder::class, // Then create order items that reference orders and products
            RatingSeeder::class,    // Then create ratings that reference orders, users, and products
            AdressSeeder::class,    // Finally create addresses that reference users
        ]);
    }
}
