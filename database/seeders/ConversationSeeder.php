<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conversation;
use App\Models\Course;

class ConversationSeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::where('name', 'Kids')->first();
        if (!$course) return;

        Conversation::insert([
            [
                'course_id' => $course->id,
                'title'     => 'Daily Conversation Greeting',
                'video'     => 'https://www.youtube.com/embed/topBLaz4zgk',
            ],
            [
                'course_id' => $course->id,
                'title'     => 'Shopping Conversation',
                'video'     => 'https://www.youtube.com/embed/CUZgrI0ISc8',
            ],
        ]);
    }
}
