@extends('front.layouts.app')

@section('title','بازیابی رمز عبور')

@section('contents')
    <section class="container-fluid py-2 py-sm-3 py-md-4 py-lg-5 px-2 px-md-3 px-lg-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4 mx-auto mt-3">

            <div class="card border-color-main px-md-4 px-lg-5">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-center mb-4 mt-3">
                        <h1 class="h4 fw-bold text-muted">تغییر رمز عبور</h1>
                    </div>

                    @include('components.errorsAlert')

                    <form action="{{route('auth.change-password')}}" method="POST">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label">رمز عبور :</label>
                            <input class="form-control border-color-main @error('password') is-invalid @enderror"
                                   type="password" name="password" placeholder="رمز عبور موردنظر خود را وارد کنید">
                            <span class="small text-danger text-muted"><small>* رمز عبور باید حداقل 8 کاراکتر و شامل حرف و عدد باشد</small></span>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">تکرار رمز عبور :</label>
                            <input
                                class="form-control border-color-main @error('password') is-invalid @enderror"
                                type="password" name="password_confirmation"
                                placeholder="تکرار رمز عبور را وارد کنید">
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn text-white border-color-main bg-color-main d-block w-100">
                                تغییر رمز عبور
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
