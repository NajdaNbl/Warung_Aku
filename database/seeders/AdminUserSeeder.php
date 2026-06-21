<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        if (User::where('username', 'najdawarung')->exists()) {
            return;
        }

        User::create([
            'name' => 'Najda Warung',
            'username' => 'najdawarung',
            'email' => 'najda@warungaku.com',
            'password' => 'Aku5ipaaa_',
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);
    }
}
