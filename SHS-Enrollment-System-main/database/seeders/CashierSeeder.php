<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CashierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cashier = User::where('email', 'Cashier@umindanao.edu.ph')->first();

        if (!$cashier) {
            User::create([
                'name' => 'CashierUM',
                'email' => 'Cashier@umindanao.edu.ph',
                'password' => Hash::make('CashierUM'),
                'role' => 'Cashier'
            ]);

            $this->command->info('Cashier created successfully!');
        } else {
            $this->command->info('Cashier already exists!');
        }

        
    }
}
