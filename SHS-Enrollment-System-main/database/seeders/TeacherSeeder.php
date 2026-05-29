<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            [
                'FirstName' => 'John',
                'LastName' => 'Smith',
                'Email' => 'john.smith@umindanao.edu.ph',
                'Contact_Number' => '09123456789',
                'Address' => 'Davao City',
                'DOB' => '1985-01-01',
                'Gender' => 'Male',
                'Subject_Specialization' => 'Mathematics'
            ],
            [
                'FirstName' => 'Maria',
                'LastName' => 'Garcia',
                'Email' => 'maria.garcia@umindanao.edu.ph',
                'Contact_Number' => '09234567890',
                'Address' => 'Davao City',
                'DOB' => '1990-02-02',
                'Gender' => 'Female',
                'Subject_Specialization' => 'Science'
                
            ],
            [
                'FirstName' => 'Robert',
                'LastName' => 'Johnson',
                'Email' => 'robert.johnson@umindanao.edu.ph',
                'Contact_Number' => '09345678901',
                'Address' => 'Davao City',
                'DOB' => '1988-03-03',
                'Gender' => 'Male',
                'Subject_Specialization' => 'English'
            ]
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}