<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the ratings table to avoid duplicate entries
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('ratings')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Ratings data from the database
        $ratings = [
            [
                'order_id' => 3,
                'user_id' => 23,
                'product_id' => 12,
                'rating' => 4,
                'review' => 'Gitar bagus sekali, suaranya jernih. Pengiriman cepat dan aman.',
                'created_at' => Carbon::parse('2025-02-06 03:15:23'),
            ],
            [
                'order_id' => 6,
                'user_id' => 26,
                'product_id' => 15,
                'rating' => 5,
                'review' => 'Kualitas terbaik! Sangat cocok untuk pemula seperti saya.',
                'created_at' => Carbon::parse('2025-02-07 07:22:45'),
            ],
            [
                'order_id' => 8,
                'user_id' => 28,
                'product_id' => 8,
                'rating' => 3,
                'review' => 'Cukup bagus, tapi ada sedikit goresan di bagian belakang. Suara bagus.',
                'created_at' => Carbon::parse('2025-02-09 02:35:12'),
            ],
            [
                'order_id' => 33,
                'user_id' => 41,
                'product_id' => 11,
                'rating' => 5,
                'review' => 'Mantap',
                'created_at' => Carbon::parse('2025-02-24 16:38:11'),
            ],
            [
                'order_id' => 25,
                'user_id' => 41,
                'product_id' => 2,
                'rating' => 5,
                'review' => 'Sangat Amat Oke',
                'created_at' => Carbon::parse('2025-02-24 16:38:23'),
            ],
            [
                'order_id' => 14,
                'user_id' => 34,
                'product_id' => 17,
                'rating' => 5,
                'review' => 'Fender CD-60 adalah gitar akustik terbaik di kelasnya. Sangat recommended!',
                'created_at' => Carbon::parse('2025-02-15 06:27:36'),
            ],
            [
                'order_id' => 16,
                'user_id' => 36,
                'product_id' => 11,
                'rating' => 4,
                'review' => 'Epiphone DR-100 punya suara yang bagus untuk harganya. Saya puas.',
                'created_at' => Carbon::parse('2025-02-17 01:55:41'),
            ],
            [
                'order_id' => 19,
                'user_id' => 39,
                'product_id' => 13,
                'rating' => 5,
                'review' => 'Fender Precision bass ini luar biasa! Sudah lama saya inginkan.',
                'created_at' => Carbon::parse('2025-02-20 05:44:53'),
            ],
            [
                'order_id' => 25,
                'user_id' => 41,
                'product_id' => 2,
                'rating' => 5,
                'review' => 'Stratocaster yang sempurna, tidak ada cacat. Bunyi khas Fender yang dicari.',
                'created_at' => Carbon::parse('2025-02-22 03:33:18'),
            ],
            [
                'order_id' => 33,
                'user_id' => 41,
                'product_id' => 11,
                'rating' => 4,
                'review' => 'Gitar akustik yang nyaman dimainkan, harga bersahabat kualitas bagus.',
                'created_at' => Carbon::parse('2025-02-23 02:15:44'),
            ],
            [
                'order_id' => 8,
                'user_id' => 28,
                'product_id' => 8,
                'rating' => 5,
                'review' => 'Update review: setelah saya gunakan beberapa hari, ternyata sangat bagus!',
                'created_at' => Carbon::parse('2025-02-15 09:42:19'),
            ],
            [
                'order_id' => 10,
                'user_id' => 30,
                'product_id' => 4,
                'rating' => 4,
                'review' => 'Gitar klasik yang worth it untuk dibeli, meskipun ada sedikit cacat di pengiriman.',
                'created_at' => Carbon::parse('2025-02-16 02:33:51'),
            ],
            [
                'order_id' => 12,
                'user_id' => 32,
                'product_id' => 14,
                'rating' => 5,
                'review' => 'Tone-nya sangat clear dan bright. Cocok untuk fingerstyle.',
                'created_at' => Carbon::parse('2025-02-18 07:27:06'),
            ],
            [
                'order_id' => 21,
                'user_id' => 42,
                'product_id' => 3,
                'rating' => 4,
                'review' => 'Cort AD810 suaranya mantap dan nyaman dipegang.',
                'created_at' => Carbon::parse('2025-02-24 01:15:47'),
            ],
            [
                'order_id' => 19,
                'user_id' => 39,
                'product_id' => 13,
                'rating' => 4,
                'review' => 'Update: Setelah pakai sebulan, masih puas dengan bass ini.',
                'created_at' => Carbon::parse('2025-03-01 03:22:36'),
            ],
            [
                'order_id' => 17,
                'user_id' => 37,
                'product_id' => 19,
                'rating' => 4,
                'review' => 'Update review: Setelah beradaptasi, bass ini sangat nyaman dimainkan.',
                'created_at' => Carbon::parse('2025-03-02 09:43:19'),
            ],
            [
                'order_id' => 3,
                'user_id' => 23,
                'product_id' => 12,
                'rating' => 5,
                'review' => 'Update: Semakin lama dipakai, ESP LTD EC-256 ini semakin enak dimainkan!',
                'created_at' => Carbon::parse('2025-03-03 06:54:28'),
            ],
            [
                'order_id' => 6,
                'user_id' => 26,
                'product_id' => 15,
                'rating' => 5,
                'review' => 'Gitar klasik terbaik yang pernah saya miliki, sangat worth it!',
                'created_at' => Carbon::parse('2025-03-05 02:17:42'),
            ],
            [
                'order_id' => 4,
                'user_id' => 24,
                'product_id' => 1,
                'rating' => 2,
                'review' => 'Kurang puas, ada beberapa masalah di fret board dan senar cepat kendor.',
                'created_at' => Carbon::parse('2025-02-08 04:25:33'),
            ],
            [
                'order_id' => 37,
                'user_id' => 41,
                'product_id' => 3,
                'rating' => 2,
                'review' => 'gitarnya rusak, tidak sesuai pesanan\\',
                'created_at' => Carbon::parse('2025-05-22 02:54:30'),
            ],
            [
                'order_id' => 38,
                'user_id' => 41,
                'product_id' => 2,
                'rating' => 3,
                'review' => 'Keren bang',
                'created_at' => Carbon::parse('2025-06-06 02:05:03'),
            ],
            [
                'order_id' => 34,
                'user_id' => 41,
                'product_id' => 2,
                'rating' => 5,
                'review' => 'Gitar nya sampai dengan selamat',
                'created_at' => Carbon::parse('2025-06-06 02:05:22'),
            ],
        ];

        // Insert all ratings
        Rating::insert($ratings);

        $this->command->info('Rating seeder completed successfully!');
    }
}
