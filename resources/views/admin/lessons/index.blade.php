@extends('admin.layouts.dashboard')

@section('title')
    درس های دوره
    {{$course->titile}}
@endsection

@section('content')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>
                <spna>درس های دوره</spna>
                <span>{{\Illuminate\Support\Str::limit($course->title,35)}}</span>
            </span>
            <a href="{{route('lessons.create',$course->id)}}"
               class="btn btn-outline-primary btn-sm float-end"><small>افزودن</small></a>
        </div>
        <div class="card-body px-0">

            @include('admin.components.allAlerts')

            @if($course->lessons->count())
                <div id="table_overflow">
                    <table class="table table-borderless ">
                        <thead class="thead-light border-bottom border-secondary">
                        <tr>
                            <th nowrap>آیدی</th>
                            <th nowrap>عنوان</th>
                            <th nowrap>ترتیب</th>
                            <th nowrap>ویدئو</th>
                            <th nowrap>صوت</th>
                            <th nowrap>فایل</th>
                            <th nowrap>نمره قبولی در آزمون</th>
                            <th nowrap>سوالات</th>
                            <th nowrap>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($course->lessons()->orderBy('order')->get() as $lesson)
                            <tr class="text-muted">
                                <td nowrap>#{{$lesson->id}}</td>
                                <td>{{$lesson->title}}</td>
                                <td>{{$lesson->order}}</td>
                                <td>
                                    @if($lesson->video)
                                        <a href="{{url($lesson->video)}}" class="btn btn-sm btn-primary" target="_blank">
                                            <small><i class="fa fa-sm fa-link"></i></small>
                                        </a>
                                    @else
                                        <span class="text-danger fs-9">ندارد</span>
                                    @endif
                                </td>
                                <td>
                                    @if($lesson->sound)
                                        <a href="{{url($lesson->sound)}}" class="btn btn-sm btn-primary" target="_blank">
                                            <small><i class="fa fa-sm fa-link"></i></small>
                                        </a>
                                    @else
                                        <span class="text-danger fs-9">ندارد</span>
                                    @endif
                                </td>
                                <td>
                                    @if($lesson->file)
                                        <a href="{{url($lesson->file)}}" class="btn btn-sm btn-primary" target="_blank">
                                            <small><i class="fa fa-sm fa-link"></i></small>
                                        </a>
                                    @else
                                        <span class="text-danger fs-9">ندارد</span>
                                    @endif
                                </td>
                                <td class="fs-9">
                                    @if($lesson->has_test)
                                        <span>حداقل</span>
                                        <span>{{$lesson->passing_mark}}</span>
                                    @else
                                        <span class="text-danger fs-9">آزمون ندارد</span>
                                    @endif
                                </td>
                                <td nowrap>
                                    <a href="{{route('questions.index',$lesson->id)}}"
                                       class="btn btn-sm btn-primary"><small>تغییر سوالات</small></a>
                                </td>
                                <td nowrap>
                                    <a href="{{route('lessons.edit',$lesson->id)}}"
                                       class="btn btn-sm btn-warning"><small><i class="text-light fa fa-pencil-alt"></i></small></a>
                                    <form class="d-inline-block" action="{{route('lessons.destroy',$lesson->id)}}"
                                          method="post">
                                        <div class="form-group">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit">
                                                <small><i class="fa fa-trash-alt fa-sm"></i></small>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-primary fa-8">
                    <span>هیچ درسی ثبت نشده است، لطفا یک درس اضافه کنید.</span>
                </div>
            @endif
        </div>
    </div>
@endsection

