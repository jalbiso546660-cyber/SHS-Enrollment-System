<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Strand;

class StrandSeeder extends Seeder
{
    public function run()
    {
        $strands = [
            [
                'Strand_Name' => 'STEM',
                'description' => 'Science, Technology, Engineering, and Mathematics'
            ],
            [
                'Strand_Name' => 'ABM',
                'description' => 'Accountancy, Business, and Management'
            ],
            [
                'Strand_Name' => 'HUMSS',
                'description' => 'Humanities and Social Sciences'
            ]
        ];

        foreach ($strands as $strand) {
            Strand::create($strand);
        }
    }
}