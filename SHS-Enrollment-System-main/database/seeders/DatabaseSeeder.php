<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SuperAdminSeeder::class,
            TeacherSeeder::class,
            SectionSeeder::class,
            StrandSeeder::class,
            RoomSeeder::class,
            SubjectSeeder::class,
            ScheduleSeeder::class,
            employee_seeder::class,
            CashierSeeder::class
        ]);
    }
}
