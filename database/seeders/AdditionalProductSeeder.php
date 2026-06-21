<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class AdditionalProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('name');

        $products = [
            // Beras
            [
                'category' => 'Beras & Minyak',
                'name' => 'Beras Premium 1kg',
                'description' => 'Beras premium kualitas terbaik, pulen dan enak, kemasan 1kg.',
                'price' => 16000,
                'stock' => 30,
                'is_best_seller' => true,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Beras & Minyak',
                'name' => 'Beras Premium 1/2kg',
                'description' => 'Beras premium kemasan 1/2kg, cocok untuk kebutuhan sedikit.',
                'price' => 8500,
                'stock' => 25,
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],

            // Gula kemasan
            [
                'category' => 'Gula & Kopi',
                'name' => 'Gula Pasir 1/2kg',
                'description' => 'Gula pasir putih bersih kemasan 1/2kg.',
                'price' => 8500,
                'stock' => 30,
                'is_best_seller' => true,
                'is_new_arrival' => false,
            ],
            [
                'category' => 'Gula & Kopi',
                'name' => 'Gula Pasir 1/4kg',
                'description' => 'Gula pasir putih bersih kemasan 1/4kg, pas untuk kebutuhan harian.',
                'price' => 4500,
                'stock' => 40,
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],

            // Teh Poci
            [
                'category' => 'Minuman',
                'name' => 'Teh Poci',
                'description' => 'Teh melati wangi khas Teh Poci, seduhan hangat yang menenangkan.',
                'price' => 7000,
                'stock' => 30,
                'is_best_seller' => true,
                'is_new_arrival' => false,
            ],

            // Kopi Medali
            [
                'category' => 'Gula & Kopi',
                'name' => 'Kopi Medali',
                'description' => 'Kopi Medali bubuk dengan rasa khas dan nikmat, cocok untuk ngopi setiap hari.',
                'price' => 12000,
                'stock' => 25,
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],

            // Nutri Sari / Nutu (minuman serbuk)
            [
                'category' => 'Minuman',
                'name' => 'Nutri Sari',
                'description' => 'Minuman serbuk rasa jeruk dengan vitamin C, segar dan menyehatkan.',
                'price' => 2500,
                'stock' => 50,
                'is_best_seller' => false,
                'is_new_arrival' => false,
            ],

            // Mie Instan tambahan
            [
                'category' => 'Mie & Bumbu',
                'name' => 'Mie Instant Goreng Jumbo',
                'description' => 'Mie instant goreng ukuran jumbo, porsi lebih besar untuk yang lapar.',
                'price' => 5500,
                'stock' => 50,
                'is_best_seller' => true,
                'is_new_arrival' => true,
            ],
            [
                'category' => 'Mie & Bumbu',
                'name' => 'Mie Instant Kuah Kari',
                'description' => 'Mie instant kuah rasa kari yang gurih dan lezat.',
                'price' => 4000,
                'stock' => 45,
                'is_best_seller' => false,
                'is_new_arrival' => true,
            ],
            [
                'category' => 'Mie & Bumbu',
                'name' => 'Mie Instant Goreng Rendang',
                'description' => 'Mie instant goreng dengan cita rasa rendang khas Padang.',
                'price' => 4500,
                'stock' => 40,
                'is_best_seller' => false,
                'is_new_arrival' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'category_id' => $categories[$product['category']]->id,
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'image' => null,
                'is_best_seller' => $product['is_best_seller'],
                'is_new_arrival' => $product['is_new_arrival'],
                'is_active' => true,
            ]);
        }

        $this->command->info('10 produk tambahan berhasil ditambahkan!');
    }
}
