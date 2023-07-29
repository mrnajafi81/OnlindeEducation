@extends('admin.layouts.dashboard')

@section('title','دوره ها')

@section('content')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>لیست دوره ها</span>
            <a href="{{route('courses.create')}}"
               class="btn btn-outline-primary btn-sm float-end"><small>افزودن</small></a>
        </div>
        <div class="card-body px-0">

            @include('components.allAlerts')

            @if($courses->count())
                <div id="table_overflow">
                    <table class="table table-borderless ">
                        <thead class="thead-light border-bottom border-secondary">
                        <tr>
                            <th nowrap>آیدی</th>
                            <th nowrap>تصویر</th>
                            <th nowrap>عنوان</th>
                            <th nowrap>استاد</th>
                            <th nowrap>قیمت</th>
                            <th nowrap>شماره پشتیبانی</th>
                            <th nowrap>آدرس کوتاه</th>
                            <th nowrap>نوع محتوا</th>
                            <th nowrap>مدت زمان</th>
                            <th nowrap>درس های دوره</th>
                            <th nowrap>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr class="text-muted border-bottom">
                                <td nowrap>#{{$course->id}}</td>
                                <td><img src="{{asset($course->image)}}" width="70px" class="rounded-1"
                                         alt="{{$course->name}}"></td>
                                <td>{{$course->title}}</td>
                                <td>{{$course->teacher->name}}</td>
                                <td class="text-nowrap">
                                    <span>{{number_format($course->price)}}</span>
                                    <span class="small">تومان</span>
                                </td>
                                <td>{{$course->support_number}}</td>
                                <td>
                                    <button data-clipboard-text="{{route('front.course',$course->id)}}"
                                            class="btn-slug btn btn-sm btn-light rounded-0 fw-normal">
                                        کپی کردن
                                    </button>
                                </td>
                                <td nowrap>{{$course->type}}</td>
                                <td nowrap>{{$course->duration}}</td>
                                <td nowrap>
                                    <a href="{{route('lessons.index',$course->id)}}"
                                       class="btn btn-sm btn-primary"><small>ویرایش درس ها</small></a>
                                </td>
                                <td nowrap>
                                    <a href="{{route('front.course',$course->id)}}" target="_blank"
                                       class="btn btn-sm btn-info"><small><i
                                                class="text-light fs-9 fa fa-eye"></i></small></a>
                                    <a href="{{route('courses.edit',$course->id)}}"
                                       class="btn btn-sm btn-warning"><small><i class="text-light fa fa-pencil-alt"></i></small></a>
                                    <form class="d-inline-block" action="{{route('courses.destroy',$course->id)}}"
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
                    <span>هیچ دوره ای ثبت نشده است، لطفا یک دوره اضافه کنید.</span>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('end-body')
    <script src="{{asset('assets/js/clipboard.min.js')}}"></script>

    <script>
        let clipboard = new ClipboardJS('.btn-slug');

        clipboard.on('success', function (e) {
            alert('کپی شد');
            e.clearSelection();
        });

    </script>
@endsection

