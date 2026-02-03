<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'nick'],
            [
                'name' => 'Nickson S. Prieto',
                'password' => Hash::make('2134awds'),
                'role' => 'Administrator',
            ]
        );
    }
}