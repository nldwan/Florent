<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CourseSeeder::class,
            LevelSeeder::class,
            SublevelSeeder::class,
            UserSeeder::class,
            MaterialSeeder::class,
            VocabularySeeder::class,
            ConversationSeeder::class,
        ]);
    }
}
