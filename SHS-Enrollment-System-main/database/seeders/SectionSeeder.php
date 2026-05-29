<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\Strand;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        // Check if strands exist
        if (Strand::count() == 0) {
            $this->command->info('Please seed strands first!');
            return;
        }

        $strands = Strand::all();

        foreach ($strands as $strand) {
            $sections = [
                [
                    'Section_Name' => $strand->Strand_Name . '-11A',
                    'StrandID' => $strand->StrandID,
                    'Grade_Level' => 'Grade 11',
                    'description' => 'Section A for Grade 11 ' . $strand->Strand_Name
                ],
                [
                    'Section_Name' => $strand->Strand_Name . '-11B',
                    'StrandID' => $strand->StrandID,
                    'Grade_Level' => 'Grade 11',
                    'description' => 'Section B for Grade 11 ' . $strand->Strand_Name
                ],
                [
                    'Section_Name' => $strand->Strand_Name . '-12A',
                    'StrandID' => $strand->StrandID,
                    'Grade_Level' => 'Grade 12',
                    'description' => 'Section A for Grade 12 ' . $strand->Strand_Name
                ],
                [
                    'Section_Name' => $strand->Strand_Name . '-12B',
                    'StrandID' => $strand->StrandID,
                    'Grade_Level' => 'Grade 12',
                    'description' => 'Section B for Grade 12 ' . $strand->Strand_Name
                ]
            ];

            foreach ($sections as $section) {
                Section::create($section);
            }
        }
    }
}