<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        $materials = [
            [
                'title' => 'Intermediate 1',
                'file' => 'intermediate1.pdf'
            ],
            [
                'title' => 'Intermediate 2',
                'file' => 'intermediate2.pdf'
            ],
        ];

        Material::insert($materials);
    }
}
