<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk membuat akun admin dummy.
     */
    public function run()
    {
        Admin::create([
            'name' => 'Admin Dummy',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Gunakan password yang aman
        ]);
    }
}
