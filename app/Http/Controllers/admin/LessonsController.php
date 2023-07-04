<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        return view('admin.lessons.index', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        return view('admin.lessons.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLessonRequest $request)
    {
        // get course that this lesson belongs to it
        $course = Course::findOrFail($request->course_id);

        //check order is unique
        $lessonWithEnteredOrder = Lesson::where('course_id', $course->id)->where('order', $request->order)->first();
        if ($lessonWithEnteredOrder) {
            return back()->withErrors(['order' => 'درسی با این ترتیب از قبل وجود دارد']);
        }

        DB::beginTransaction();

        //store lesson
        $lesson = Lesson::create([
            'course_id' => $course->id,
            'title' => $request->title,
            'order' => $request->order,
            'has_test' => $request->has_test,
            'passing_mark' => $request->has_test ? $request->passing_mark : 0,
        ]);

        //upload video if exist
        if ($request->video) {
            $lesson->update([
                'video' => $request->file('video')->store('videos'),
            ]);
        }

        //upload sound if exist
        if ($request->sound) {
            $lesson->update([
                'sound' => $request->file('sound')->store('sounds'),
            ]);
        }

        //upload file if exist
        if ($request->file) {
            $lesson->update([
                'file' => $request->file('file')->store('files'),
            ]);
        }

        DB::commit();

        return redirect(route('lessons.index', $course->id))->with('success', 'درس با موفقیت اضافه شد');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $lesson)
    {
        return view('admin.lessons.edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        //check order is changed
        if ($request->order != $lesson->order) {
            //check order is unique
            $lessonWithEnteredOrder = Lesson::where('course_id', $lesson->course_id)->where('order', $request->order)->first();
            if ($lessonWithEnteredOrder) {
                return back()->withErrors(['order' => 'درسی با این ترتیب از قبل وجود دارد']);
            }
        }

        DB::beginTransaction();

        //update lesson
        $lesson->update([
            'title' => $request->title,
            'order' => $request->order,
            'has_test' => $request->has_test,
            'passing_mark' => $request->has_test ? $request->passing_mark : 0,
        ]);

        //video change section code
        $this->lessonMediaUpdate($request, $lesson, 'video');

        //sound change section code
        $this->lessonMediaUpdate($request, $lesson, 'sound');

        //file change section code
        $this->lessonMediaUpdate($request, $lesson, 'file');

        DB::commit();

        return redirect(route('lessons.index', $lesson->course_id))->with('success', 'درس با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        //if lesson has questions con not delete it
        if ($lesson->questions->count()) {
            return back()->withErrors(['questions' => 'برای حذف این درس لطفا ابتدا سوالات مربوط به آزمون این درس را حذف کنید.']);
        }

        //delete lesson media
        if ($lesson->video)
            Storage::delete($lesson->video);

        if ($lesson->sound)
            Storage::delete($lesson->sound);

        if ($lesson->file)
            Storage::delete($lesson->file);

        //delete lesson
        $lesson->delete();

        return back()->with('warning', 'درس با موفقیت حذف شد.');
    }

    /**
     * وردودی این متد video یا sound یا file می باشد.
     * این متد عملیات تغییر مدیای کد درس و حذف کلی مدیای یک درس را انجام میدهد.
     */
    protected function lessonMediaUpdate($request, $lesson, $field)
    {
        $tag = 'delete_' . $field;

        //video change section code
        if ($request->{$tag}) {
            //null the field of this lesson
            Storage::delete($lesson->{$field});
            $lesson->update([
                $field => '',
            ]);

        } elseif ($request->{$field}) {

            //delete previous video if exist
            if ($lesson->{$field}) {
                Storage::delete($lesson->{$field});
            }

            //upload and store new field
            $lesson->update([
                $field => $request->file($field)->store($field . 's'),
            ]);

        }

    }

}
