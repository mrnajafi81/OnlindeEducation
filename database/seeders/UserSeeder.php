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
            'fullname' => 'محمدرضا نجفی',
            'number' => '09176623243',
            'role' => 'admin',
            'password' => Hash::make('@Najafi81'),
            'number_verified_at' => Carbon::now(),
        ]);
    }
}
