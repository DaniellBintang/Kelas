<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the customers table to avoid duplicate entries
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Customer data from the database
        $users = [
            [
                'id' => 23,
                'full_name' => 'Citra Lestari',
                'email' => 'citra.lestari@example.com',
                'password' => 'password123',
                'address' => 'Jl. Kenanga No. 45, Kecamatan Menteng',
                'city' => 'Jakarta Pusat',
                'postal_code' => '10310',
                'phone' => '081234567890',
                'created_at' => Carbon::parse('2025-02-04 01:05:31'),
            ],
            [
                'id' => 24,
                'full_name' => 'Dewi Kumalasari',
                'email' => 'dewi.kumalasari@example.com',
                'password' => 'password123',
                'address' => 'Jl. Mawar No. 12, Kecamatan Kebayoran Baru',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12160',
                'phone' => '081234567891',
                'created_at' => Carbon::parse('2025-02-04 01:05:31'),
            ],
            [
                'id' => 25,
                'full_name' => 'Eka Wijaya',
                'email' => 'eka.wijaya@example.com',
                'password' => 'password123',
                'address' => 'Jl. Melati No. 78, Kecamatan Kemang',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12730',
                'phone' => '081234567892',
                'created_at' => Carbon::parse('2025-02-04 01:05:31'),
            ],
            [
                'id' => 26,
                'full_name' => 'Fajar Pratama',
                'email' => 'fajar.pratama@example.com',
                'password' => 'password123',
                'address' => 'Jl. Anggrek No. 23, Kecamatan Senayan',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12190',
                'phone' => '081234567893',
                'created_at' => Carbon::parse('2025-02-04 01:05:31'),
            ],
            [
                'id' => 27,
                'full_name' => 'Gita Pertiwi',
                'email' => 'gita.pertiwi@example.com',
                'password' => 'password123',
                'address' => 'Jl. Dahlia No. 56, Kecamatan Kuningan',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12940',
                'phone' => '081234567894',
                'created_at' => Carbon::parse('2025-02-04 01:05:31'),
            ],
            [
                'id' => 28,
                'full_name' => 'Hadi Saputro',
                'email' => 'hadi.saputro@example.com',
                'password' => 'password123',
                'address' => 'Jl. Teratai No. 89, Kecamatan Setiabudi',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12910',
                'phone' => '081234567895',
                'created_at' => Carbon::parse('2025-02-04 01:05:31'),
            ],
            [
                'id' => 29,
                'full_name' => 'Indah Sari',
                'email' => 'indah.sari@example.com',
                'password' => 'password123',
                'address' => 'Jl. Flamboyan No. 34, Kecamatan Permata Hijau',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12210',
                'phone' => '081234567896',
                'created_at' => Carbon::parse('2025-02-04 01:05:31'),
            ],
            [
                'id' => 30,
                'full_name' => 'Joko Widodo',
                'email' => 'joko.widodo@example.com',
                'password' => 'password123',
                'address' => 'Jl. Bougenville No. 67, Kecamatan Pondok Indah',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12310',
                'phone' => '081234567897',
                'created_at' => Carbon::parse('2025-02-04 01:05:31'),
            ],
            [
                'id' => 31,
                'full_name' => 'Kartika Dewi',
                'email' => 'kartika.dewi@example.com',
                'password' => 'password123',
                'address' => 'Jl. Kamboja No. 90, Kecamatan Cipete',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12410',
                'phone' => '081234567898',
                'created_at' => Carbon::parse('2025-02-04 01:05:31'),
            ],
            [
                'id' => 32,
                'full_name' => 'Lukman Hakim',
                'email' => 'lukman.hakim@example.com',
                'password' => 'password123',
                'address' => 'Jl. Tulip No. 43, Kecamatan Cilandak',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12430',
                'phone' => '081234567899',
                'created_at' => Carbon::parse('2025-02-04 01:05:31'),
            ],
            [
                'id' => 33,
                'full_name' => 'Maya Anggraini',
                'email' => 'maya.anggraini@example.com',
                'password' => 'password123',
                'address' => 'Jl. Sakura No. 21, Kecamatan Lebak Bulus',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12440',
                'phone' => '081234567800',
                'created_at' => Carbon::parse('2025-02-04 01:05:31'),
            ],
            [
                'id' => 34,
                'full_name' => 'Nugroho Adi',
                'email' => 'nugroho.adi@example.com',
                'password' => 'password123',
                'address' => 'Jl. Lily No. 54, Kecamatan Fatmawati',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12450',
                'phone' => '081234567801',
                'created_at' => Carbon::parse('2025-02-04 01:05:31'),
            ],
            [
                'id' => 35,
                'full_name' => 'Olivia Salsabila',
                'email' => 'olivia.salsabila@example.com',
                'password' => 'password123',
                'address' => 'Jl. Iris No. 87, Kecamatan Blok M',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12120',
                'phone' => '081234567802',
                'created_at' => Carbon::parse('2025-02-04 01:05:31'),
            ],
            [
                'id' => 36,
                'full_name' => 'Pandu Setiawan',
                'email' => 'pandu.setiawan@example.com',
                'password' => 'password123',
                'address' => 'Jl. Violet No. 32, Kecamatan Senopati',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12190',
                'phone' => '081234567803',
                'created_at' => Carbon::parse('2025-02-04 01:05:31'),
            ],
            [
                'id' => 37,
                'full_name' => 'Qory Anindita',
                'email' => 'qory.anindita@example.com',
                'password' => 'password123',
                'address' => 'Jl. Daisy No. 65, Kecamatan Gunawarman',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12180',
                'phone' => '081234567804',
                'created_at' => Carbon::parse('2025-02-04 01:05:31'),
            ],
            [
                'id' => 38,
                'full_name' => 'Rizky Ramadhan',
                'email' => 'rizky.ramadhan@example.com',
                'password' => 'password123',
                'address' => 'Jl. Jasmine No. 98, Kecamatan Wijaya',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12170',
                'phone' => '081234567805',
                'created_at' => Carbon::parse('2025-02-04 01:05:31'),
            ],
            [
                'id' => 39,
                'full_name' => 'Siti Aminah',
                'email' => 'siti.aminah@example.com',
                'password' => 'password123',
                'address' => 'Jl. Lotus No. 41, Kecamatan Panglima Polim',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12160',
                'phone' => '081234567806',
                'created_at' => Carbon::parse('2025-02-04 01:05:31'),
            ],
            [
                'id' => 40,
                'full_name' => 'Taufik Hidayat',
                'email' => 'taufik.hidayat@example.com',
                'password' => 'password123',
                'address' => 'Jl. Aster No. 74, Kecamatan Mahakam',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12150',
                'phone' => '081234567807',
                'created_at' => Carbon::parse('2025-02-04 01:05:31'),
            ],
            [
                'id' => 41,
                'full_name' => 'Daniel Bintang Pratama',
                'email' => 'danelbintang@gmail.com',
                'password' => Hash::make('Daniel321'),
                'address' => 'Jl. Matahari No. 15, Kecamatan Dharmawangsa',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12140',
                'phone' => '081234567808',
                'created_at' => Carbon::parse('2025-02-09 15:41:12'),
            ],
            [
                'id' => 42,
                'full_name' => 'Aldo Ganteng',
                'email' => 'aldokeren@gmail.com',
                'password' => Hash::make('123'),
                'address' => 'Jl. Pelangi No. 28, Kecamatan Senayan',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12190',
                'phone' => '081234567809',
                'created_at' => Carbon::parse('2025-02-10 12:12:53'),
            ],
            [
                'id' => 43,
                'full_name' => 'Calysta Chika Graciana',
                'email' => 'calystachikagraciana@gmail.com',
                'password' => Hash::make('Chika321'),
                'address' => 'Perumahan Permata Alam Permai',
                'city' => 'Sidoarjo',
                'postal_code' => '61254',
                'phone' => '0895338157759',
                'created_at' => Carbon::parse('2025-02-17 15:37:16'),
            ],
        ];

        // Insert all customers
        DB::table('users')->insert($users);

        $this->command->info('Customer seeder completed successfully!');
    }
}
