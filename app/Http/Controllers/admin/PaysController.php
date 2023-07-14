<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePayRequest;
use App\Models\Pay;
use Illuminate\Http\Request;

class PaysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pays = Pay::orderBy('id', 'desc')->get();
        return view('admin.pays.index')->with('pays', $pays);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pay $pay)
    {
        return view('admin.pays.edit', compact('pay'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePayRequest $request, Pay $pay)
    {
        //update pay in database
        $pay->update([
            'status' => $request->status,
            'ref_id' => $request->status ? $request->ref_id : '',
        ]);

        //انتساب دوره به کاربر یا حذف رابطه دوره و کاربر
        $bought_course = $pay->course;

        if (!$bought_course)
            abort(503);

        if ($request->course_user)
            $pay->user->courses()->attach([$bought_course->id => ['group_id' => $pay->group_id, 'pay_id' => $pay->id]]);
        else
            $pay->user->courses()->detach($bought_course->id);


        return redirect(route('pays.index'))->with('پرداخت و سفارش با موفقیت ویرایش شد');

    }

}
