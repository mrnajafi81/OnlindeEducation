@extends('front.layouts.app')

@section('title','پیش فاکتور خرید دوره آموزشی')

@section('contents')
    <section class="container-fluid py-2 py-sm-3 py-md-4 py-lg-5 px-2 px-md-3 px-lg-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4 mx-auto mt-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-center mb-4 mt-3">
                        <h1 class="h4 fw-bold text-muted">پیش فاکتور خرید دوره</h1>
                    </div>

                    @include('components.errorsAlert')

                    <div class="d-flex justify-content-center">
                        <img src="{{asset($course->image)}}" class="w-75 mx-auto rounded-1">
                    </div>

                    <p class="fw-medium text-center fs-5 mt-3">{{$course->title}}</p>


                    <div class="mb-3 mt-5 d-flex flex-column align-items-center">
                        <p>
                            <span class="fw-medium">مبلغ قابل پرداخت :</span>
                            <span class="fw-medium text-muted">{{$course->price}}</span>
                            <span class="fw-medium fs-9 text-muted">تومان</span>
                        </p>

                        <a href="{{route('pay.request',$course->id)}}" type="submit" class="btn btn-primary d-block w-75 fw-medium fs-55">
                            پرداخت
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
