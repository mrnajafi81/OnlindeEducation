@extends('admin.layouts.dashboard')

@section('title')
    پرداخت ها
@endsection

@section('content')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>
                پرداخت ها
            </span>
        </div>
        <div class="card-body px-0">

            @include('components.allAlerts')

            @if($pays->count())
                <div id="table_overflow">
                    <table class="table table-borderless ">
                        <thead class="thead-light border-bottom border-secondary">
                        <tr>
                            <th nowrap>آیدی</th>
                            <th nowrap>کاربر</th>
                            <th nowrap>دوره مربوطه</th>
                            <th nowrap>گروه مربوطه</th>
                            <th nowrap>قیمت</th>
                            <th nowrap>وضعیت</th>
                            <th nowrap>شماره تراکنش</th>
                            <th nowrap>تاریخ و ساعت</th>
                            <th nowrap>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pays as $pay)
                            <tr class="text-muted">
                                <td nowrap>#{{$pay->id}}</td>
                                <td>{{$pay->user->fullname}}</td>
                                <td>{{\Illuminate\Support\Str::limit($pay->course->title,30)}}</td>
                                <td>{{\Illuminate\Support\Str::limit($pay->group->title,30)}}</td>
                                <td>{{$pay->price}}</td>
                                <td>
                                    @if($pay->status)
                                        <span class="fs-9 text-success">پرداخت موفق</span>
                                    @else
                                        <sapan class="fs-9 text-danger">پرداخت ناموفق</sapan>
                                    @endif
                                </td>
                                <td>{{$pay->ref_id ? $pay->ref_id : 'ندارد'}}</td>
                                <td class="text-start rtl">{{$pay->created_at->toJalali()->format("d %B Y H:i:s")}}</td>
                                <td nowrap>
                                    <a href="{{route('pays.edit',$pay->id)}}"
                                       class="btn btn-sm btn-warning"><small><i class="text-light fa fa-pencil-alt"></i></small></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-primary fa-8">
                    <span>هیچ گروهی ثبت نشده است، لطفا یک گروه ایجاد کنید.</span>
                </div>
            @endif
        </div>
    </div>
@endsection

