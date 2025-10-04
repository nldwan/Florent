<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'admin1',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'siswa1',
            'password' => Hash::make('123456'),
            'role' => 'siswa',
        ]);
    }
}
