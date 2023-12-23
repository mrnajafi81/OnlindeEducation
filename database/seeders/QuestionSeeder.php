<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($j = 1; $j < 5; $j++)
            for ($i = 0; $i < 5; $i++)
                Question::create([
                    'lesson_id' => $j,
                    'question_text' => "کدام جزء ویژگی های پایتون نیست ؟",
                    'option1' => "مفسری",
                    'option2' => "کامپایلری",
                    'option3' => "سطح بالا",
                    'option4' => "شی گرا",
                    'answer' => 2,
                    'score' => 20,
                ]);
    }
}
