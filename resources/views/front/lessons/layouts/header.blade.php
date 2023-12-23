<header class="p-0 m-0 py-2 shadow-sm border-bottom border-light h-auto bg-white">
    <div class="my-1 d-flex justify-content-center container align-items-center flex-wrap justify-content-sm-between flex-column flex-sm-row gap-3 gap-sm-0">

        <!--logo-->
        <a href="{{route('front.index')}}" class="text-decoration-none">
            <h1 class="site-logo text-nowrap fw-bolder fs-3 text-color-main text-start m-0"
                style="font-family: 'B Yekan' !important;">آموزش آنلاین</h1>
        </a>
        <!--end logo-->

        <!--menu-->
        <div class="d-flex align-items-center">
            <a href="{{route('front.course',$lesson->course->id)}}" class="p-0 m-0 text-decoration-none text-dark">
                <h3 class="fs-55 mb-0 text-nowrap fw-medium">
                <span>
                    درس های دوره
                </span>
                    <span>{{\Illuminate\Support\Str::limit($lesson->course->title,30)}}</span>
                </h3>
            </a>
        </div>
        <!--end menu-->

        <!--buttons-->
        <div class="">
            <a href="#" class="btn btn-secondary btn-hover fs-9 py-2 mb-0 d-flex justify-content-center align-items-center
                 border-2 border-color-main text-color-main bg-white lesson-sidebar-collapse">
                <i class="fa fa-bars m-0"></i>
            </a>
        </div>
        <!--end buttons-->
    </div>


</header>
