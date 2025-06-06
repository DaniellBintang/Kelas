<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Check existing orders
        $existingOrderIds = DB::table('orders')->pluck('id')->toArray();
        $this->command->info("Found " . count($existingOrderIds) . " existing orders");

        // Check existing products
        $existingProductIds = DB::table('products')->pluck('id')->toArray();
        $this->command->info("Found " . count($existingProductIds) . " existing products");

        // Truncate the order_items table to avoid duplicate entries
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('order_items')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Order items data from the database
        $orderItems = [
            [
                'id' => 3,
                'order_id' => 3,
                'product_id' => 12,
                'quantity' => 1,
                'price' => 1200000.00,
            ],
            [
                'id' => 4,
                'order_id' => 4,
                'product_id' => 1,
                'quantity' => 2,
                'price' => 325000.00,
            ],
            [
                'id' => 5,
                'order_id' => 5,
                'product_id' => 9,
                'quantity' => 1,
                'price' => 2300000.00,
            ],
            [
                'id' => 6,
                'order_id' => 6,
                'product_id' => 15,
                'quantity' => 3,
                'price' => 150000.00,
            ],
            [
                'id' => 7,
                'order_id' => 7,
                'product_id' => 2,
                'quantity' => 1,
                'price' => 1800000.00,
            ],
            [
                'id' => 8,
                'order_id' => 8,
                'product_id' => 8,
                'quantity' => 2,
                'price' => 1700000.00,
            ],
            [
                'id' => 9,
                'order_id' => 9,
                'product_id' => 10,
                'quantity' => 1,
                'price' => 210000.00,
            ],
            [
                'id' => 10,
                'order_id' => 10,
                'product_id' => 4,
                'quantity' => 1,
                'price' => 890000.00,
            ],
            [
                'id' => 11,
                'order_id' => 11,
                'product_id' => 6,
                'quantity' => 2,
                'price' => 625000.00,
            ],
            [
                'id' => 12,
                'order_id' => 12,
                'product_id' => 14,
                'quantity' => 1,
                'price' => 980000.00,
            ],
            [
                'id' => 13,
                'order_id' => 13,
                'product_id' => 20,
                'quantity' => 3,
                'price' => 50000.00,
            ],
            [
                'id' => 14,
                'order_id' => 14,
                'product_id' => 17,
                'quantity' => 2,
                'price' => 1250000.00,
            ],
            [
                'id' => 15,
                'order_id' => 15,
                'product_id' => 5,
                'quantity' => 1,
                'price' => 320000.00,
            ],
            [
                'id' => 16,
                'order_id' => 16,
                'product_id' => 11,
                'quantity' => 1,
                'price' => 700000.00,
            ],
            [
                'id' => 17,
                'order_id' => 17,
                'product_id' => 19,
                'quantity' => 2,
                'price' => 495000.00,
            ],
            [
                'id' => 18,
                'order_id' => 18,
                'product_id' => 16,
                'quantity' => 1,
                'price' => 450000.00,
            ],
            [
                'id' => 19,
                'order_id' => 19,
                'product_id' => 13,
                'quantity' => 2,
                'price' => 675000.00,
            ],
            [
                'id' => 20,
                'order_id' => 20,
                'product_id' => 18,
                'quantity' => 1,
                'price' => 760000.00,
            ],
            [
                'id' => 21,
                'order_id' => 21,
                'product_id' => 3,
                'quantity' => 1,
                'price' => 1800000.00,
            ],
            [
                'id' => 22,
                'order_id' => 22,
                'product_id' => 2,
                'quantity' => 1,
                'price' => 7500000.00,
            ],
            [
                'id' => 25,
                'order_id' => 25,
                'product_id' => 2,
                'quantity' => 1,
                'price' => 9500000.00,
            ],
            [
                'id' => 29,
                'order_id' => 27,
                'product_id' => 2,
                'quantity' => 1,
                'price' => 9500000.00,
            ],
            [
                'id' => 30,
                'order_id' => 28,
                'product_id' => 17,
                'quantity' => 1,
                'price' => 2200000.00,
            ],
            [
                'id' => 31,
                'order_id' => 29,
                'product_id' => 2,
                'quantity' => 2,
                'price' => 9500000.00,
            ],
            [
                'id' => 32,
                'order_id' => 30,
                'product_id' => 2,
                'quantity' => 1,
                'price' => 9500000.00,
            ],
            [
                'id' => 33,
                'order_id' => 30,
                'product_id' => 3,
                'quantity' => 1,
                'price' => 1800000.00,
            ],
            [
                'id' => 34,
                'order_id' => 31,
                'product_id' => 2,
                'quantity' => 3,
                'price' => 9500000.00,
            ],
            [
                'id' => 35,
                'order_id' => 32,
                'product_id' => 2,
                'quantity' => 1,
                'price' => 9500000.00,
            ],
            [
                'id' => 36,
                'order_id' => 32,
                'product_id' => 1,
                'quantity' => 1,
                'price' => 1700000.00,
            ],
            [
                'id' => 37,
                'order_id' => 33,
                'product_id' => 11,
                'quantity' => 1,
                'price' => 1600000.00,
            ],
            [
                'id' => 38,
                'order_id' => 34,
                'product_id' => 2,
                'quantity' => 1,
                'price' => 9500000.00,
            ],
            [
                'id' => 41,
                'order_id' => 37,
                'product_id' => 3,
                'quantity' => 9,
                'price' => 1800000.00,
            ],
            [
                'id' => 42,
                'order_id' => 38,
                'product_id' => 2,
                'quantity' => 4,
                'price' => 9500000.00,
            ],
        ];

        // Filter items to only include those that reference existing orders and products
        $validOrderItems = array_filter($orderItems, function ($item) use ($existingOrderIds, $existingProductIds) {
            return in_array($item['order_id'], $existingOrderIds) &&
                in_array($item['product_id'], $existingProductIds);
        });

        $this->command->info("Found " . count($orderItems) . " order items in seeder data");
        $this->command->info("After filtering, " . count($validOrderItems) . " items are valid");

        if (empty($validOrderItems)) {
            $this->command->error("No valid order items to insert!");
            return;
        }

        // Insert all valid order items
        DB::table('order_items')->insert(array_values($validOrderItems)); // array_values reindexes the array

        $this->command->info('Order item seeder completed successfully!');
    }
}
