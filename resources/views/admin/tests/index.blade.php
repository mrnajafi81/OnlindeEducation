@extends('admin.layouts.dashboard')

@section('title')
    آزمون ها
@endsection

@section('head')
    <script>
        function data() {
            return {
                deleteTest(e){
                    let deleteTestFormElement = e.target.parentElement.parentElement.parentElement.parentElement;
                    $res = confirm('آیا از حذف اطلاعات این آزمون مطمئن هستید؟'+"\n"+'با این کار تمام اطلاعات مربوط به این رکورد حذف می شود.');

                    if($res)
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
        <div class="card-body px-0">

            @include('components.allAlerts')

            @if($tests->count())
                <div id="table_overflow" x-data="data()">
                    <table class="table table-borderless ">
                        <thead class="thead-light border-bottom border-secondary">
                        <tr>
                            <th nowrap>آیدی</th>
                            <th nowrap>کاربر</th>
                            <th nowrap>گروه مربوطه</th>
                            <th nowrap>دوره مربوطه</th>
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
                                <td>{{\Illuminate\Support\Str::limit($test->group->title,30)}}</td>
                                <td>{{\Illuminate\Support\Str::limit($test->lesson->course->title,30)}}</td>
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
                                            <button class="btn btn-sm btn-danger" @click.prevent="deleteTest($event)" type="submit">
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

