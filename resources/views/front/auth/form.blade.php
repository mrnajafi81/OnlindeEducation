@extends('front.layouts.app')

@section('title','ورود - ثبت نام در سامانه امامت')

@section('head')
    <style>
        #pills-tab {
            gap: 10px !important;
        }
    </style>
@endsection

@section('contents')
    <section class="container-fluid py-2 py-sm-3 py-md-4 py-lg-5 px-2 px-md-3 px-lg-5 my-3">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4 mx-auto mt-3">


            <div class="card border-color-main px-md-4 px-lg-5 mb-3">
                <div class="card-body">
                    <ul class="nav nav-pills w-100 d-flex flex-nowrap justify-content-between" id="pills-tab"
                        role="tablist">
                        <li class="nav-item w-100 h-100 h-100" role="presentation">
                            <button
                                class="nav-link border border-color-main w-100 h-100 {{session()->has('login')?'':'active'}}"
                                id="pills-register-tab"
                                data-bs-toggle="pill"
                                data-bs-target="#register" type="button" role="tab" aria-controls="register"
                                aria-selected="{{session()->has('login')?'false':'true'}}">
                                ثبت نام
                            </button>
                        </li>
                        <li class="nav-item w-100 h-100 h-100" role="presentation">
                            <button
                                class="nav-link border border-color-main w-100 h-100 {{session()->has('login')?'active':''}}"
                                id="pills-login-tab"
                                data-bs-toggle="pill"
                                data-bs-target="#login" type="button" role="tab"
                                aria-controls="login"
                                aria-selected="{{session()->has('login')?'true':'false'}}">
                                ورود
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card border-color-main px-md-4 px-lg-5">
                <div class="card-body tab-content">

                    <!--register section-->
                    <div id="register" class="tab-pane fade {{session()->has('login')?'':'show active'}}"
                         role="tabpanel"
                         aria-labelledby="register-tab">
                        <div class="card-title d-flex justify-content-center mb-3 mt-3">
                            <h1 class="h4 fw-bold text-muted">ثبت نام در سامانه امامت</h1>
                        </div>

                        @include('components.allAlerts')

                        <form action="{{route('auth.pre-register')}}" method="POST">

                            @csrf

                            <div class="mb-3">
                                <label class="form-label">نام و نام خانوادگی :</label>
                                <input class="form-control border-color-main @error('fullname') is-invalid @enderror"
                                       type="text" name="fullname" placeholder="نام و نام خانوادگی خود را وارد کنید"
                                       value="{{old('fullname')}}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">شماره تلفن :</label>
                                <input class="form-control border-color-main @error('number') is-invalid @enderror"
                                       type="number" name="number" placeholder="مثال : 09170001122"
                                       value="{{old('number')}}">
                            </div>

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
                                    ثبت نام
                                </button>
                            </div>

                        </form>
                    </div>
                    <!--end register section-->


                    <!--login section-->
                    <div id="login" class="tab-pane fade {{session()->has('login')?'show active':''}}"
                         role="tabpanel"
                         aria-labelledby="login-tab">
                        <div class="card-title d-flex justify-content-center mb-4 mt-3">
                            <h1 class="h4 fw-bold text-muted">ورود به سامانه امامت</h1>
                        </div>

                        @include('components.allAlerts')

                        <form action="{{route('auth.login')}}" method="POST">

                            @csrf

                            <div class="mb-3">
                                <label class="form-label">شماره تلفن :</label>
                                <input class="form-control border-color-main @error('number') is-invalid @enderror"
                                       type="number" name="number" placeholder="مثال : 09170001122"
                                       id="number"
                                       value="{{old('number')}}">
                            </div>

                            <div class="mb-4">
                                <label class="form-label">رمز عبور :</label>
                                <input class="form-control border-color-main @error('password') is-invalid @enderror"
                                       type="password" name="password" placeholder="رمز عبور خود را وارد کنید">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">متن کپچا :</label>
                                <div class="input-group">
                                    <input type="text" name="captcha" class="form-control" style="direction:ltr !important;text-align: left!important;">
                                    <span class="input-group-text p-0 m-0">
                                        <img id="captcha_img" src="{{captcha_src('flat')}}">
                                    </span>
                                    <button id="changeCaptcha" type="button" class="input-group-text">
                                        <i class="fa fa-redo-alt"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="form-check-inline mb-3">
                                <input class="form-check-input border-color-main" type="checkbox" name="remember_me"
                                       value="true">
                                <label class="form-check-label">
                                    <small>
                                        مرا به خاطر بسپار
                                    </small>
                                </label>
                            </div>

                            <div class="mb-3">
                                <a href="{{route('auth.forget-password-form')}}" class="fs-9 text-muted text-decoration-none">رمز عبور خود را فراموش کرده اید؟</a>
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" class="btn text-white border-color-main bg-color-main d-block w-100">
                                    ورود
                                </button>
                            </div>


                        </form>
                    </div>
                    <!--end login section-->

                </div>
            </div>
        </div>
    </section>
@endsection

@section('end-body')
    <script>
        let btnChangeCaptcha = document.getElementById('changeCaptcha');
        let captchaImg = document.getElementById('captcha_img');

        btnChangeCaptcha.onclick = function (e) {
            fetch('/change-captcha')
                .then((response) => {
                    response.json().then((d) => {
                        let captchaSrc = d.captcha;
                        captchaImg.setAttribute('src', captchaSrc);
                    });
                });
        }
    </script>
@endsection
