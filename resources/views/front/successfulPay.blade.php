@extends('front.layouts.app')

@section('title','خرید دوره آموزشی - پرداخت موفق')

@section('contents')
    <section class="container-fluid py-2 py-sm-3 py-md-4 py-lg-5 px-2 px-md-3 px-lg-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4 mx-auto mt-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="card-title d-flex flex-column align-items-center mb-4 mt-3">
                        <h1 class="h4 fw-bold text-success">پرداخت موفق</h1>
                        <p class="text-muted small fw-medium">پرداخت با موفقیت انجام شد. این دوره برای شما ثبت شد.</p>
                    </div>


                    <div class="d-flex justify-content-center">
                        <img src="{{asset($pay->course->image)}}" class="w-75 mx-auto rounded-1">
                    </div>

                    <p class="fw-medium text-center fs-5 mt-3">{{$pay->course->title}}</p>


                    <div class="mb-3 mt-5 d-flex flex-column align-items-center">
                        <p>
                            <span class="fw-medium">مبلغ پرداخت شده :</span>
                            <span class="fw-medium text-muted">{{number_format($pay->course->price)}}</span>
                            <span class="fw-medium fs-9 text-muted">تومان</span>
                        </p>
                        <p>
                            <span class="fw-medium">شماره پیگیری تراکنش :</span>
                            <span class="fw-medium text-muted">{{$pay->ref_id}}</span>
                        </p>
                        <p>
                            <span class="fw-medium">زمان پرداخت :</span>
                            <span class="fw-medium text-muted">{{$pay->created_at->toJalali()->format('H:i Y/m/d')}}</span>
                        </p>

                        <a href="{{route('front.course',$pay->course->id)}}" type="submit"
                           class="btn btn-primary d-block w-75 fw-medium fs-55">
                            برگشت به دوره
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
