<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Sekolah',
            'username' => 'admin', // <-- Pastikan baris ini ada
            'email' => 'admin@sekolah.com',
            'password' => Hash::make('password123'),
        ]);
    }
}