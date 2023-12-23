<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create([
            'title' => "آموزش مقدماتی پایتون",
            'slug' => "آموزش-مقدماتی-پایتون",
            'price' => 250000,
            'duration' => 8,
            'type' => "فیلم - جزوه",
            'teacher_id' => 1,
            'support_number' => "09170001122",
            'description' => "«زبان برنامه نویسی پایتون» (Python Programming Language)، زبانی با یادگیری آسان محسوب می‌شود و از همین رو بسیاری از برنامه‌نویس‌های تازه‌کار آن را به عنوان اولین زبان برنامه‌نویسی خود برمی‌گزینند، زیرا پایتون به عنوان یک «زبان همه‌منظوره» (General-Purpose Language) ساخته و توسعه داده شده و محدود به توسعه نوع خاصی از نرم‌افزارها نیست. به بیان دیگر، می‌توان از آن برای هر کاری، از «تحلیل داده» (Data Analysis) گرفته تا ساخت بازی‌های کامپیوتری استفاده کرد. بنابراین، یادگیری پایتون بسیار حائز اهمیت است.",
            'image' => 'storage/images/courses/course.png',
        ]);
    }
}
