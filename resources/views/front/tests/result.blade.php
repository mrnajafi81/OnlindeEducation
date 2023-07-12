@extends('front.layouts.app')

@section('title')
    آزمون
    {{$test->lesson->title}}
@endsection

@section('contents')
    <section class="container-fluid py-2 py-sm-3 py-md-4 py-lg-5 px-2 px-md-3 px-lg-5 bg-light">
        <div class="col-12 col-md-10 col-lg-8 mx-auto mt-1">

            <div class="card m-5 mt-4 border bg-transparent border-0">
                <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
                    <p class="m-0 p-0 fs-55">
                        <span>دوره </span>
                        <span>{{$test->lesson->course->title}}</span>
                        <i class="fa fa-angle-left text-info"></i>
                        <span>نتیجه آزمون</span>
                        <span>{{$test->lesson->title}}</span>
                    </p>
                </div>
                <div class="card-body px-1">

                    <div class="alert alert-light">

                        <p class="text-nowrap">
                            <span class="fw-bold">نمره کل : </span>
                            <span class="fw-medium text-primary">{{$test->score}}</span>
                        </p>

                        <p class="text-nowrap">
                            <span class="fw-bold">نتیجه آزمون : </span>
                            @if($test->passed)
                                <span class="fw-medium text-success">قبول شدید</span>
                            @else
                                <span class="fw-medium text-danger">قبول نشدید</span>
                            @endif
                        </p>

                        <p class="text-nowrap">
                            <span class="fw-bold">تعداد کل سوالات : </span>
                            <span class="text-meuted fw-medium">{{$test->answers->count()}}</span>
                        </p>

                        <p class="text-nowrap">
                            <span class="fw-bold">تعداد پاسخ صحیح : </span>
                            <span
                                class="fw-medium text-success">{{$test->answers()->where('is_correct',true)->count()}}</span>
                        </p>

                        <p class="text-nowrap">
                            <span class="fw-bold">تعداد پاسخ غلط : </span>
                            <span
                                class="fw-medium text-danger">{{$test->answers()->where('is_correct',false)->count()}}</span>
                        </p>

                    </div>

                    @if(!$test->passed)
                        <div class="alert alert-warning">
                            <span>شما </span>
                            <span>{{$userChance}}</span>
                            <span>فرصت دیگر برای شرکت در آزمون این درس دارید.</span>
                            <sapn><a href="{{route('tests.index',$test->lesson->id)}}" class="text-warning text-decoration-none">شرکت دوباره در آزمون</a></sapn>
                        </div>
                    @endif

                    <div class="d-flex justify-content-end">
                        <a class="btn btn-sm btn-primary w-25" href="{{route('front.lessons',$test->lesson->id)}}">برگشت به دروس</a>
                    </div>

                </div>
            </div>
    </section>
@endsection
