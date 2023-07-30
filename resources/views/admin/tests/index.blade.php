@extends('admin.layouts.dashboard')

@section('title')
    آزمون ها
@endsection

@section('head')
    <script>
        function data() {
            return {
                deleteTest(e) {
                    let deleteTestFormElement = e.target.parentElement.parentElement.parentElement.parentElement;
                    $res = confirm('آیا از حذف اطلاعات این آزمون مطمئن هستید؟' + "\n" + 'با این کار تمام اطلاعات مربوط به این رکورد حذف می شود.');

                    if ($res)
                        deleteTestFormElement.submit();
                }
            }
        }
    </script>
@endsection

@section('content')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>
                آزمون ها
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
                                <option value="group_title" {{request()->query('row') == 'group_title'? 'selected':''}}>
                                    گروه مربوطه
                                </option>
                                <option value="lesson_title" {{request()->query('row') == 'lesson_title'? 'selected':''}}>
                                    درس مربوطه
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

            @if($tests->count())
                <div id="table_overflow" x-data="data()">
                    <table class="table table-borderless ">
                        <thead class="thead-light border-bottom border-secondary">
                        <tr>
                            <th nowrap>آیدی</th>
                            <th nowrap>نام کاربر</th>
                            <th nowrap>شماره کاربر</th>
                            <th nowrap>دوره مربوطه</th>
                            <th nowrap>گروه مربوطه</th>
                            <th nowrap>درس مربوطه</th>
                            <th nowrap>تعداد سوالات</th>
                            <th nowrap>تعداد پاسخ صحیح</th>
                            <th nowrap>تعداد پاسخ غلط</th>
                            <th nowrap>نمره</th>
                            <th nowrap>نتیجه آزمون</th>
                            <th nowrap>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tests as $test)
                            <tr class="text-muted">
                                <td nowrap>#{{$test->id}}</td>
                                <td>{{$test->user->fullname}}</td>
                                <td>{{$test->user->number}}</td>
                                <td>{{\Illuminate\Support\Str::limit($test->course->title,30)}}</td>
                                <td>{{\Illuminate\Support\Str::limit($test->group->title,30)}}</td>
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
                                <td nowrap>
                                    <form class="d-inline-block" action="{{route('admin.tests.destroy',$test->id)}}"
                                          method="post">
                                        <div class="form-group">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" @click.prevent="deleteTest($event)"
                                                    type="submit">
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
                    <span>هیچ آزمونی انجام نشده است.</span>
                </div>
            @endif
        </div>
    </div>
@endsection

