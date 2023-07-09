<header class="p-0 m-0 py-2 shadow-sm border-bottom border-light h-auto" x-data="{mobileMenuHide:true}">
    <div class="d-flex justify-content-between container align-items-center">

        <!--logo-->
        <h1 class="text-nowrap fw-bolder fs-4 text-color-main text-start m-0"
            style="font-family: 'B Yekan' !important;">سامانه امامت</h1>
        <!--end logo-->

        <!--menu-->
        <nav class="nav fw-medium d-none d-md-flex">
            <a class="nav-link text-dark" href="#">صفحه اصلی</a>
            <a class="nav-link text-dark" href="#">دوره ها</a>
            <a class="nav-link text-dark" href="#">تماس با ما</a>
            <a class="nav-link text-dark" href="#">درباره ما</a>
        </nav>
        <!--end menu-->

        <!--buttons-->
        <div class="d-flex justify-content-end align-items-center gap-3">
            <button class="btn-hover btn btn-sm text-color-main border-color-main fw-medium border-2 text-nowrap">
                ثبت نام | ورود
            </button>
            <button class="btn btn-secondary btn-hover fs-8 d-flex align-items-center py-2
                 border-2 border-color-main text-color-main bg-white
                 d-block d-md-none" @click="mobileMenuHide = !mobileMenuHide">
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <!--end buttons-->
    </div>

    <!--mobile menu-->
    <nav id="mobile-menu" class="nav flex-column fw-medium text-center mt-3 d-none" :class="{'d-none':mobileMenuHide}" x-transition>
        <a class="border m-3 border-2 nav-link text-dark" href="#">صفحه اصلی</a>
        <a class="border m-3 border-2 nav-link text-dark" href="#">دوره ها</a>
        <a class="border m-3 border-2 nav-link text-dark" href="#">تماس با ما</a>
        <a class="border m-3 border-2 nav-link text-dark" href="#">درباره ما</a>
    </nav>
    <!--end mobile menu-->

</header>
