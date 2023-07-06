<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Course;
use App\Models\Group;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::orderBy('id', 'DESC')->get();
        return view('admin.groups.index')->with('groups', $groups);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('admin.groups.create')->with('courses', $courses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupRequest $request)
    {
        //check dates selected valid
        try {
            //convert dates to timestamp
            $started_at = Verta::parse($request->started_at)->datetime();
            $ended_at = Verta::parse($request->ended_at)->datetime();

            //check ended_at bigger than started_at time
            if ($started_at > $ended_at)
                throw new \Exception('started_at date is bigger than ended_at date');

        } catch (\Exception $exception) {
            //if dates invalid return error
            return back()->withErrors(['date' => 'لطفا تاریخ را بصورت صحیح انتخاب کنید']);
        }

        //check course that this group belongs to it
        $course = Course::findOrFail($request->course_id);

        //store group
        Group::create([
            'title' => $request->title,
            'course_id' => $course->id,
            'started_at' => $started_at,
            'ended_at' => $ended_at,
        ]);

        //return success
        return redirect(route('groups.index'))->with('success', 'گروه آموزشی با موفقیت ایجاد شد');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        $courses = Course::all();
        return view('admin.groups.edit')->with(['group' => $group, 'courses' => $courses]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        //check dates selected valid
        try {
            //convert dates to timestamp
            $started_at = Verta::parse($request->started_at)->datetime();
            $ended_at = Verta::parse($request->ended_at)->datetime();

            //check ended_at bigger than started_at time
            if ($started_at > $ended_at)
                throw new \Exception('started_at date is bigger than ended_at date');

        } catch (\Exception $exception) {
            //if dates invalid return error
            return back()->withErrors(['date' => 'لطفا تاریخ ها را بصورت صحیح انتخاب کنید']);
        }

        //check course that this group belongs to it
        $course = Course::findOrFail($request->course_id);

        //update group in database
        $group->update([
            'title' => $request->title,
            'course_id' => $course->id,
            'started_at' => $started_at,
            'ended_at' => $ended_at,
        ]);

        //return success
        return redirect(route('groups.index'))->with('success', 'گروه آموزشی با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return back()->with('warning','گروه آموزشی با موفقیت حذف شد');
    }
}
