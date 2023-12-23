<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::create([
            "name" => 'Mosh Hamedani',
            "about" => 'من مهندسان نرم افزار حرفه ای را آموزش می دهم که شرکت ها کاملاً دوست دارند آنها را استخدام کنند.',
            "image" => 'storage/images/teachers/mosh.png',
        ]);
    }
}
