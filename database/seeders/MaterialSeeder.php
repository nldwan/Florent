<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;
use App\Models\Course;
use App\Models\Level;
use App\Models\Sublevel;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil course Kids
        $course = Course::where('name', 'Kids')->first();
        if (!$course) return;

        // Ambil level Intermediate
        $level = Level::where('course_id', $course->id)
                        ->where('name', 'Intermediate')
                        ->first();
        if (!$level) return;

        // Ambil sublevel 1 & 2
        $sublevel1 = Sublevel::where('level_id', $level->id)->where('order', 1)->first();
        $sublevel2 = Sublevel::where('level_id', $level->id)->where('order', 2)->first();

        Material::insert([
            [
                'course_id'   => $course->id,
                'level_id'    => $level->id,
                'sublevel_id' => $sublevel1->id,
                'title'       => 'Intermediate 1',
                'file'        => 'intermediate1.pdf',
            ],
            [
                'course_id'   => $course->id,
                'level_id'    => $level->id,
                'sublevel_id' => $sublevel2->id,
                'title'       => 'Intermediate 2',
                'file'        => 'intermediate2.pdf',
            ],
        ]);
    }
}
