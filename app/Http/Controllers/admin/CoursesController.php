<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function Symfony\Component\String\b;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index')->with('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::all();
        return view('admin.courses.create')->with('teachers', $teachers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        //چک کردن اینکه آیا استاد انتخاب شده در دیتابیس وجود دارد
        $teacher = Teacher::findOrFail($request->teacher_id);

        //store course to database
        Course::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'price' => $request->price,
            'duration' => $request->duration,
            'type' => $request->type,
            'teacher_id' => $teacher->id,
            'support_number' => $request->support_number,
            'description' => $request->description,
            'image' => $request->file('image')->store('images/courses'),
        ]);

        return redirect(route('courses.index'))->with('success', 'دوره با موفقیت اضافه شد');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $teachers = Teacher::all();
        return view('admin.courses.edit')->with([
            'teachers' => $teachers,
            'course' => $course,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        //اگر آدرس دوره تغییر کرده باشد باید چک کنیم که یونیک باشد
        if ($request->slug != $course->slug) {
            $validator = Validator::make($request->all(), [
                'slug' => ['unique:courses'],
            ]);

            if ($validator->fails())
                return back()->withErrors(['slug' => 'آدرس دوره نباید تکراری باشد']);
        }

        //چک کردن اینکه آیا استاد انتخاب شده در دیتابیس وجود دارد
        $teacher = Teacher::findOrFail($request->teacher_id);

        $course->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'price' => $request->price,
            'duration' => $request->duration,
            'type' => $request->type,
            'teacher_id' => $teacher->id,
            'support_number' => $request->support_number,
            'description' => $request->description,
        ]);

        //if selected new image
        if ($request->image) {
            //delete previous image
            Storage::delete($course->image);

            //upload new image
            $course->image = $request->file('image')->store('images/courses');
            $course->save();
        }

        return redirect(route('courses.index'))->with('success', 'دوره با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //درصورتی که دوره درس داشته باشد جلوگیری شود از حذف دوه
        if ($course->lessons->count())
            return back()->withErrors('برای حذف دوره اول باید تمام درس های آنرا حذف کنید.');

        //حذف تصویر دوره
        Storage::delete($course->image);

        //حذف ریکورد دوره
        $course->delete();

        return back()->with('warning', 'دوره با موفقیت حذف شد');
    }
}
