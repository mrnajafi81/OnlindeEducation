<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'fullname' => 'مدیر سایت',
            'number' => '09910001122',
            'role' => 'admin',
            'password' => Hash::make('Admin@1234'),
            'number_verified_at' => Carbon::now(),
        ]);

        User::create([
            'fullname' => 'دانشجو',
            'number' => '09910002233',
            'role' => 'user',
            'password' => Hash::make('User@1234'),
            'number_verified_at' => Carbon::now(),
        ]);
    }
}
