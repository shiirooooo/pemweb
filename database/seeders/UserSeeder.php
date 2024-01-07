<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'gender' => 'Laki-Laki',
            'date_of_birth' => '2000-01-01',
            'phone_number' => '081234567890',
            'address' => 'Jl. Admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);
    }
}
