<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function index(Course $course)
    {
        $enableGroupe = $course->groups()->where('ended_at', '>=', Carbon::now())->first();

        //چک کردن اینکه آیا ثبت نامی برای این دوره فعال هست
        if (!$enableGroupe) {
            return redirect(route('front.course', $course->id));
        }

        //چک کرن اینکه از قبل کاربر این آموزش را نخریده باشد.
        $userHasThisCourse = $course->users()->wherePivot('id',auth()->user()->id)->first();
        if ($userHasThisCourse)
            return abort(403);

        return view('front.checkout', compact('course', 'enableGroupe'));
    }
}
