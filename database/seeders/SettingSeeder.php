<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'store_name' => 'Warung Aku',
            'wa_number' => '621235331414',
            'address' => 'Jl. Contoh No. 123, Kota Contoh',
            'operational_hours' => '08.00 - 21.00',
            'description' => 'Warung Aku adalah warung sembako yang menyediakan kebutuhan harian dengan harga bersahabat.',

        ];

        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }
    }
}
