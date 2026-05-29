<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Section;
use App\Models\Room;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        // Check if required data exists
        if (Subject::count() == 0 || Teacher::count() == 0 || 
            Section::count() == 0 || Room::count() == 0) {
            $this->command->info('Please seed subjects, teachers, sections, and rooms first!');
            return;
        }

        $teachers = Teacher::take(3)->get(); // Get first 3 teachers
        $subjects = Subject::take(3)->get(); // Get first 3 subjects
        $sections = Section::take(2)->get(); // Get first 2 sections
        $rooms = Room::take(2)->get(); // Get first 2 rooms

        $schedules = [
            // Teacher 1 schedules
            [
                'SubjectID' => $subjects[0]->SubjectID,
                'TeacherID' => $teachers[0]->TeacherID,
                'SectionID' => $sections[0]->SectionID,
                'RoomID' => $rooms[0]->RoomID,
                'Day' => 'Monday',
                'Start_Time' => '07:30',
                'End_Time' => '08:30'
            ],
            // Teacher 2 schedules
            [
                'SubjectID' => $subjects[1]->SubjectID,
                'TeacherID' => $teachers[1]->TeacherID,
                'SectionID' => $sections[0]->SectionID,
                'RoomID' => $rooms[1]->RoomID,
                'Day' => 'Monday',
                'Start_Time' => '08:30',
                'End_Time' => '09:30'
            ],
            // Teacher 3 schedules
            [
                'SubjectID' => $subjects[2]->SubjectID,
                'TeacherID' => $teachers[2]->TeacherID,
                'SectionID' => $sections[1]->SectionID,
                'RoomID' => $rooms[0]->RoomID,
                'Day' => 'Monday',
                'Start_Time' => '09:30',
                'End_Time' => '10:30'
            ],
            // Additional schedules for different days
            [
                'SubjectID' => $subjects[0]->SubjectID,
                'TeacherID' => $teachers[0]->TeacherID,
                'SectionID' => $sections[1]->SectionID,
                'RoomID' => $rooms[1]->RoomID,
                'Day' => 'Tuesday',
                'Start_Time' => '07:30',
                'End_Time' => '08:30'
            ],
            [
                'SubjectID' => $subjects[1]->SubjectID,
                'TeacherID' => $teachers[1]->TeacherID,
                'SectionID' => $sections[1]->SectionID,
                'RoomID' => $rooms[0]->RoomID,
                'Day' => 'Wednesday',
                'Start_Time' => '13:30',
                'End_Time' => '14:30'
            ]
        ];

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }

        $this->command->info('Sample schedules seeded successfully!');
    }
}