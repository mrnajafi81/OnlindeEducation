<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Http\Response;

class IndexController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('id', 'desc')->limit(4)->get();
        return view('front.home')->with(['courses' => $courses]);
    }

    public function allCourses()
    {
        $courses = Course::orderBy('id', 'desc')->limit(12)->get();
        return view('front.all_courses')->with('courses', $courses);
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
        //چک کردن اینکه کاربر دوره را خریده
        $user = auth()->user();
        $userHasThisCourse = $user->courses()->wherePivot('course_id', $lesson->course->id)->first() ? true : false;

        if (!$userHasThisCourse)
            return redirect(route('front.course', $lesson->course->id));

        //ست کردن کوکی برای تایید مشاهده این درس توسط کاربر
        $response = new Response(view('front.lessons.index', compact('lesson')));
        $response->withCookie(cookie()->forever('lesson' . $lesson->id, true));

        return $response;
    }
}
