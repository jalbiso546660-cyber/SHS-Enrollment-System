<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'Room_Number' => 'A101',
                'Building' => 'Basic ED Building',
                'Floor' => '1st Floor',
                'Room_Type' => 'Classroom',
                'StrandID' => 1,
                'Grade_Level' => 'Grade 11',
                'Capacity' => 40,
                'is_available' => true
            ],
            [
                'Room_Number' => 'A102',
                'Building' => 'Basic ED Building',
                'Floor' => '1st Floor',
                'Room_Type' => 'Classroom',
                'StrandID' => 1,
                'Grade_Level' => 'Grade 12',
                'Capacity' => 40,
                'is_available' => true
            ],
            [
                'Room_Number' => 'B201',
                'Building' => 'Basic ED Building',
                'Floor' => '1sd Floor',
                'Room_Type' => 'Classroom',
                'StrandID' => 2,
                'Grade_Level' => 'Grade 11',
                'Capacity' => 40,
                'is_available' => true
            ],
            [
                'Room_Number' => 'B202',
                'Building' => 'Basic ED Building',
                'Floor' => '1st Floor',
                'Room_Type' => 'Classroom',
                'StrandID' => 2,
                'Grade_Level' => 'Grade 12',
                'Capacity' => 40,
                'is_available' => true
            ],
            [
                'Room_Number' => 'C301',
                'Building' => 'Basic ED Building',
                'Floor' => '3rd Floor',
                'Room_Type' => 'Classroom',
                'StrandID' => 3,
                'Grade_Level' => 'Grade 11',
                'Capacity' => 40,
                'is_available' => true
            ],
            [
                'Room_Number' => 'C302',
                'Building' => 'Basic ED Building',
                'Floor' => '3rd Floor',
                'Room_Type' => 'Classroom',
                'StrandID' => 3,
                'Grade_Level' => 'Grade 12',
                'Capacity' => 40,
                'is_available' => true
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }

        $this->command->info('Rooms seeded successfully!');
    }
}