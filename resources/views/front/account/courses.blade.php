@extends('front.account.layouts.app')

@section('page-contents')
    <div class="card border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>لیست دوره ها</span>
        </div>
        <div class="card-body px-0">

            @if($courses->count())
                <div id="table_overflow">

                    <p class="text-danger small d-block d-sm-none">
                        <spna>* برای کامل دیدن جدول، جدول را به سمت راست</spna>
                        (<i class="fa fa-hand-point-up"></i>)
                        <span>بکشید</span>
                    </p>

                    <table class="table table-borderless ">
                        <thead class="thead-light border-bottom border-secondary">
                        <tr>
                            <th nowrap>ردیف</th>
                            <th nowrap>تصویر</th>
                            <th nowrap>عنوان</th>
                            <th nowrap>استاد</th>
                            <th nowrap>قیمت</th>
                            <th nowrap>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $key=>$course)
                            <tr class="text-muted border-bottom">
                                <td nowrap>#{{$key+1}}</td>
                                <td><img src="{{asset($course->image)}}" width="70px" class="rounded-1"
                                         alt="{{$course->name}}"></td>
                                <td>{{$course->title}}</td>
                                <td>{{$course->teacher->name}}</td>
                                <td class="text-nowrap">
                                    <span>{{number_format($course->price)}}</span>
                                    <span class="small">تومان</span>
                                </td>
                                <td nowrap>
                                    <a href="{{route('front.course',$course->id)}}" target="_blank"
                                       class="btn btn-sm btn-info">
                                        <small>
                                            <i class="text-light fs-9 fa fa-eye"></i>
                                        </small>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-primary fa-8">
                    <span>شما هنوز هیچ دوره ای را خریداری نکرده اید</span>
                </div>
            @endif
        </div>
    </div>
@endsection
