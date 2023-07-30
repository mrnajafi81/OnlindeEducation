<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Pay;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        //تعداد کاربران
        $usersCount = User::count();

        //تعداد دوره های
        $coursesCount = Course::count();

        //درآمد امروز
        $currentDaySales = (int)Pay::whereDate('created_at', Carbon::today())->sum('price');

        //درآمد کل ماه جاری
        $currentMonthSales = (int)Pay::where('status', 1)->whereBetween('created_at',
            [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])->sum('price');


        return view('admin.index')
            ->with(compact(
                "usersCount",
                "currentMonthSales",
                "coursesCount",
                "currentDaySales",
            ));
    }
}
