<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $kidsCourse = Course::where('name', 'Kids')->first();

        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'course_id' => null,
            'no_hp' => '0000',
            'password' => Hash::make('admin12345'),
            'role' => 'admin',
        ]);

        // Siswa contoh
        User::create([
            'name' => 'Siswa1',
            'email' => 'siswa1@example.com',
            'course_id' => $kidsCourse?->id,
            'no_hp' => '08123456789',
            'password' => Hash::make('siswa12345'),
            'role' => 'siswa',
        ]);
    }
}
