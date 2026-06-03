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

        $products = [
            // Beras & Minyak
            [
                'category' => 'Beras & Minyak',
                'name' => 'Beras Premium 5kg',
                'description' => 'Beras premium kualitas terbaik, pulen dan enak untuk konsumsi sehari-hari.',
                'price' => 75000,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=400',
                'is_best_seller' => true,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Beras & Minyak',
                'name' => 'Minyak Goreng 1L',
                'description' => 'Minyak goreng berkualitas, jernih dan tahan panas untuk menggoreng.',
                'price' => 18000,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=400',
                'is_best_seller' => true,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Beras & Minyak',
                'name' => 'Minyak Goreng (Ecer)',
                'description' => 'Minyak goreng eceran per 100ml, cocok untuk kebutuhan sedikit.',
                'price' => 3000,
                'stock' => 100,
                'image' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=400',
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Beras & Minyak',
                'name' => 'Tepung Terigu 1kg',
                'description' => 'Tepung terigu serbaguna, cocok untuk menggoreng dan membuat kue.',
                'price' => 12000,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=400',
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
                'image' => 'https://images.unsplash.com/photo-1586282033675-6f07aea1d820?w=400',
                'is_best_seller' => true,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Gula & Kopi',
                'name' => 'Gula Pasir (Ecer)',
                'description' => 'Gula pasir eceran per 100g, pas untuk kebutuhan harian.',
                'price' => 2000,
                'stock' => 200,
                'image' => 'https://images.unsplash.com/photo-1586282033675-6f07aea1d820?w=400',
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Gula & Kopi',
                'name' => 'Kopi Sachet',
                'description' => 'Kopi sachet praktis, tinggal seduh. Cocok untuk ngopi setiap saat.',
                'price' => 2000,
                'stock' => 100,
                'image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=400',
                'is_best_seller' => true,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Gula & Kopi',
                'name' => 'Susu Kental Manis',
                'description' => 'Susu kental manis rasa vanila, cocok untuk minuman dan kue.',
                'price' => 13000,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1556740738-b6a63e27c4df?w=400',
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
                'image' => 'https://images.unsplash.com/photo-1612929633738-8fe44f7ec841?w=400',
                'is_best_seller' => true,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Mie & Bumbu',
                'name' => 'Mie Instant Kuah',
                'description' => 'Mie instant kuah dengan kuah gurih, cocok untuk makan siang.',
                'price' => 3500,
                'stock' => 60,
                'image' => 'https://images.unsplash.com/photo-1555126634-323283e090fa?w=400',
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Mie & Bumbu',
                'name' => 'Kecap Manis',
                'description' => 'Kecap manis berkualitas, cocok untuk bumbu masak dan pelengkap makanan.',
                'price' => 8000,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1607619056574-7b8d3eea6b0e?w=400',
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Mie & Bumbu',
                'name' => 'Saos Sambal',
                'description' => 'Saos sambal pedas manis, cocok untuk cocolan dan bumbu masak.',
                'price' => 7000,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1596040033229-982a5f3a22f0?w=400',
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
                'image' => 'https://images.unsplash.com/photo-1585699324551-f6c309eedeca?w=400',
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Sabun & Deterjen',
                'name' => 'Deterjen 250g',
                'description' => 'Deterjen bubuk untuk mencuci pakaian, bersih dan wangi.',
                'price' => 5000,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1610557892470-55d9e80c0bce?w=400',
                'is_best_seller' => true,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Sabun & Deterjen',
                'name' => 'Sabun Mandi',
                'description' => 'Sabun mandi dengan aroma segar, membersihkan dan melembabkan kulit.',
                'price' => 4000,
                'stock' => 35,
                'image' => 'https://images.unsplash.com/photo-1600857544200-b2f666a9a2ec?w=400',
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Sabun & Deterjen',
                'name' => 'Shampoo Sachet',
                'description' => 'Shampoo sachet kemasan praktis, pas untuk pemakaian sehari-hari.',
                'price' => 1000,
                'stock' => 200,
                'image' => 'https://images.unsplash.com/photo-1631729371254-42c2892f0e6e?w=400',
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
                'image' => 'https://images.unsplash.com/photo-1556679343-c7306c14d4e9?w=400',
                'is_best_seller' => true,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Minuman',
                'name' => 'Air Mineral 600ml',
                'description' => 'Air mineral murni, segar dan menyehatkan.',
                'price' => 3000,
                'stock' => 100,
                'image' => 'https://images.unsplash.com/photo-1580910051074-3eb694886505?w=400',
                'is_best_seller' => true,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Minuman',
                'name' => 'Kopi Susu Sachet',
                'description' => 'Kopi susu sachet praktis, rasa kekinian dengan harga merakyat.',
                'price' => 2500,
                'stock' => 60,
                'image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=400',
                'is_best_seller' => false,
                'is_new_arrival' => true,
            ],
            [
                'category' => 'Minuman',
                'name' => 'Minuman Serbuk Jeruk',
                'description' => 'Minuman serbuk rasa jeruk, segar dan kaya vitamin C.',
                'price' => 2000,
                'stock' => 40,
                'image' => 'https://images.unsplash.com/photo-1622597467836-f3285f2131b8?w=400',
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
                'image' => 'https://images.unsplash.com/photo-1599490659211-e3b7e8c6c4b0?w=400',
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Camilan',
                'name' => 'Kacang Atom',
                'description' => 'Kacang atom gurih dan renyah, camilan favorit sepanjang masa.',
                'price' => 8000,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1604068549290-dea0e4a305ca?w=400',
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Camilan',
                'name' => 'Wafer Cream',
                'description' => 'Wafer renyah dengan isian cream vanila yang lembut.',
                'price' => 10000,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1579364046732-c21c2177730d?w=400',
                'is_best_seller' => true,
                'is_new_arrival' => true,
            ],
            [
                'category' => 'Camilan',
                'name' => 'Permen',
                'description' => 'Aneka permen dengan rasa buah-buahan, manis dan menyegarkan.',
                'price' => 1000,
                'stock' => 200,
                'image' => 'https://images.unsplash.com/photo-1581798459219-318e76aecc7b?w=400',
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
                'image' => $product['image'],
                'is_best_seller' => $product['is_best_seller'],
                'is_new_arrival' => $product['is_new_arrival'],
                'is_active' => true,
            ]);
        }
    }
}
