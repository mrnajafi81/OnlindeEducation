<header class="p-0 m-0 py-2 shadow-sm border-bottom border-light h-auto bg-white" x-data="{mobileMenuHide:true}">
    <div class="d-flex justify-content-between container align-items-center my-1">

        <!--logo-->
        <a href="{{route('front.index')}}" class="text-decoration-none">
            <h1 class="site-logo text-nowrap fw-bolder fs-3 text-color-main text-start m-0"
                style="font-family: 'B Yekan' !important;">آموزش آنلاین</h1>
        </a>
        <!--end logo-->

        <!--menu-->
        <nav id="main-menu" class="nav fw-bold d-none d-md-flex">
            <a class="nav-link text-dark" href="{{route('front.index')}}">صفحه اصلی</a>
            <a class="nav-link text-dark" href="{{route('front.all-courses')}}">دوره ها</a>
            <a class="nav-link text-dark" href="{{route('front.about-us')}}">تماس با ما</a>
            <a class="nav-link text-dark" href="{{route('front.about-us')}}">درباره ما</a>
        </nav>
        <!--end menu-->

        <!--buttons-->
        <div class="d-flex justify-content-end align-items-center gap-3">
            @if(auth()->user())
                <div class="dropdown">
                    <button
                        class="btn-hover btn btn-sm text-color-main border-color-main fw-medium border-2 text-nowrap dropdown-toggle"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{auth()->user()->fullname}}
                    </button>
                    <ul class="dropdown-menu">
                        @if(auth()->user()->role == 'admin')
                            <li>
                                <a class="dropdown-item" href="{{route('admin.index')}}">
                                    <i class="fa fa-user fa-sm"></i>
                                    <span class="ms-1">پنل مدیریت</span>
                                </a>
                            </li>
                        @else
                            <li>
                                <a class="dropdown-item" href="{{route('account.index')}}">
                                    <i class="fa fa-user fa-sm"></i>
                                    <span class=" ms-1">حساب کاربری</span>
                                </a>
                            </li>
                        @endif
                        <li>
                            <a class="dropdown-item text-danger" href="{{route('auth.logout')}}">
                                <i class="fa fa-outdent fa-sm"></i>
                                <span class="fw-medium ms-1">خروج</span>
                            </a>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{route('auth.index')}}"
                   class="btn-hover btn btn-sm text-color-main border-color-main fw-medium border-2 text-nowrap">
                    ثبت نام | ورود
                </a>
            @endif
            <button class="btn btn-secondary btn-hover fs-8 d-flex align-items-center py-2
                 border-2 border-color-main text-color-main bg-white
                 d-block d-md-none" @click="mobileMenuHide = !mobileMenuHide">
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <!--end buttons-->
    </div>

    <!--mobile menu-->
    <nav id="mobile-menu" class="nav flex-column fw-medium text-center mt-3 d-none" :class="{'d-none':mobileMenuHide}"
         x-transition>
        <a class="border m-3 border-2 nav-link text-dark" href="{{route('front.index')}}">صفحه اصلی</a>
        <a class="border m-3 border-2 nav-link text-dark" href="{{route('front.all-courses')}}">دوره ها</a>
        <a class="border m-3 border-2 nav-link text-dark" href="{{route('front.about-us')}}">تماس با ما</a>
        <a class="border m-3 border-2 nav-link text-dark" href="{{route('front.about-us')}}">درباره ما</a>
    </nav>
    <!--end mobile menu-->

</header>
