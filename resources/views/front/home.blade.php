@extends('front.layouts.app')

@section('title','سامانه آموزش مجازی امامت')

@section('contents')

    <section id="main-content" class="container my-5">
        <h1 class="h5 fw-bold border-bottom border-3 border-color-main pb-2">جدیدترین دوره ها</h1>

        <div class="row">

            @foreach($courses as $course)
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <a href="{{route('front.course',$course->id)}}" class="text-decoration-none m-0 p-0">
                        <div class="card mt-4 course-item shadow-sm border border-color-main">
                            <img src="{{asset($course->image)}}" class="card-img-top">

                            <div class="card-body">

                                <p class="fw-bold fs-55">{{$course->title}}</p>
                                <p class="fw-medium">
                                    <span>مدرس : </span>
                                    <sapn>{{$course->teacher->name}}</sapn>
                                </p>

                                <div
                                    class="bg-secondary-subtle rounded-pill d-flex flex-nowrap justify-content-around align-items-center py-2 px-3 fs-8">

                                    <div class="fw-medium text-nowrap">
                                        <i class="fa fa-dollar-sign"></i>
                                        <span>{{number_format($course->price)}}</span>
                                        <span class="small">تومان</span>
                                    </div>

                                    <div class="fw-medium text-nowrap">
                                        <i class="fa fa-clock"></i>
                                        <span>{{$course->duration}}</span>
                                        <span class="small">ساعت</span>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </a>
                </div>
            @endforeach

        </div>

    </section>

@endsection
