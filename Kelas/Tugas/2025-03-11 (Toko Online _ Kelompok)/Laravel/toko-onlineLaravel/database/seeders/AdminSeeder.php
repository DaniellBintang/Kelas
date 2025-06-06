<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing admin records
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('admins')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Insert a default admin account
        DB::table('admins')->insert([
            'email' => 'admin@guitarshop.com',
            'password' => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Default admin user created. Email: admin@guitarshop.com, Password: admin123');
    }
}
