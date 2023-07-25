@extends('front.layouts.app')

@section('title','سامانه آموزش مجازی امامت')

@section('contents')

    <section class="container">

        <!--course title-->
        <div id="course-title" class="shadow-sm d-flex align-items-center bg-white border border-success-subtle rounded-1 my-5">
            <h1 class="fw-medium fs-3 border-start border-5 ps-2 ms-3 py-1 border-color-main">{{$course->title}}</h1>
        </div>
        <!--end course title-->

        <!--course contents-->
        <div class="row mb-5 mt-1">

            <!--sidebar-->
            <div class="col-12 col-lg-4">

                <!--course image-->
                <img class="shadow-sm w-100 rounded-1" src="{{asset($course->image)}}" alt="{{$course->title}}">

                <!--course info-->
                <div id="course-info" class="card border-success-subtle shadow-sm mt-3">
                    <div class="card-body">
                        <p class="card-title fw-medium fs-5 pb-3">
                            مشخصات دوره
                        </p>
                        <div class="d-flex flex-column gap-3">

                            <div
                                class="bg-light py-2 px-3 rounded-1 d-flex justify-content-between flex-nowrap align-items-center py-3">
                                <p class="fw-medium text-nowrap">قیمت دوره : </p>
                                <p class="text-muted fw-medium text-nowrap">
                                    <span>{{number_format($course->price)}}</span>
                                    <span class="fs-9">تومان</span>
                                </p>
                            </div>


                            <div
                                class="bg-light py-2 px-3 rounded-1 d-flex justify-content-between flex-nowrap align-items-center py-3">
                                <p class="fw-medium text-nowrap">مدت زمان : </p>
                                <p class="text-muted fw-medium text-nowrap fs-9">
                                    <span>{{$course->duration}}</span>
                                    <span>ساعت</span>
                                </p>
                            </div>

                            <div
                                class="bg-light py-2 px-3 rounded-1 d-flex justify-content-between flex-nowrap align-items-center py-3">
                                <p class="fw-medium text-nowrap">تعداد درس : </p>
                                <p class="text-muted fw-medium text-nowrap fs-9">{{$course->lessons->count()}}
                                    درس</p>
                            </div>

                            <div
                                class="bg-light py-2 px-3 rounded-1 d-flex justify-content-between flex-nowrap align-items-center py-3">
                                <p class="fw-medium text-nowrap">نوع آموزش : </p>
                                <p class="text-muted fw-medium text-nowrap fs-9">{{$course->type}}</p>
                            </div>

                            @if($currentGroup)
                                <div
                                    class="bg-light py-2 px-3 rounded-1 d-flex justify-content-between flex-nowrap align-items-center py-3">
                                    <p class="fw-medium text-nowrap">تاریخ شروع دوره : </p>
                                    <p class="text-muted fw-medium text-nowrap fs-9">{{$currentGroup->started_at->toJalali()->format('Y/m/d')}}</p>
                                </div>

                                <div
                                    class="bg-light py-2 px-3 rounded-1 d-flex justify-content-between flex-nowrap align-items-center py-3">
                                    <p class="fw-medium text-nowrap">تاریخ پایان دوره : </p>
                                    <p class="text-muted fw-medium text-nowrap fs-9">{{$currentGroup->ended_at->toJalali()->format('Y/m/d')}}</p>
                                </div>

                                @if($userHasThisCourse)
                                    <a href="{{route('front.lessons',$course->lessons()->orderBy('order')->first())}}"
                                       class="btn btn-success fw-medium fs-55 w-100 my-2 shadow-sm">
                                        مشاهده دروس دوره
                                    </a>
                                @else
                                    <a href="{{route('checkout.index',$course->id)}}"
                                       class="btn btn-primary fw-medium fs-55 w-100 my-2 shadow-sm">
                                        شرکت در دوره
                                    </a>
                                @endif

                            @else

                                @if($userHasThisCourse)
                                    <a href="{{route('front.lessons',$course->lessons()->orderBy('order')->first())}}"
                                       class="btn btn-success fw-medium fs-55 w-100 my-2 shadow-sm">
                                        مشاهده دروس دوره
                                    </a>
                                @else
                                    <span class="small text-danger d-block mt-2">* در حال حاضر ثبت نامی برای این دوره وجود ندارد.</span>
                                    <button type="button"
                                            class="btn btn-secondary fw-medium fs-55 w-100 mb-2 mt-1 shadow-sm"
                                            disabled="true">
                                        شرکت در دوره
                                    </button>
                                @endif

                            @endif

                        </div>
                    </div>
                </div>
                <!--end course info-->


                <!--course teacher-->
                <div class="card border-success-subtle shadow-sm mt-3">
                    <div class="card-body">
                        <p class="card-title fw-medium fs-5 mb-2 text-center">
                            مدرس دوره
                        </p>
                        <div class="d-flex align-items-center justify-content-start gap-3 border-bottom pb-3">
                            <img src="{{asset($course->teacher->image)}}" class="rounded-1" width="70px">
                            <div class="w-50">
                                <p class="mb-0">{{$course->teacher->name}}</p>
                            </div>
                        </div>
                        <div>
                            <p class="fs-55 fw-medium text-center mt-3 mb-2">درباره مدرس</p>
                            <p>{{$course->teacher->about}}</p>
                        </div>
                    </div>
                </div>
                <!--end course teacher-->

            </div>
            <!--end sidebar-->

            <!--main contents-->
            <div class="col-12 col-lg-8 mt-4 mt-lg-0">

                <!--course description-->
                <div class="card border-success-subtle shadow-sm">
                    <div class="card-body">
                        <p class="card-title fw-medium fs-5 mb-3">
                            توضیحات دوره
                        </p>
                        <p class="text-start py-2 rounded-1 mb-0">{{$course->description}}</p>
                    </div>
                </div>
                <!--end course description-->

                <!--course lessons-->
                <div class="card border-success-subtle shadow-sm mt-4">
                    <div class="card-body">
                        <p class="card-title fw-medium fs-5 mb-4">
                            درس های دوره
                        </p>
                        <div class="d-flex flex-column align-items-start">
                            @foreach($course->lessons()->orderBy('order')->get() as $lesson)
                                <p class="text-start mb-3 d-flex align-items-center gap-2 border-bottom border-color-main border-3">
                                    <i class="fa fa-list-alt text-success"></i>
                                    <span class="text-muted mb-1 fw-medium">{{$lesson->title}}</span>
                                </p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--end course lessons-->

            </div>
            <!--end main contents-->


        </div>
        <!--end course contents-->


    </section>

@endsection
