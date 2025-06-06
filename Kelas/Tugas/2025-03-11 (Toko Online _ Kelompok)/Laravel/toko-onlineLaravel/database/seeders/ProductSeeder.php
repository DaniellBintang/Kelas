<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the products table to avoid duplicate entries
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Product data from the database
        $products = [
            [
                'name' => 'Gitar Akustik Yamaha F310',
                'image' => 'gitar1.png',
                'price' => 1700000.00,
                'description' => 'Gitar akustik Yamaha F310 dengan kualitas suara yang jernih dan nyaman dimainkan. Cocok untuk pemula hingga menengah.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gitar Elektrik Fender Stratocaster',
                'image' => 'gitar2.png',
                'price' => 9500000.00,
                'description' => 'Gitar elektrik legendaris dengan tone yang khas, sangat cocok untuk berbagai genre musik dari blues hingga rock.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gitar Akustik Cort AD810',
                'image' => 'gitar3.png',
                'price' => 1800000.00,
                'description' => 'Gitar akustik Cort AD810 dengan body spruce solid dan nyaman dipegang, ideal untuk pemula.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gitar Klasik Yamaha C40',
                'image' => 'gitar4.png',
                'price' => 1200000.00,
                'description' => 'Gitar klasik dengan senar nilon yang nyaman dan cocok untuk pemula yang ingin belajar fingerpicking.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gitar Elektrik Gibson Les Paul',
                'image' => 'gitar5.png',
                'price' => 15000000.00,
                'description' => 'Gibson Les Paul dengan pickup humbucker yang menghasilkan suara tebal dan sustain panjang, ikon dalam dunia gitar.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gitar Akustik Taylor 114ce',
                'image' => 'gitar6.png',
                'price' => 10000000.00,
                'description' => 'Gitar akustik premium dengan pickup built-in dan finish yang apik, suara crisp yang presisi.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gitar Bass Ibanez GSR200',
                'image' => 'gitar7.png',
                'price' => 3500000.00,
                'description' => 'Bass 4 senar dengan neck yang nyaman dan tone yang versatile untuk berbagai genre musik.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gitar Elektrik PRS SE Custom 24',
                'image' => 'gitar8.png',
                'price' => 9500000.00,
                'description' => 'Gitar elektrik dengan 24 fret dan pickup yang versatile, cocok untuk lead maupun rhythm.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gitar Akustik Martin D-28',
                'image' => 'gitar9.png',
                'price' => 35000000.00,
                'description' => 'Gitar akustik high-end dengan konstruksi premium dan suara yang luar biasa jernih dan kaya.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gitar Klasik Cordoba C5',
                'image' => 'gitar10.png',
                'price' => 2500000.00,
                'description' => 'Gitar klasik dengan solid cedar top dan mahogany back & sides, suara yang hangat dan resonant.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gitar Akustik Epiphone DR-100',
                'image' => 'gitar11.png',
                'price' => 1600000.00,
                'description' => 'Gitar akustik entry-level dengan kualitas build yang baik dan suara yang konsisten.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gitar Elektrik ESP LTD EC-256',
                'image' => 'gitar12.png',
                'price' => 7000000.00,
                'description' => 'Gitar dengan design les paul modern dan pickup aktif yang powerful untuk musik beraliran keras.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gitar Bass Fender Precision',
                'image' => 'gitar13.png',
                'price' => 12000000.00,
                'description' => 'Bass klasik dengan tone yang legendaris, standard industri untuk musik rock dan jazz.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gitar Akustik Seagull S6',
                'image' => 'gitar14.png',
                'price' => 5000000.00,
                'description' => 'Gitar akustik made in Canada dengan solid cedar top dan cherry sides, kualitas premium.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gitar Klasik Alhambra 3C',
                'image' => 'gitar15.png',
                'price' => 4500000.00,
                'description' => 'Gitar klasik Spanyol dengan tradisi craftsmanship yang tinggi, cocok untuk konser klasikal.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gitar Elektrik Ibanez RG450DX',
                'image' => 'gitar16.png',
                'price' => 6800000.00,
                'description' => 'Gitar elektrik dengan neck yang tipis dan cepat, ideal untuk teknik shredding dan soloing.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gitar Akustik Fender CD-60',
                'image' => 'gitar17.png',
                'price' => 2200000.00,
                'description' => 'Gitar akustik Fender dengan solid spruce top dan mahogany back & sides, suara yang balance.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gitar Elektrik Schecter Omen-6',
                'image' => 'gitar18.png',
                'price' => 5500000.00,
                'description' => 'Gitar elektrik dengan konstruksi mahogany dan maple, cocok untuk aliran metal dan rock keras.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gitar Bass Yamaha TRBX174',
                'image' => 'gitar19.png',
                'price' => 2700000.00,
                'description' => 'Bass 4 string dengan body ergonomis dan harga terjangkau, cocok untuk pemula.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gitar Akustik Takamine GD302',
                'image' => '67cf8d093abf7_1741655305.png',
                'price' => 8300000.00,
                'description' => 'Gitar akustik solid spruce dengan elektronik built-in, tone yang kaya dan projesi suara yang bagus.',
                'stock' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // Insert all products
        Product::insert($products);

        $this->command->info('Product seeder completed successfully!');
    }
}
