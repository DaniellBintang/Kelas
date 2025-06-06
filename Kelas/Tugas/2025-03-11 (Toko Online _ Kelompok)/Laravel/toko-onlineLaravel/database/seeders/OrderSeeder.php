<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, let's check what the allowed values are for the status column
        $table = DB::select("SHOW COLUMNS FROM orders WHERE Field = 'status'")[0];
        $typeInfo = $table->Type;
        $this->command->info("Status column type: $typeInfo");

        // Extract the allowed values if it's an ENUM
        $allowedValues = [];
        if (strpos($typeInfo, 'enum') === 0) {
            preg_match("/^enum\(\'(.*)\'\)$/", $typeInfo, $matches);
            if (isset($matches[1])) {
                $allowedValues = explode("','", $matches[1]);
                $this->command->info("Allowed status values: " . implode(', ', $allowedValues));
            }
        }

        // Map our values to the allowed values (case-sensitive match)
        $statusMap = [
            'completed' => 'Completed',
            'pending' => 'Pending',
            'canceled' => in_array('Cancelled', $allowedValues) ? 'Cancelled' : 'Canceled',
            'processing' => 'Processing'
        ];

        // Truncate the orders table to avoid duplicate entries
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('orders')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Orders data from the database
        $orders = [
            [
                'id' => 3,
                'user_id' => 23,
                'total_price' => 1200000.00,
                'status' => 'Completed',
                'shipping_address' => 'Jl. Kenanga No. 45, Kecamatan Menteng',
                'shipping_city' => 'Jakarta Pusat',
                'shipping_postal_code' => '10310',
                'created_at' => '2025-02-04 01:16:48',
            ],
            [
                'id' => 4,
                'user_id' => 24,
                'total_price' => 650000.00,
                'status' => 'Cancelled',
                'shipping_address' => 'Jl. Mawar No. 12, Kecamatan Kebayoran Baru',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12160',
                'created_at' => '2025-02-04 01:16:48',
            ],
            [
                'id' => 5,
                'user_id' => 25,
                'total_price' => 2300000.00,
                'status' => 'Pending',
                'shipping_address' => 'Jl. Melati No. 78, Kecamatan Kemang',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12730',
                'created_at' => '2025-02-04 01:16:48',
            ],
            [
                'id' => 6,
                'user_id' => 26,
                'total_price' => 450000.00,
                'status' => 'Completed',
                'shipping_address' => 'Jl. Anggrek No. 23, Kecamatan Senayan',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12190',
                'created_at' => '2025-02-04 01:16:48',
            ],
            [
                'id' => 7,
                'user_id' => 27,
                'total_price' => 1800000.00,
                'status' => 'Pending',
                'shipping_address' => 'Jl. Dahlia No. 56, Kecamatan Kuningan',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12940',
                'created_at' => '2025-02-04 01:16:48',
            ],
            [
                'id' => 8,
                'user_id' => 28,
                'total_price' => 3400000.00,
                'status' => 'Completed',
                'shipping_address' => 'Jl. Teratai No. 89, Kecamatan Setiabudi',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12910',
                'created_at' => '2025-02-04 01:16:48',
            ],
            [
                'id' => 9,
                'user_id' => 29,
                'total_price' => 210000.00,
                'status' => 'Pending',
                'shipping_address' => 'Jl. Flamboyan No. 34, Kecamatan Permata Hijau',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12210',
                'created_at' => '2025-02-04 01:16:48',
            ],
            [
                'id' => 10,
                'user_id' => 30,
                'total_price' => 890000.00,
                'status' => 'Completed',
                'shipping_address' => 'Jl. Bougenville No. 67, Kecamatan Pondok Indah',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12310',
                'created_at' => '2025-02-04 01:16:48',
            ],
            [
                'id' => 11,
                'user_id' => 31,
                'total_price' => 1250000.00,
                'status' => 'Cancelled',
                'shipping_address' => 'Jl. Kamboja No. 90, Kecamatan Cipete',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12410',
                'created_at' => '2025-02-04 01:16:48',
            ],
            [
                'id' => 12,
                'user_id' => 32,
                'total_price' => 980000.00,
                'status' => 'Completed',
                'shipping_address' => 'Jl. Tulip No. 43, Kecamatan Cilandak',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12430',
                'created_at' => '2025-02-04 01:16:48',
            ],
            [
                'id' => 13,
                'user_id' => 33,
                'total_price' => 150000.00,
                'status' => 'Pending',
                'shipping_address' => 'Jl. Sakura No. 21, Kecamatan Lebak Bulus',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12440',
                'created_at' => '2025-02-04 01:16:48',
            ],
            [
                'id' => 14,
                'user_id' => 34,
                'total_price' => 2500000.00,
                'status' => 'Completed',
                'shipping_address' => 'Jl. Lily No. 54, Kecamatan Fatmawati',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12450',
                'created_at' => '2025-02-04 01:16:48',
            ],
            [
                'id' => 15,
                'user_id' => 35,
                'total_price' => 320000.00,
                'status' => 'Pending',
                'shipping_address' => 'Jl. Iris No. 87, Kecamatan Blok M',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12120',
                'created_at' => '2025-02-04 01:16:48',
            ],
            [
                'id' => 16,
                'user_id' => 36,
                'total_price' => 700000.00,
                'status' => 'Completed',
                'shipping_address' => 'Jl. Violet No. 32, Kecamatan Senopati',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12190',
                'created_at' => '2025-02-04 01:16:48',
            ],
            [
                'id' => 17,
                'user_id' => 37,
                'total_price' => 990000.00,
                'status' => 'Completed',
                'shipping_address' => 'Jl. Daisy No. 65, Kecamatan Gunawarman',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12180',
                'created_at' => '2025-02-04 01:16:48',
            ],
            [
                'id' => 18,
                'user_id' => 38,
                'total_price' => 450000.00,
                'status' => 'Pending',
                'shipping_address' => 'Jl. Jasmine No. 98, Kecamatan Wijaya',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12170',
                'created_at' => '2025-02-04 01:16:48',
            ],
            [
                'id' => 19,
                'user_id' => 39,
                'total_price' => 1350000.00,
                'status' => 'Completed',
                'shipping_address' => 'Jl. Lotus No. 41, Kecamatan Panglima Polim',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12160',
                'created_at' => '2025-02-04 01:16:48',
            ],
            [
                'id' => 20,
                'user_id' => 40,
                'total_price' => 760000.00,
                'status' => 'Pending',
                'shipping_address' => 'Jl. Aster No. 74, Kecamatan Mahakam',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12150',
                'created_at' => '2025-02-04 01:16:48',
            ],
            [
                'id' => 21,
                'user_id' => 42,
                'total_price' => 1800000.00,
                'status' => 'Pending',
                'shipping_address' => 'Jl. Pelangi No. 28, Kecamatan Senayan',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12190',
                'created_at' => '2025-02-10 18:02:22',
            ],
            [
                'id' => 22,
                'user_id' => 42,
                'total_price' => 7500000.00,
                'status' => 'Pending',
                'shipping_address' => 'Jl. Pelangi No. 28, Kecamatan Senayan',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12190',
                'created_at' => '2025-02-10 18:04:06',
            ],
            [
                'id' => 25,
                'user_id' => 41,
                'total_price' => 9500000.00,
                'status' => 'Completed',
                'shipping_address' => 'Jl. Matahari No. 15, Kecamatan Dharmawangsa',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12140',
                'created_at' => '2025-02-11 00:46:39',
            ],
            [
                'id' => 27,
                'user_id' => 41,
                'total_price' => 9500000.00,
                'status' => 'Pending',
                'shipping_address' => 'Jl. Matahari No. 15, Kecamatan Dharmawangsa',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12140',
                'created_at' => '2025-02-11 01:53:03',
            ],
            [
                'id' => 28,
                'user_id' => 41,
                'total_price' => 2200000.00,
                'status' => 'Pending',
                'shipping_address' => 'Jl. Matahari No. 15, Kecamatan Dharmawangsa',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12140',
                'created_at' => '2025-02-11 01:53:27',
            ],
            [
                'id' => 29,
                'user_id' => 41,
                'total_price' => 19000000.00,
                'status' => 'Completed',
                'shipping_address' => 'Jl. Matahari No. 15, Kecamatan Dharmawangsa',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12140',
                'created_at' => '2025-02-17 14:50:37',
            ],
            [
                'id' => 30,
                'user_id' => 41,
                'total_price' => 11300000.00,
                'status' => 'Completed',
                'shipping_address' => 'Jl. Matahari No. 15, Kecamatan Dharmawangsa',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12140',
                'created_at' => '2025-02-17 15:10:44',
            ],
            [
                'id' => 31,
                'user_id' => 41,
                'total_price' => 28500000.00,
                'status' => 'Completed',
                'shipping_address' => 'Jalan Tebel',
                'shipping_city' => 'Sidoarjo',
                'shipping_postal_code' => '12873',
                'created_at' => '2025-02-18 00:14:38',
            ],
            [
                'id' => 32,
                'user_id' => 41,
                'total_price' => 11200000.00,
                'status' => 'Completed',
                'shipping_address' => 'Desa Gemurung ',
                'shipping_city' => 'Sidoarjo',
                'shipping_postal_code' => '67246',
                'created_at' => '2025-02-18 01:02:30',
            ],
            [
                'id' => 33,
                'user_id' => 41,
                'total_price' => 1600000.00,
                'status' => 'Completed',
                'shipping_address' => 'Apartemen Taman Anggrek Tower 1 Unit 15A',
                'shipping_city' => 'Jakarta Barat',
                'shipping_postal_code' => '11470',
                'created_at' => '2025-02-18 01:04:01',
            ],
            [
                'id' => 34,
                'user_id' => 41,
                'total_price' => 9500000.00,
                'status' => 'Completed',
                'shipping_address' => 'Jl. Matahari No. 15, Kecamatan Dharmawangsa',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12140',
                'created_at' => '2025-02-18 01:04:34',
            ],
            [
                'id' => 37,
                'user_id' => 41,
                'total_price' => 16200000.00,
                'status' => 'Completed',
                'shipping_address' => 'adadeh',
                'shipping_city' => 'Sidoarjo',
                'shipping_postal_code' => '181819',
                'created_at' => '2025-05-22 02:52:39',
            ],
            [
                'id' => 38,
                'user_id' => 41,
                'total_price' => 38000000.00,
                'status' => 'Completed',
                'shipping_address' => 'Jl. Matahari No. 15, Kecamatan Dharmawangsa',
                'shipping_city' => 'Jakarta Selatan',
                'shipping_postal_code' => '12140',
                'created_at' => '2025-06-06 01:50:53',
            ],
        ];

        // Insert all orders
        DB::table('orders')->insert($orders);

        $this->command->info('Order seeder Completed successfully!');
    }
}
