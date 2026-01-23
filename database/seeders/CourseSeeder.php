<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            'Kids',
            'Teenager',
            'Adult',
        ];

        foreach ($courses as $course) {
            Course::firstOrCreate([
                'name' => $course
            ]);
        }
    }
}
