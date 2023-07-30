<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::search()->get();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsersRequest $request)
    {
        User::create([
            'fullname' => $request->fullname,
            'number' => $request->number,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'number_verified_at' => Carbon::now(),
        ]);

        return redirect(route('users.index'))->with('success', 'کاربر با موفقیت انجام شد');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsersRequest $request, User $user)
    {
        //اگر شماره کاربر تغییر کرده باشد با چک کنیم که یونیک باشد
        if ($request->number != $user->number) {
            $validator = Validator::make($request->all(), [
                'number' => ['unique:users'],
            ]);

            if ($validator->fails())
                return back()->withErrors('شماره تلفن همراه کاربر نباید تکراری باشد.');
        }

        $user->update([
            'fullname' => $request->fullname,
            'number' => $request->number,
            'role' => $request->role,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'number_verified_at' => Carbon::now(),
        ]);

        return redirect(route('users.index'))->with('success', 'کاربر با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //TODO:delte user
    }
}
