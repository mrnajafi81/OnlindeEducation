@extends('admin.layouts.dashboard')

@section('title','ویرایش اسلاید')

@section('content')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>
                ویرایش اسلاید
            </span>
            <a href="{{route('sliders.index')}}"
               class="btn btn-outline-primary btn-sm float-end fa-8">برگشت</a>
        </div>
        <div class="card-body px-0">

            @include('components.allAlerts')

            <form action="{{route('sliders.update',$slider->id)}}" method="post" enctype="multipart/form-data">

                @csrf

                @method("PUT")

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">آدرس اسلاید</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('url') is-invalid @enderror" type="text"
                               name="url" placeholder="آدرس اسلاید را وارد کنید"
                               value="{{$slider->url}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">تصویر اسلاید</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('image') is-invalid @enderror" type="file" name="image">
                    </div>
                </div>

                <div class="slider-image d-flex justify-content-center">
                    <img src="{{asset($slider->image)}}" width="300px">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit"
                            class="btn btn-sm small btn-warning btn-block col-6 col-sm-4 col-md-3 col-lg-2">
                        ویرایش اسلاید
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
