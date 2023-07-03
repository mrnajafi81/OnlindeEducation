@extends('admin.layouts.dashboard')

@section('title','برچسب ها')

@section('content')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>لیست برچسب ها</span>
            <a href="{{route('tags.create')}}"
               class="btn btn-outline-primary btn-sm float-end"><small>افزودن</small></a>
        </div>
        <div class="card-body px-0">

            @include('admin.components.successAlert')

            @if($tags->count())
                <div id="table_overflow">
                    <table class="table table-borderless ">
                        <thead class="thead-light">
                        <tr>
                            <th nowrap>آیدی</th>
                            <th nowrap>نام</th>
                            <th nowrap>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <td nowrap>#{{$tag->id}}</td>
                                <td nowrap>{{$tag->name}}</td>
                                <td nowrap>
                                    <a href="{{route('tags.edit',$tag->id)}}"
                                       class="btn btn-sm btn-warning"><small>ویرایش</small></a>
                                    <form class="d-inline-block" action="{{route('tags.destroy',$tag->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit">
                                                <small>حذف</small>
                                            </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-primary fa-8">
                    <span>هیچ برچسبی وجود ندارد لطفا یک برچسب اضافه کنید.</span>
                </div>
            @endif
        </div>
    </div>
@endsection

