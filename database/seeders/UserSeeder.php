<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Manager
        User::create([
            'name' => 'Manager',
            'email' => 'manager@mail.com',
            'password' => Hash::make('password'),
            'role' => 'manager'
        ]);

        // Analyst
        User::create([
            'name' => 'Analyst',
            'email' => 'analyst@mail.com',
            'password' => Hash::make('password'),
            'role' => 'analyst'
        ]);

        // 6 Marketing sesuai nama kamu
        $marketingNames = [
            'Heru',
            'Fani',
            'Eka',
            'Agil',
            'Marga',
            'Samuel'
        ];

        foreach ($marketingNames as $index => $name) {
            User::create([
                'name' => $name,
                'email' => strtolower($name).'@mail.com',
                'password' => Hash::make('password'),
                'role' => 'marketing'
            ]);
        }
    }
}
