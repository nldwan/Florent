<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conversation;

class ConversationSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'title' => 'Daily Conversation Greeting',
                'video' => 'https://www.youtube.com/embed/topBLaz4zgk'
            ],
            [
                'title' => 'Shopping Conversation',
                'video' => 'https://www.youtube.com/embed/CUZgrI0ISc8'
            ],
        ];

        Conversation::insert($data);
    }
}
