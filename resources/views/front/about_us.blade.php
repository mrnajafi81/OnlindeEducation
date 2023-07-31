@extends('front.layouts.app')

@section('title','سامانه آموزش مجازی امامت_همه دوره ها')

@section('contents')

    <section class="container mb-5">

        <!--page title-->
        <div id="course-title"
             class="shadow-sm d-flex align-items-center bg-white border border-success-subtle rounded-1 my-5 mb-3">
            <h1 class="fw-medium fs-3 border-start border-5 ps-2 ms-3 py-1 border-color-main">درباره ما</h1>
        </div>
        <!--end page title-->

        <!--courses-->
        <div id="contents">

            <h1 class="h4 text-center text-color-main">بسم الله الرحمن الرحیم</h1>

            <!--about us-->
            <h5>درباره سامانه آموزش مجازی امامت</h5>

            <p>
                سامانه آموزش مجازی امامت  با بهره گیری از بهترین و بروزترین سیستم آموزش مجازی، با هدف ارائه آموزش های مجازی در زمینه کتاب های دینی و اعتقادی از سال 1402 کار خود را شروع کرد.
                خدمات این سامانه ارائه آموزش هایی مجازی در قالب ویدئو ، فایل صوتی و جزوات و آزمون های تستی برای سنجش فراگیری هر درس می باشد.
                امیدواریم بتوانیم امکانات خوبی را در اختیار شما کاربران گرامی قرار دهیم.
            </p>
            <!--end about us-->

            <!--tell us-->
            <h5 class="mt-5">شماره های تماس با پشتیبانی سایت</h5>

            <div class="links w-100">
                <nav class="nav px-0  flex-column">
                    <li class="nav-link ps-0" href="#">
                        <h6 class="text-dark fw-medium mb-3 fs-55">
                            <i class="fa fa-phone fa-sm"></i>
                            <span>پشتیبانی سایت : </span>
                        </h6>
                        <p class="text-muted text-nowrap">شماره تماس : 09176623243</p>
                        <p class="text-muted text-nowrap">شماره دفتر : 0743440000 (پاسخگویی فقط در ساعات اداری)</p>
                        <p class="text-muted text-nowrap">ایتا : @mr-najafi</p>
                    </li>
                    <li class="nav-link ps-0" href="#">
                        <h6 class="text-dark fw-medium mb-3 fs-55">
                            <i class="fa fa-phone fa-sm"></i>
                            <span>پشتیبانی فنی : </span>
                        </h6>
                        <p class="col-12 col-md-7 col-lg-6 text-muted fs-9">لطفا درصورت مشاهده مشکل در سایت به آیدی ایتای پشتیبانی فنی سایت پیام دهید (برای پاسخگویی بهتر شماره تلفن همراهی که با آن در سایت ثبت نام کرده اید و نام و نام خانوادگی خود را در پیام ذکر کنید).</p>
                        <p class="text-muted text-nowrap">شماره تماس : 09176623243</p>
                        <p class="text-muted text-nowrap">ایتا : @mr-najafi</p>
                    </li>
                </nav>
            </div>
            <!--end tell us-->

            <!--about us-->
            <h5>قوانین استفاده از سامانه امامت</h5>

            <p>1. حق استفاده از هر دوره آموزشی فقط برای خریدار آموزش می باشد.</p>
            <p>2. بعد از خرید دوره آموزشی کاربر فقط در زمان تعیین شده در صفحه دوره قادر خواهد بود آمون های دوره را انجام دهد و بعد از آن آزمون ها قفل می شود.</p>
            <p>3. هر کاربر فقط 3 بار حق شرکت در آزمون هر درس را دارد.</p>
            <p>4. برای انجام آزمون هر درس کاربر موظف است نمره قبولی را در آزمون درس قبل کسب کرده باشد. </p>

        </div>
        <!--end courses-->

    </section>

@endsection
