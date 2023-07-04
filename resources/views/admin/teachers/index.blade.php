@extends('admin.layouts.dashboard')

@section('title','اساتید')

@section('content')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>لیست استاد ها</span>
            <a href="{{route('teachers.create')}}"
               class="btn btn-outline-primary btn-sm float-end"><small>افزودن</small></a>
        </div>
        <div class="card-body px-0">

            @include('admin.components.allAlerts')

            @if($teachers->count())
                <div id="table_overflow">
                    <table class="table table-borderless ">
                        <thead class="thead-light border-bottom">
                        <tr>
                            <th nowrap>آیدی</th>
                            <th nowrap>تصویر استاد</th>
                            <th nowrap>نام استاد</th>
                            <th nowrap>درباره استاد</th>
                            <th nowrap>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teachers as $teacher)
                            <tr class="text-muted">
                                <td nowrap>#{{$teacher->id}}</td>
                                <td><img src="{{asset($teacher->image)}}" width="70px" class="rounded-1"
                                         alt="{{$teacher->name}}"></td>
                                <td>{{$teacher->name}}</td>
                                <td style="min-width: 200px !important;">{{$teacher->about}}</td>
                                <td nowrap>
                                    <a href="{{route('teachers.edit',$teacher->id)}}"
                                       class="btn btn-sm btn-warning"><small>ویرایش</small></a>
                                    <form class="d-inline-block" action="{{route('teachers.destroy',$teacher->id)}}"
                                          method="post">
                                        <div class="form-group">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit">
                                                <small>حذف</small>
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

