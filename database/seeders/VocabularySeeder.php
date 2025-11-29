<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vocabulary;

class VocabularySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['verb1' => 'go', 'verb2' => 'went', 'verb3' => 'gone', 'meaning' => 'pergi'],
            ['verb1' => 'eat', 'verb2' => 'ate', 'verb3' => 'eaten', 'meaning' => 'makan'],
            ['verb1' => 'drink', 'verb2' => 'drank', 'verb3' => 'drunk', 'meaning' => 'minum'],
            ['verb1' => 'make', 'verb2' => 'made', 'verb3' => 'made', 'meaning' => 'membuat'],
            ['verb1' => 'write', 'verb2' => 'wrote', 'verb3' => 'written', 'meaning' => 'menulis'],
        ];

        Vocabulary::insert($data);
    }
}
