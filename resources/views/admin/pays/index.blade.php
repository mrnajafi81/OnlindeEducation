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

        <div class="card-body">
            <form class="d-flex flex-wrap align-items-center justify-content-between" action="" id="search-form">

                <div class="search-inputs overflow-x-hidden mb-3 mb-lg-0">

                    <div class="d-inline-block mb-2 text-nowrap">
                        <span>جستجوی </span>
                        <div class="form-check-inline me-1">
                            <input type="text" class="form-control form-control-sm w-md-100" name="search"
                                   placeholder="کلمه مورد نظر" value="{{request()->query('search')}}">
                        </div>
                    </div>

                    <div class="d-inline-block text-nowrap">
                        <span>در ردیف </span>
                        <div class="form-check-inline">
                            <select name="row" class="form-select form-select-sm w-md-100">
                                <option
                                    value="user_fullname" {{request()->query('row') == 'user_fullname'? 'selected':''}}>
                                    نام کاربر
                                </option>
                                <option
                                    value="user_number" {{request()->query('row') == 'user_number'? 'selected':''}}>
                                    شماره کاربر
                                </option>
                                <option
                                    value="course_title" {{request()->query('row') == 'course_title'? 'selected':''}}>
                                    دوره مربوطه
                                </option>
                                <option value="group_title" {{request()->query('row') == 'group_title'? 'selected':''}}>
                                    گروه مربوطه
                                </option>
                                <option value="ref_id" {{request()->query('row') == 'ref_id'? 'selected':''}}>
                                    شماره تراکنش
                                </option>
                            </select>
                        </div>
                    </div>

                </div>

                <button type="submit" id="search" class="btn btn-sm btn-outline-primary" style="width: 100px">
                    جستجو
                </button>


            </form>
        </div>

        <div class="card-body px-0">

            @include('components.allAlerts')

            @if($pays->count())
                <div id="table_overflow">
                    <table class="table table-borderless ">
                        <thead class="thead-light border-bottom border-secondary">
                        <tr>
                            <th nowrap>آیدی</th>
                            <th nowrap>نام کاربر</th>
                            <th nowrap>شماره کاربر</th>
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
                                <td>{{$pay->user->number}}</td>
                                <td>{{$pay->course->title}}</td>
                                <td>{{$pay->group->title}}</td>
                                <td>{{number_format($pay->price)}}</td>
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
                    <span>هیچ پرداختی وجود ندارد.</span>
                </div>
            @endif
        </div>
    </div>
@endsection

