@extends('admin.layouts.dashboard')

@section('title','افزودن سوال')

@section('content')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>
                افزودن سوال برای
            </span>
            <span>
                {{$lesson->title}}
            </span>
            <a href="{{route('questions.index',$lesson->id)}}"
               class="btn btn-outline-primary btn-sm float-end fa-8">برگشت</a>
        </div>
        <div class="card-body px-0">

            @include('components.allAlerts')

            <form action="{{route('questions.store')}}" method="post">

                @csrf

                <input type="hidden" name="lesson_id" value="{{$lesson->id}}">

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">متن سوال</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('question_text') is-invalid @enderror" type="text"
                               name="question_text" placeholder="متن سوال را وارد کنید"
                               value="{{old('question_text')}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">گزینه اول</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('option1') is-invalid @enderror" type="text"
                               name="option1" placeholder="گزینه اول سوال را وارد کنید"
                               value="{{old('option1')}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">گزینه دوم</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('option2') is-invalid @enderror" type="text"
                               name="option2" placeholder="گزینه دوم سوال را وارد کنید"
                               value="{{old('option2')}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">گزینه سوم</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('option3') is-invalid @enderror" type="text"
                               name="option3" placeholder="گزینه سوم سوال را وارد کنید"
                               value="{{old('option3')}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">گزینه چهارم</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('option4') is-invalid @enderror" type="text"
                               name="option4" placeholder="گزینه چهارم سوال را وارد کنید"
                               value="{{old('option4')}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">پاسخ سوال</label>
                    <div class="col-sm-9 col-lg-10">
                        <select name="answer" class="form-select">
                            <option value="1">گزینه اول</option>
                            <option value="2">گزینه دوم</option>
                            <option value="3">گزینه سوم</option>
                            <option value="4">گزینه چهارم</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">امتیاز سوال</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control plc-rtl @error('order') is-invalid @enderror" type="number"
                               name="score" placeholder="امتیاز سوال را وارد کنید" min="1" max="100" value="20">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit"
                            class="btn btn-sm small btn-primary btn-block col-6 col-sm-4 col-md-3 col-lg-2">
                        افزودن سوال
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
