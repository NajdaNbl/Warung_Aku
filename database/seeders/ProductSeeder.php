<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('name');

        $catImage = fn($cat) => match ($cat) {
            'Beras & Minyak' => 'images/products/beras.svg',
            'Gula & Kopi' => 'images/products/gula.svg',
            'Mie & Bumbu' => 'images/products/mie.svg',
            'Sabun & Deterjen' => 'images/products/sabun.svg',
            'Minuman' => 'images/products/minuman.svg',
            'Camilan' => 'images/products/camilan.svg',
            default => 'images/products/placeholder.svg',
        };

        $products = [
            // Beras & Minyak
            [
                'category' => 'Beras & Minyak',
                'name' => 'Beras Premium 5kg',
                'description' => 'Beras premium kualitas terbaik, pulen dan enak untuk konsumsi sehari-hari.',
                'price' => 75000,
                'stock' => 15,
                'is_best_seller' => true,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Beras & Minyak',
                'name' => 'Minyak Goreng 1L',
                'description' => 'Minyak goreng berkualitas, jernih dan tahan panas untuk menggoreng.',
                'price' => 18000,
                'stock' => 25,
                'is_best_seller' => true,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Beras & Minyak',
                'name' => 'Minyak Goreng (Ecer)',
                'description' => 'Minyak goreng eceran per 100ml, cocok untuk kebutuhan sedikit.',
                'price' => 3000,
                'stock' => 100,
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Beras & Minyak',
                'name' => 'Tepung Terigu 1kg',
                'description' => 'Tepung terigu serbaguna, cocok untuk menggoreng dan membuat kue.',
                'price' => 12000,
                'stock' => 20,
                'is_best_seller' => false,
                'is_new_arrival' => true,
            ],

            // Gula & Kopi
            [
                'category' => 'Gula & Kopi',
                'name' => 'Gula Pasir 1kg',
                'description' => 'Gula pasir putih bersih, manis alami untuk kebutuhan dapur Anda.',
                'price' => 16000,
                'stock' => 30,
                'is_best_seller' => true,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Gula & Kopi',
                'name' => 'Gula Pasir (Ecer)',
                'description' => 'Gula pasir eceran per 100g, pas untuk kebutuhan harian.',
                'price' => 2000,
                'stock' => 200,
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Gula & Kopi',
                'name' => 'Kopi Sachet',
                'description' => 'Kopi sachet praktis, tinggal seduh. Cocok untuk ngopi setiap saat.',
                'price' => 2000,
                'stock' => 100,
                'is_best_seller' => true,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Gula & Kopi',
                'name' => 'Susu Kental Manis',
                'description' => 'Susu kental manis rasa vanila, cocok untuk minuman dan kue.',
                'price' => 13000,
                'stock' => 20,
                'is_best_seller' => false,
                'is_new_arrival' => true,
            ],

            // Mie & Bumbu
            [
                'category' => 'Mie & Bumbu',
                'name' => 'Mie Instant Goreng',
                'description' => 'Mie instant goreng dengan bumbu lezat, siap dalam 3 menit.',
                'price' => 3500,
                'stock' => 80,
                'is_best_seller' => true,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Mie & Bumbu',
                'name' => 'Mie Instant Kuah',
                'description' => 'Mie instant kuah dengan kuah gurih, cocok untuk makan siang.',
                'price' => 3500,
                'stock' => 60,
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Mie & Bumbu',
                'name' => 'Kecap Manis',
                'description' => 'Kecap manis berkualitas, cocok untuk bumbu masak dan pelengkap makanan.',
                'price' => 8000,
                'stock' => 15,
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Mie & Bumbu',
                'name' => 'Saos Sambal',
                'description' => 'Saos sambal pedas manis, cocok untuk cocolan dan bumbu masak.',
                'price' => 7000,
                'stock' => 20,
                'is_best_seller' => false,
                'is_new_arrival' => true,
            ],

            // Sabun & Deterjen
            [
                'category' => 'Sabun & Deterjen',
                'name' => 'Sabun Cuci Piring',
                'description' => 'Sabun cuci piring dengan aroma segar, mampu membersihkan lemak membandel.',
                'price' => 8000,
                'stock' => 25,
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Sabun & Deterjen',
                'name' => 'Deterjen 250g',
                'description' => 'Deterjen bubuk untuk mencuci pakaian, bersih dan wangi.',
                'price' => 5000,
                'stock' => 30,
                'is_best_seller' => true,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Sabun & Deterjen',
                'name' => 'Sabun Mandi',
                'description' => 'Sabun mandi dengan aroma segar, membersihkan dan melembabkan kulit.',
                'price' => 4000,
                'stock' => 35,
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Sabun & Deterjen',
                'name' => 'Shampoo Sachet',
                'description' => 'Shampoo sachet kemasan praktis, pas untuk pemakaian sehari-hari.',
                'price' => 1000,
                'stock' => 200,
                'is_best_seller' => false,
                'is_new_arrival' => true,
            ],

            // Minuman
            [
                'category' => 'Minuman',
                'name' => 'Teh Botol',
                'description' => 'Teh botol kesegaran asli dari teh pilihan, siap diminum kapan saja.',
                'price' => 5000,
                'stock' => 50,
                'is_best_seller' => true,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Minuman',
                'name' => 'Air Mineral 600ml',
                'description' => 'Air mineral murni, segar dan menyehatkan.',
                'price' => 3000,
                'stock' => 100,
                'is_best_seller' => true,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Minuman',
                'name' => 'Kopi Susu Sachet',
                'description' => 'Kopi susu sachet praktis, rasa kekinian dengan harga merakyat.',
                'price' => 2500,
                'stock' => 60,
                'is_best_seller' => false,
                'is_new_arrival' => true,
            ],
            [
                'category' => 'Minuman',
                'name' => 'Minuman Serbuk Jeruk',
                'description' => 'Minuman serbuk rasa jeruk, segar dan kaya vitamin C.',
                'price' => 2000,
                'stock' => 40,
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],

            // Camilan
            [
                'category' => 'Camilan',
                'name' => 'Keripik Singkong',
                'description' => 'Keripik singkong renyah dan gurih, cocok untuk teman santai.',
                'price' => 10000,
                'stock' => 30,
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Camilan',
                'name' => 'Kacang Atom',
                'description' => 'Kacang atom gurih dan renyah, camilan favorit sepanjang masa.',
                'price' => 8000,
                'stock' => 30,
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Camilan',
                'name' => 'Wafer Cream',
                'description' => 'Wafer renyah dengan isian cream vanila yang lembut.',
                'price' => 10000,
                'stock' => 25,
                'is_best_seller' => true,
                'is_new_arrival' => true,
            ],
            [
                'category' => 'Camilan',
                'name' => 'Permen',
                'description' => 'Aneka permen dengan rasa buah-buahan, manis dan menyegarkan.',
                'price' => 1000,
                'stock' => 200,
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'category_id' => $categories[$product['category']]->id,
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'image' => $catImage($product['category']),
                'is_best_seller' => $product['is_best_seller'],
                'is_new_arrival' => $product['is_new_arrival'],
                'is_active' => true,
            ]);
        }
    }
}
