@extends('admin.layouts.dashboard')

@section('title')
    گروه های آموزشی
@endsection

@section('content')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>
                گروه های آموزشی
            </span>
            <a href="{{route('groups.create')}}"
               class="btn btn-outline-primary btn-sm float-end"><small>افزودن</small></a>
        </div>
        <div class="card-body px-0">

            @include('components.allAlerts')

            @if($groups->count())
                <div id="table_overflow">
                    <table class="table table-borderless ">
                        <thead class="thead-light border-bottom border-secondary">
                        <tr>
                            <th nowrap>آیدی</th>
                            <th nowrap>عنوان</th>
                            <th nowrap>دوره مربوطه</th>
                            <th nowrap>زمان ایجاد</th>
                            <th nowrap>زمان پایان</th>
                            <th nowrap>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $group)
                            <tr class="text-muted">
                                <td nowrap>#{{$group->id}}</td>
                                <td>{{$group->title}}</td>
                                <td>{{$group->course->title}}</td>
                                <td>{{$group->started_at->toJalali()->format("d %B Y")}}</td>
                                <td>{{$group->ended_at->toJalali()->format("d %B Y")}}</td>
                                <td nowrap>
                                    <a href="{{route('groups.edit',$group->id)}}"
                                       class="btn btn-sm btn-warning"><small><i class="text-light fa fa-pencil-alt"></i></small></a>
                                    <form class="d-inline-block" action="{{route('groups.destroy',$group->id)}}"
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
                    <span>هیچ گروهی ثبت نشده است، لطفا یک گروه ایجاد کنید.</span>
                </div>
            @endif
        </div>
    </div>
@endsection

