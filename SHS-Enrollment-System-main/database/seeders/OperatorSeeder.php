<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registrar = User::where('email', 'Operator@umindanao.edu.ph')->first();

        if (!$registrar) {
            User::create([
                'name' => 'OperatorUM',
                'email' => 'OperatorUM@umindanao.edu.ph',
                'password' => Hash::make('OperatorUM'),
                'role' => 'Operator'
            ]);

            $this->command->info('Operator created successfully!');
        } else {
            $this->command->info('Operator already exists!');
        }
    }
}
