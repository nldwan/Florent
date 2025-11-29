<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin1',
            'email' => 'admin1@example.com',
            'kursus' => null,
            'no_hp' => '0000',
            'password' => Hash::make('admin12345'),
            'role' => 'admin',
        ]);

        // Siswa contoh
        User::create([
            'name' => 'Siswa1',
            'email' => 'siswa1@example.com',
            'kursus' => 'Teen',
            'no_hp' => '08123456789',
            'password' => Hash::make('siswa12345'),
            'role' => 'siswa',
        ]);
    }
}
