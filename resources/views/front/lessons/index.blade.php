@extends('front.lessons.layouts.app')

@section('title')
    درس های دوره
    {{$lesson->course->title}}
@endsection


@section('contents')
    <div class="wrapper">

        @include('front.lessons.layouts.sidebar')

        <section id="content">

            <div class="card m-5 mt-4 border bg-transparent border-0">
                <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
                    <p class="m-0 p-0">
                        <span>دوره </span>
                        <span>{{$lesson->course->title}}</span>
                        <i class="fa fa-angle-left text-info"></i>
                        <span>{{$lesson->title}}</span>
                    </p>
                </div>
                <div class="card-body px-0">

                    @include('components.errorsAlert')

                    @if($lesson->video)
                        <div class="lesson-video d-flex flex-column align-items-center">
                            <p class="fw-medium">ویدئوی این درس : </p>
                            <video src="{{asset($lesson->video)}}" controls></video>
                        </div>
                    @endif

                    @if($lesson->sound)
                        <div class="lesson-sound d-flex flex-column align-items-center mt-5">
                            <p class="fw-medium">فایل صوتی این درس : </p>
                            <audio src="{{asset($lesson->sound)}}" controls></audio>
                        </div>
                    @endif

                    @if($lesson->file)
                        <div class="lesson-sound d-flex flex-column align-items-center mt-5">
                            <p class="fw-medium">فایل (جزه) این درس : </p>
                            <a href="{{asset($lesson->file)}}" class="btn btn-sm btn-primary w-25" target="_blank">دانلود</a>
                        </div>
                    @endif


                </div>
            </div>

        </section>

    </div>
@endsection
