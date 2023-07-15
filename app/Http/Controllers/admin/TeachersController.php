<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use Illuminate\Support\Facades\Storage;
use function Symfony\Component\String\b;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('admin.teachers.index')->with('teachers', $teachers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request)
    {
        Teacher::create([
            "name" => $request->name,
            "about" => $request->about,
            "image" => $request->file('image')->store('images/teachers'),
        ]);

        return redirect(route('teachers.index'))->with('success', 'استاد با موفقیت اضافه شد');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->update([
            "name" => $request->name,
            "about" => $request->about,
        ]);

        //if selected new image
        if ($request->has('image')) {
            //delete previous image
            Storage::delete($teacher->image);

            //upload new image
            $teacher->image = $request->file('image')->store('images/teachers');
            $teacher->save();
        }

        return redirect(route('teachers.index'))->with('success', 'استاد با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        // اگر دوره ای مربوط به این استاد وجود داشته باشد. نباید رکورد حذف شود.
        if ($teacher->courses->count())
            return back()->withErrors('برای حذف این استاد اول دوره های مربوط به این استاد را حذف کنید.');

        //delete teacher image
        Storage::delete($teacher->image);

        //delete teacher recorde
        $teacher->delete();

        return back()->with('warning','استاد با موفقیت حذف شد');
    }
}
