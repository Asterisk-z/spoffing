<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "Olang Daniel",
            'first_name' => "Olang",
            'last_name' => "Daniel",
            'email' => "admin@gmail.com",
            'address' => "Daniel",
            'phone_number' => "Daniel",
            'city' => "Daniel",
            'province' => "Daniel",
            'timezone' => "Daniel",
            'password' => Hash::make('1qa2ws3ed4rf'),
            'role_id' => 1,
            'status' => "ACTIVE",
        ]);
    }
}
