<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
           'name' => 'Victor Llerena',
           'email' => 'victor@gmail.com',
           'email_verified_at' => now(),
           'password' => Hash::make('victor123'),
           'created_at' => now(),
           'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Kristy Villanueva',
            'email' => 'kristy@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('kristy123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
