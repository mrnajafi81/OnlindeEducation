@extends('admin.layouts.dashboard')

@section('title','کاربران')

@section('content')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>لیست کاربران</span>
            <a href="{{route('users.create')}}"
               class="btn btn-outline-primary btn-sm float-end"><small>افزودن</small></a>
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

            @if($users->count())
                <div id="table_overflow">
                    <table class="table table-borderless ">
                        <thead class="thead-light border-bottom">
                        <tr>
                            <th nowrap>آیدی</th>
                            <th nowrap>نام و نام خانوادگی</th>
                            <th nowrap>شماره تلفن</th>
                            <th nowrap>نقش</th>
                            <th nowrap>تاریخ عضویت</th>
                            <th nowrap>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr class="text-muted">
                                <td nowrap>#{{$user->id}}</td>
                                <td>{{$user->fullname}}</td>
                                <td>{{$user->number}}</td>
                                <td>
                                    @if($user->role == 'admin')
                                        ادمین
                                    @else
                                        کاربر
                                    @endif
                                </td>
                                <td>{{$user->created_at->toJalali()->format('Y/m/d')}}</td>
                                <td nowrap>
                                    <a href="{{route('users.edit',$user->id)}}"
                                       class="btn btn-sm btn-warning"><small><i class="text-light fa fa-pencil-alt"></i></small></a>
                                    <form class="d-inline-block" action="{{route('users.destroy',$user->id)}}"
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
                    <span>هیچ استادی ثبت نشده است، لطفا یک استاد اضافه کنید.</span>
                </div>
            @endif
        </div>
    </div>
@endsection

