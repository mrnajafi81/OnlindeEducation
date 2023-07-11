<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function index()
    {
        return view('front.home');
    }

    public function showCourse(Course $course)
    {
        //چک کردن اینکه گروه آموزشی برای این دوره فعال هست (ثبت نامی برای این دوره فعال هست)
        $currentGroup = $course->groups()->where('ended_at', '>=', Carbon::now())->first();

        // اگر کاربر لاگین هست آیا این دوره را خریده یا خیر
        $userHasThisCourse = false;
        $user = auth()->user();
        if ($user)
            $userHasThisCourse = $user->courses()->wherePivot('course_id', $course->id)->first() ? true : false;


        return view('front.course', compact('course', 'currentGroup', 'userHasThisCourse'));
    }

    public function showCourseLessons(Lesson $lesson)
    {
        return view('front.lessons.index',compact('lesson'));
    }
}
