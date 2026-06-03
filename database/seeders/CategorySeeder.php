<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Beras & Minyak', 'description' => 'Beras, minyak goreng, tepung, dan kebutuhan masak pokok', 'is_active' => true],
            ['name' => 'Gula & Kopi', 'description' => 'Gula pasir, kopi, susu kental manis, dan pemanis', 'is_active' => true],
            ['name' => 'Mie & Bumbu', 'description' => 'Mie instant, kecap, saos, dan bumbu masak', 'is_active' => true],
            ['name' => 'Sabun & Deterjen', 'description' => 'Sabun mandi, deterjen, shampoo, dan pembersih rumah', 'is_active' => true],
            ['name' => 'Minuman', 'description' => 'Air mineral, teh, kopi instan, dan minuman kemasan', 'is_active' => true],
            ['name' => 'Camilan', 'description' => 'Keripik, kacang, wafer, permen, dan makanan ringan', 'is_active' => true],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
