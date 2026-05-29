<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\Strand;

class SubjectSeeder extends Seeder
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
            $subjects = [
                [
                    'name' => 'English 1',
                    'StrandID' => $strand->StrandID,
                    'Semester' => '1st Semester',
                    'School_Year' => '2025-2026',
                    'Grade_Level' => 'Grade 11',
                    'description' => 'Basic English Communication Skills'
                ],
                [
                    'name' => 'Mathematics',
                    'StrandID' => $strand->StrandID,
                    'Semester' => '1st Semester',
                    'School_Year' => '2025-2026',
                    'Grade_Level' => 'Grade 11',
                    'description' => 'General Mathematics'
                ],
                [
                    'name' => 'Science',
                    'StrandID' => $strand->StrandID,
                    'Semester' => '2nd Semester',
                    'School_Year' => '2025-2026',
                    'Grade_Level' => 'Grade 11',
                    'description' => 'Earth and Life Science'
                ],

                [
                    'name' => 'English 2',
                    'StrandID' => $strand->StrandID,
                    'Semester' => '1st Semester',
                    'School_Year' => '2025-2026',
                    'Grade_Level' => 'Grade 12',
                    'description' => 'Basic English Communication Skills'
                ],
                [
                    'name' => 'Mathematics 2',
                    'StrandID' => $strand->StrandID,
                    'Semester' => '1st Semester',
                    'School_Year' => '2025-2026',
                    'Grade_Level' => 'Grade 12',
                    'description' => 'General Mathematics'
                ],
                [
                    'name' => 'Science 2',
                    'StrandID' => $strand->StrandID,
                    'Semester' => '1nd Semester',
                    'School_Year' => '2025-2026',
                    'Grade_Level' => 'Grade 12',
                    'description' => 'Earth and Life Science'
                ]
            ];

            foreach ($subjects as $subject) {
                Subject::create($subject);
            }
        }
    }
}