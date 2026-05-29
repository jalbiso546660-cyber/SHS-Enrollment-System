<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class employee_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registrar = User::where('email', 'Registrar@umindanao.edu.oh')->first();

        if (!$registrar) {
            User::create([
                'name' => 'RegistrarUM',
                'email' => 'RegistrarUM@umindanao.edu.ph',
                'password' => Hash::make('RegistrarUM'),
                'role' => 'Registrar'
            ]);

            $this->command->info('Registrar created successfully!');
        } else {
            $this->command->info('Registrar already exists!');
        }
    }
}
