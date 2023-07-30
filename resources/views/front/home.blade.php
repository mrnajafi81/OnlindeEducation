@extends('front.layouts.app')

@section('title','سامانه آموزش مجازی امامت')

@section('contents')

    <section id="main-content" class="container mb-5">

        <!--slider-->
        <div class="mt-4 mb-5 row justify-content-center">
            <div class="col-12 col-lg-9 col-xl-8">
                <div id="main-carousel" class="carousel slide rounded-3 overflow-hidden h-100 shadow-sm">

                    <div class="carousel-indicators">
                        @foreach($sliders as $key => $slider)
                            <button type="button" data-bs-target="#main-carousel" data-bs-slide-to="{{$key}}"
                                    class="{{$loop->first ? 'active' : ''}}"
                                    aria-current="{$loop->first ? 'active' : 'false'}}"
                                    aria-label="Slide {{$key}}"></button>
                        @endforeach
                    </div>

                    <div class="carousel-inner ">
                        @foreach($sliders as $key => $slider)
                            <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                                <a href="{{$slider->url}}" class="text-decoration-none m-0 p-0 w-100">
                                    <img src="{{asset($slider->image)}}" class="d-block w-100 ">
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#main-carousel"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#main-carousel"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                </div>
            </div>
        </div>
        <!--edn slider-->

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
