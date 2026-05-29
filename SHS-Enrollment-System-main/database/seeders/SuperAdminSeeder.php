<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();

        if (!$admin) {
            User::create([
                'name' => 'adminUM',
                'email' => 'admin@umindanao.edu.ph',
                'password' => Hash::make('adminUM'),
                'role' => 'Admin'
            ]);

            $this->command->info('Admin created successfully!');
        } else {
            $this->command->info('Admin already exists!');
        }

        
    }
}
