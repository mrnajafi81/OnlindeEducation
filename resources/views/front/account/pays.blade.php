@extends('front.account.layouts.app')

@section('page-contents')
    <div class="card border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>
                تراکنش ها
            </span>
        </div>

        <div class="card-body px-0">

            @if($pays->count())
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
                            <th nowrap>قیمت</th>
                            <th nowrap>وضعیت</th>
                            <th nowrap>شماره تراکنش</th>
                            <th nowrap>تاریخ و ساعت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pays as $key=>$pay)
                            <tr class="text-muted">
                                <td nowrap>#{{$key+1}}</td>
                                <td>{{$pay->course->title}}</td>
                                <td>{{number_format($pay->price)}}</td>
                                <td>
                                    @if($pay->status)
                                        <span class="fs-9 text-success">پرداخت موفق</span>
                                    @else
                                        <sapan class="fs-9 text-danger">پرداخت ناموفق</sapan>
                                    @endif
                                </td>
                                <td>{{$pay->ref_id ?? 'ندارد'}}</td>
                                <td class="text-start rtl">{{$pay->created_at->toJalali()->format("H:i Y/m/d")}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-primary fa-8">
                    <span>هیچ تراکنشی وجود ندارد.</span>
                </div>
            @endif
        </div>
    </div>
@endsection
