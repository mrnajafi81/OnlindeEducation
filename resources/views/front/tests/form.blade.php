@extends('front.layouts.app')

@section('title')
    آزمون
    {{$lesson->title}}
@endsection

@section('contents')
    <section class="container-fluid py-2 py-sm-3 py-md-4 py-lg-5 px-2 px-md-3 px-lg-5 bg-light">
        <div class="col-12 col-md-10 col-lg-8 mx-auto mt-1">

            <div class="card m-5 mt-4 border bg-transparent border-0">
                <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
                    <p class="m-0 p-0 fs-55">
                        <span>دوره </span>
                        <span>{{$lesson->course->title}}</span>
                        <i class="fa fa-angle-left text-info"></i>
                        <span>آزمون</span>
                        <span>{{$lesson->title}}</span>
                    </p>
                </div>
                <div class="card-body px-1">

                    @include('components.allAlerts')


                    <form action="{{route('tests.store',$lesson->id)}}" method="POST" class="overflow-auto">

                        @csrf

                        <div class="form-group text-nowrap">

                            @foreach($lesson->questions as $key=>$question)
                                <p class="fw-medium">{{$key+1}}_ {{$question->question_text}}</p>

                                <div class="form-check-inline d-block">
                                    <input class="form-check-input" type="radio" name="question{{$question->id}}" value="1">
                                    <label class="form-check-label">
                                        {{$question->option1}}
                                    </label>
                                </div>

                                <div class="form-check-inline d-block mt-2">
                                    <input class="form-check-input" type="radio" name="question{{$question->id}}" value="2">
                                    <label class="form-check-label">
                                        {{$question->option2}}
                                    </label>
                                </div>

                                <div class="form-check-inline d-block mt-2">
                                    <input class="form-check-input" type="radio" name="question{{$question->id}}" value="3">
                                    <label class="form-check-label">
                                        {{$question->option3}}
                                    </label>
                                </div>

                                <div class="form-check-inline d-block mt-2">
                                    <input class="form-check-input" type="radio" name="question{{$question->id}}" value="4">
                                    <label class="form-check-label">
                                        {{$question->option4}}
                                    </label>
                                </div>

                                @if(!$loop->last)
                                    <hr>
                                @endif

                            @endforeach

                        </div>


                        <div class="form-group d-flex justify-content-end mt-3 mb-3">
                            <button type="submit" class="btn btn-sm btn-primary d-block w-25">
                                ثبت آزمون
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
