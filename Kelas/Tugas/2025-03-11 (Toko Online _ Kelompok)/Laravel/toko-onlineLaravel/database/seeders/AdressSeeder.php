<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the customer_addresses table to avoid duplicate entries
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('customer_addresses')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Customer addresses data from the database
        $customerAddresses = [
            [
                'id' => 1,
                'user_id' => 23,
                'address' => 'Apartemen Sudirman Park Tower A-12-05, Jl. KH Mas Mansyur',
                'city' => 'Jakarta Pusat',
                'postal_code' => '10220',
                'is_default' => 0,
                'created_at' => '2025-02-17 14:49:20',
            ],
            [
                'id' => 2,
                'user_id' => 23,
                'address' => 'Jl. Gatot Subroto No. 123, Kuningan',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12930',
                'is_default' => 0,
                'created_at' => '2025-02-17 14:49:20',
            ],
            [
                'id' => 3,
                'user_id' => 24,
                'address' => 'Green Garden Residence Blok A2 No. 15',
                'city' => 'Jakarta Barat',
                'postal_code' => '11520',
                'is_default' => 0,
                'created_at' => '2025-02-17 14:49:20',
            ],
            [
                'id' => 4,
                'user_id' => 25,
                'address' => 'Apartemen Casablanca East Residence Unit 1807',
                'city' => 'Jakarta Timur',
                'postal_code' => '13960',
                'is_default' => 0,
                'created_at' => '2025-02-17 14:49:20',
            ],
            [
                'id' => 5,
                'user_id' => 25,
                'address' => 'Jl. Bendungan Hilir Raya No. 45',
                'city' => 'Jakarta Pusat',
                'postal_code' => '10210',
                'is_default' => 0,
                'created_at' => '2025-02-17 14:49:20',
            ],
            [
                'id' => 6,
                'user_id' => 26,
                'address' => 'Kompleks BSD City, Cluster Green Park B-8',
                'city' => 'Tangerang Selatan',
                'postal_code' => '15310',
                'is_default' => 0,
                'created_at' => '2025-02-17 14:49:20',
            ],
            [
                'id' => 7,
                'user_id' => 27,
                'address' => 'Jl. Kemang Raya No. 58, Bangka',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12730',
                'is_default' => 0,
                'created_at' => '2025-02-17 14:49:20',
            ],
            [
                'id' => 8,
                'user_id' => 41,
                'address' => 'Apartemen Taman Anggrek Tower 1 Unit 15A',
                'city' => 'Jakarta Barat',
                'postal_code' => '11470',
                'is_default' => 0,
                'created_at' => '2025-02-17 14:49:20',
            ],
            [
                'id' => 9,
                'user_id' => 41,
                'address' => 'Jl. Pluit Sakti Raya No. 28, Penjaringan',
                'city' => 'Jakarta Utara',
                'postal_code' => '14450',
                'is_default' => 0,
                'created_at' => '2025-02-17 14:49:20',
            ],
            [
                'id' => 10,
                'user_id' => 42,
                'address' => 'Gading Serpong Cluster Florence No. 17',
                'city' => 'Tangerang',
                'postal_code' => '15810',
                'is_default' => 0,
                'created_at' => '2025-02-17 14:49:20',
            ],
            [
                'id' => 11,
                'user_id' => 41,
                'address' => 'adadeh',
                'city' => 'Sidoarjo',
                'postal_code' => '181819',
                'is_default' => 0,
                'created_at' => '2025-05-22 02:52:39',
            ],
        ];

        // Insert all customer addresses
        DB::table('customer_addresses')->insert($customerAddresses);

        $this->command->info('Customer address seeder completed successfully!');
    }
}
