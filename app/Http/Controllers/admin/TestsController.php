<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;
use function Symfony\Component\String\b;

class TestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tests = Test::join('users', 'tests.user_id', '=', 'users.id')
            ->join('groups', 'tests.group_id', '=', 'groups.id')
            ->join('lessons', 'tests.lesson_id', '=', 'lessons.id')
            ->select('tests.*', 'users.fullname', 'users.number', 'lessons.title', 'groups.title')
            ->search()->orderBy('id', 'desc')->get();

        return view('admin.tests.index')->with('tests', $tests);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //TODO: show test details information
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        //delete test related answer
        $test->answers()->delete();

        //delete test record
        $test->delete();

        return back()->with('warning', 'آزمون با موفقیت حذف شد.');
    }

}
