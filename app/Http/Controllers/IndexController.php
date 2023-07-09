<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('front.home');
    }

    public function showCourse(Course $course)
    {
        $currentGroup = $course->groups()->where('ended_at','>=',Carbon::now())->first();
        return view('front.course', compact('course','currentGroup'));
    }
}
