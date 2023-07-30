@extends('admin.layouts.dashboard')

@section('title','اسلایدر')

@section('content')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>لیست اسلاید ها</span>
            <a href="{{route('sliders.create')}}"
               class="btn btn-outline-primary btn-sm float-end"><small>افزودن</small></a>
        </div>
        <div class="card-body px-0">

            @include('components.allAlerts')

            @if($sliders->count())
                <div id="table_overflow">
                    <table class="table table-borderless ">
                        <thead class="thead-light border-bottom">
                        <tr>
                            <th nowrap>آیدی</th>
                            <th nowrap>تصویر اسلاید</th>
                            <th nowrap>آدرس اسلاید</th>
                            <th nowrap>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $slider)
                            <tr class="text-muted">
                                <td nowrap>#{{$slider->id}}</td>
                                <td><img src="{{asset($slider->image)}}" width="200px" class="rounded-1"></td>
                                <td>{{$slider->url}}</td>
                                <td nowrap>
                                    <a href="{{route('sliders.edit',$slider->id)}}"
                                       class="btn btn-sm btn-warning"><small><i class="text-light fa fa-pencil-alt"></i></small></a>
                                    <form class="d-inline-block" action="{{route('sliders.destroy',$slider->id)}}"
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
                    <span>هیچ اسلایدی ثبت نشده است، لطفا یک اسلاید اضافه کنید.</span>
                </div>
            @endif
        </div>
    </div>
@endsection

