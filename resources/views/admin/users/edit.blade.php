@extends('admin.layouts.dashboard')

@section('title','ویرایش کاربر')

@section('content')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>
                ویرایش کاربر
            </span>
            <a href="{{route('users.index')}}"
               class="btn btn-outline-primary btn-sm float-end fa-8">برگشت</a>
        </div>
        <div class="card-body px-0">

            @include('components.allAlerts')

            <form action="{{route('users.update', $user->id)}}" method="post">

                @csrf
                @method("PUT")

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">نام و نام خانوادگی</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('fullname') is-invalid @enderror" type="text"
                               name="fullname" placeholder="نام و نام خانوادگی کاربر را وارد کنید"
                               value="{{$user->fullname}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">شماره تلفن</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control plc-rtl @error('number') is-invalid @enderror" type="number"
                               name="number" placeholder="شماره تلفن همراه کاربر را وارد کنید" minlength="11"
                               maxlength="11" value="{{$user->number}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">نقش</label>
                    <div class="col-sm-9 col-lg-10">
                        <select name="role" class="form-select">
                            <option value="admin" {{$user->role == 'admin' ? 'selected' : ''}}>ادمین</option>
                            <option value="user" {{$user->role == 'user' ? 'selected' : ''}}>کاربر</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">رمز عبور</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control plc-rtl @error('password') is-invalid @enderror" type="password"
                               name="password" placeholder="رمز عبور کاربر را وارد کنید">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">تکرار رمز عبور</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control plc-rtl @error('password') is-invalid @enderror"
                               type="password"
                               name="password_confirmation" placeholder="تکرار رمز عبور کاربر را وارد کنید">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit"
                            class="btn btn-sm small btn-warning btn-block col-6 col-sm-4 col-md-3 col-lg-2">
                        ویرایش کاربر
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
