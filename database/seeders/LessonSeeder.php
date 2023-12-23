<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lesson = Lesson::create([
            'course_id' => 1,
            'title' => "جلسه اول: مقدمه ای بر پایتون",
            'order' => 1,
            'has_test' => 1,
            'passing_mark' => 80,
            'video' => 'storage/videos/video1.mp4',
            'sound' => 'storage/sounds/sound1.mp3',
            'file' => 'storage/files/file1.pdf',
        ]);

        $lesson = Lesson::create([
            'course_id' => 1,
            'title' => "جلسه دوم: آموزش متغیرها",
            'order' => 2,
            'has_test' => 1,
            'passing_mark' => 80,
            'video' => 'storage/videos/video1.mp4',
        ]);

        $lesson = Lesson::create([
            'course_id' => 1,
            'title' => "جلسه اول: آموزش عملگرها",
            'order' => 3,
            'has_test' => 1,
            'passing_mark' => 80,
            'file' => 'storage/files/file1.pdf',
        ]);

        $lesson = Lesson::create([
            'course_id' => 1,
            'title' => "جلسه چهارم: آموزش کنترل شرطی",
            'order' => 4,
            'has_test' => 1,
            'passing_mark' => 80,
            'sound' => 'storage/sounds/sound1.mp3',
            'file' => 'storage/files/file1.pdf',
        ]);
    }
}
