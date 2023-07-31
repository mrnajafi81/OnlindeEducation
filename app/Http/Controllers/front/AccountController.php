<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    public function index()
    {
        return redirect(route('account.profile'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('front.account.profile', compact('user'));
    }

    public function changeProfile(Request $request)
    {
        $user = auth()->user();

        //validate request
        $request->validate([
            'fullname' => ['required', 'string', 'min:3', 'max:255'],
            'current_password' => ['nullable', Rule::requiredIf(fn() => $request->new_password), 'min:8', Password::min(8)->letters()->numbers(),
                function (string $attribute, mixed $value, \Closure $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail("پسورد فعلی صحیح نمی باشد");
                    }
                },
            ],
            'new_password' => ['nullable', 'min:8', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        //update user
        $user->fullname = $request->fullname;
        //اگر پسورد جدید ست شده بود
        if ($request->new_password)
            //تغییر پسورد
            $user->password = Hash::make($request->new_password);

        //ذخیره تغییرات
        $user->save();

        return back()->with('success', 'اطلاعات کاربری شما با موفقیت ویرایش شد');
    }

    public function pays()
    {
        $user = auth()->user();
        $pays = $user->pays()->orderBy('id', 'desc')->get();
        return view('front.account.pays', compact('user', 'pays'));
    }

    public function courses()
    {
        $user = auth()->user();
        $courses = $user->courses;
        return view('front.account.courses', compact('user', 'courses'));
    }

    public function tests()
    {
        $user = auth()->user();
        $tests = $user->tests()->orderBy('id', 'desc')->get();
        return view('front.account.tests', compact('user', 'tests'));
    }

}
