@extends('admin.layouts.dashboard')

@section('title')
    سوالات درس
    {{$lesson->title}}
@endsection

@section('content')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>
                <a href="{{route('courses.index')}}" class="text-dark">
                    <spna>دوره</spna>
                    <span>{{\Illuminate\Support\Str::limit($lesson->course->title,35)}}</span>
                </a>
                <span><i class="fa fa-sm fa-angle-left text-info"></i></span>
                <a href="{{route('lessons.index',$lesson->course_id)}}" class="text-dark">
                    <spna>سوالات </spna>
                    <span>{{$lesson->title}}</span>
                </a>
            </span>
            <a href="{{route('questions.create',$lesson->id)}}"
               class="btn btn-outline-primary btn-sm float-end"><small>افزودن</small></a>
        </div>
        <div class="card-body px-0">

            @include('components.allAlerts')

            @if($lesson->questions->count())
                <div class="row">
                    @foreach($lesson->questions as $key => $question)
                        <div class="col-12 col-md-6 col-xl-4 mb-3">
                            <div class="question-item card h-100">
                                <div class="card-body position-relative">
                                    <p class="card-title">
                                        <span>سوال</span>
                                        <span>{{$key+1}}_ </span>
                                        <span>{{$question->question_text}}</span>
                                        <span
                                                class="small text-muted text-nowrap">(امتیاز : {{$question->score}})</span>
                                    </p>
                                    <p class="card-title">
                                        <span>گزینه 1: </span>
                                        <span>{{$question->option1}}</span>
                                        @if($question->answer == 1)
                                            <span
                                                    class="fs-60 text-white badge bg-primary rounded-pill fw-light">پاسخ</span>
                                        @endif
                                    </p>
                                    <p class="card-title">
                                        <span>گزینه 2: </span>
                                        <span>{{$question->option2}}</span>
                                        @if($question->answer == 2)
                                            <span
                                                    class="fs-60 text-white badge bg-primary rounded-pill fw-light">پاسخ</span>
                                        @endif
                                    </p>
                                    <p class="card-title">
                                        <span>گزینه 3: </span>
                                        <span>{{$question->option3}}</span>
                                        @if($question->answer == 3)
                                            <span
                                                    class="fs-60 text-white badge bg-primary rounded-pill fw-light">پاسخ</span>
                                        @endif
                                    </p>
                                    <p class="card-title mb-0">
                                        <span>گزینه 4: </span>
                                        <span>{{$question->option4}}</span>
                                        @if($question->answer == 4)
                                            <span
                                                    class="fs-60 text-white badge bg-primary rounded-pill fw-light">پاسخ</span>
                                        @endif
                                    </p>
                                    <div class="question-buttons">
                                        <a href="{{route('questions.edit',$question->id)}}"
                                           class="badge text-white bg-warning rounded-1 py-2">
                                            <small><i class="text-light fa fa-pencil-alt"></i></small>
                                        </a>
                                        <form class="d-inline-block"
                                              action="{{route('questions.destroy',$question->id)}}" method="post">
                                            <div class="form-group">
                                                @csrf
                                                @method('DELETE')
                                                <button class="badge text-white bg-danger rounded-1 py-2 border-0"
                                                        type="submit">
                                                    <small><i class="fa fa-trash-alt fa-sm"></i></small>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-primary fa-8">
                    <span>هیچ سوالی برای این درس ثبت نشده است، لطفا یک سوال اضافه کنید.</span>
                </div>
            @endif
        </div>
    </div>
@endsection
