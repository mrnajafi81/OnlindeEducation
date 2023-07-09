@extends('front.layouts.app')

@section('title','اعتبار سنجی شماره موبایل')

@section('contents')
    <section class="container-fluid py-2 py-sm-3 py-md-4 py-lg-5 px-2 px-md-3 px-lg-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4 mx-auto mt-3">

            <div id="logo" class="w-100 d-flex justify-content-center mb-4">
                {{--                <img src="{{asset('assets/images/bootstrap-logo.png')}}" width="100px" class="mx-auto">--}}
            </div>

            <div class="card border-primary px-md-4 px-lg-5">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-center mb-4 mt-3">
                        <h1 class="h4 fw-bold text-muted">اعتبار سنجی شماره موبایل</h1>
                    </div>

                    @include('components.errorsAlert')

                    <p class="small">
                        <span>کد اعتبار سنجی به شماره موبایل</span>
                        {{$number}}
                        <span>ارسال شده. لطفا کد را وارد نمایید.</span>
                        <span id='timer' class="timer @error('wrong_verify_code')d-none @enderror"></span>
                        <a href="#" id="btn_again" style="display: none;">ارسال دوباره</a>
                    </p>

                    <!-- this form is for send verify number again-->
                    <form id="send_again_form" action="{{route('auth.send-verify-code-again')}}" class="d-none"
                          method="post">
                        @csrf
                    </form>

                    <form action="{{route('auth.verify-number')}}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">کد اعتبارسنجی :</label>
                            <input class="form-control border-primary @error('verify_code') is-invalid @enderror"
                                   type="number" name="verify_code" placeholder="XXXXX">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">متن کپچا :</label>
                            <div class="input-group">
                                <input type="text" name="captcha" class="form-control"
                                       style="direction:ltr !important;text-align: left!important;">
                                <span class="input-group-text p-0 m-0">
                                    <img id="captcha_img" src="{{captcha_src('flat')}}">
                                </span>
                                <button id="changeCaptcha" type="button" class="input-group-text">
                                    <i class="fa fa-redo-alt"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary d-block w-100">
                                اعتبارسنجی
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('end-body')
    <script>
        let timeoutHandle;
        let sendAgainBtn = document.getElementById('btn_again');
        let sendAgainForm = document.getElementById('send_again_form');
        let btnChangeCaptcha = document.getElementById('changeCaptcha');
        let captchaImg = document.getElementById('captcha_img');

        function countdown(minutes, seconds) {
            localStorage.setItem('minutes', minutes)

            function tick() {
                var counter = document.getElementById("timer");
                counter.innerHTML =
                    minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
                seconds--;
                if (seconds >= 0) {
                    localStorage.setItem('seconds', seconds);
                    timeoutHandle = setTimeout(tick, 1000);
                } else {
                    if (minutes >= 1) {
                        // countdown(mins-1);   never reach “00″ issue solved:Contributed by Victor Streithorst
                        setTimeout(function () {
                            countdown(minutes - 1, 59);
                        }, 1000);
                    } else {
                        sendAgainBtn.style.display = 'inline';
                    }
                }
            }

            tick();
        }

        @if(!$errors->any() && session()->has('verify-send'))
        localStorage.setItem('minutes', 2);
        localStorage.setItem('seconds', 0);
        @endif

        let minutes = localStorage.getItem('minutes');
        let seconds = localStorage.getItem('seconds');

        countdown(minutes, seconds);

        // send verify code again
        sendAgainBtn.onclick = (e) => {
            e.preventDefault();
            sendAgainForm.submit();
        }


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
