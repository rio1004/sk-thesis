<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'admin',
            'middle_name' => 'admin',
            'last_name' => 'admin',
            'age' => 'admin',
            'gender' => 'admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'brgy' => 'Salvacion',
        ])->assignRole('super-admin');

        User::create([
            'first_name' => 'test',
            'middle_name' => 'test',
            'last_name' => 'test',
            'age' => 'test',
            'gender' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('test'),
            'brgy' => 'Salvacion',
        ])->assignRole('admin');
    }
}
