@extends('front.account.layouts.app')

@section('page-contents')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>
                نتیجه آزمون ها
            </span>
        </div>

        <div class="card-body px-0">

            @if($tests->count())
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
                            <th nowrap>دوره مربوطه</th>
                            <th nowrap>درس مربوطه</th>
                            <th nowrap>تعداد سوالات</th>
                            <th nowrap>تعداد پاسخ صحیح</th>
                            <th nowrap>تعداد پاسخ غلط</th>
                            <th nowrap>نمره</th>
                            <th nowrap>نتیجه آزمون</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tests as $key => $test)
                            <tr class="text-muted">
                                <td nowrap>#{{$key+1}}</td>
                                <td>{{\Illuminate\Support\Str::limit($test->course->title,30)}}</td>
                                <td>{{\Illuminate\Support\Str::limit($test->lesson->title,30)}}</td>
                                <td class="text-primary">{{$test->answers->count()}}</td>
                                <td class="text-success">{{$test->answers()->where('is_correct',true)->count()}}</td>
                                <td class="text-danger">{{$test->answers()->where('is_correct',false)->count()}}</td>
                                <td>{{$test->score}}</td>
                                <td>
                                    @if($test->passed)
                                        <span class="fs-9 text-success">قبول شده</span>
                                    @else
                                        <sapan class="fs-9 text-danger">قبول نشده</sapan>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-primary fa-8">
                    <span>هیچ آزمونی انجام نشده است.</span>
                </div>
            @endif
        </div>
    </div>
@endsection
