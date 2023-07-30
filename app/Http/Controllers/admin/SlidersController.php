<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlidersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index')->with('sliders', $sliders);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'url' => ['nullable', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png'],
        ]);

        //store slider info to database
        Slider::create([
            "url" => $request->input('url') ?? '#',
            "image" => $request->file('image')->store('images/sliders'),
        ]);

        return redirect(route('sliders.index'))->with('success', 'اسلاید با موفقیت اضافه شد');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        //validate request
        $request->validate([
            'url' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png'],
        ]);

        //store slider info to database
        $slider->update([
            "url" => $request->input('url') ?? '#',
        ]);

        if ($request->image) {
            //delete previous image
            Storage::delete($slider->image);

            //store new image
            $slider->image = $request->file('image')->store('images/sliders');
            $slider->save();
        }

        return redirect(route('sliders.index'))->with('success', 'اسلاید با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        //delete image
        Storage::delete($slider->image);

        $slider->delete();

        return back()->with('warning', 'اسلاید با موفقیت حذف شد');
    }
}
