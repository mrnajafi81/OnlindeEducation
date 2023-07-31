@extends('front.account.layouts.app')

@section('page-contents')
    <div class="card border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            پروفایل کاربر
        </div>
        <div class="card-body px-0">

            @include('components.allAlerts')

            <p class="small text-muted">
                <span>درصورت تمایل می توانید اطلاعات خود را ویرایش کنید.</span>
                <span>شماره تلفن همراه قابل ویرایش نیست.</span>
            </p>

            <form action="{{route('account.change-profile')}}" method="post">

                @csrf

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">نام و نام خانوادگی</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('fullname') is-invalid @enderror" type="text"
                               name="fullname" placeholder="نام و نام خانوادگی خود را وارد کنید"
                               value="{{$user->fullname}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">شماره تلفن همراه</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control plc-rtl @error('number') is-invalid @enderror" type="number"
                               name="number" minlength="11" disabled
                               maxlength="11" value="{{$user->number}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">رمز عبور فعلی</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control plc-rtl @error('current_password') is-invalid @enderror"
                               type="password"
                               name="current_password" placeholder="رمز عبور فعلی خود را وارد کنید">
                    </div>
                </div>


                <p class="small text-muted">* رمز عبور باید حداقل 8 کاراکتر و شامل حرف و عدد باشد.</p>
                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">رمز عبور جدید</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control plc-rtl @error('new_password') is-invalid @enderror" type="password"
                               name="new_password" placeholder="رمز عبور جدید خود را وارد کنید">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">تکرار رمز عبور جدید</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control plc-rtl @error('new_password') is-invalid @enderror"
                               type="password"
                               name="new_password_confirmation" placeholder="تکرار رمز عبور جدید خود را وارد کنید">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit"
                            class="btn btn-sm small btn-primary btn-block col-6 col-sm-4 col-md-3 col-lg-2">
                        ویرایش اطلاعات
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
