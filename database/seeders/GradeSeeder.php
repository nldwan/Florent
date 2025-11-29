<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;
use App\Models\User;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        $siswa = User::where('role', 'siswa')->first();

        if ($siswa) {
            Grade::create([
                'user_id' => $siswa->id,
                'writing_grammar' => 85,
                'writing_translation' => 80,
                'writing_composition' => 88,
                'reading_compre' => 90,
                'reading_vocabulary' => 87,
                'listening_compre' => 84,
                'speaking_pronouncing' => 82,
                'speaking_intonation' => 80,
                'speaking_fluency' => 85,
                'notes' => 'Good progress. Keep practicing!',
            ]);
        }
    }
}
