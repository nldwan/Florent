<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SublevelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sublevels')->insert([
            ['order' => 1],
            ['order' => 2],
            ['order' => 3],
        ]);
    }
}
