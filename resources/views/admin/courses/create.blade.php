@extends('admin.layouts.dashboard')

@section('title','افزودن دوره آموزشی')

@section('content')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>
                افزودن دوره آموزشی
            </span>
            <a href="{{route('courses.index')}}"
               class="btn btn-outline-primary btn-sm float-end fa-8">برگشت</a>
        </div>
        <div class="card-body px-0">

            @include('components.allAlerts')

            <form action="{{route('courses.store')}}" method="post" enctype="multipart/form-data">

                @csrf

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">عنوان دوره</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('title') is-invalid @enderror" type="text"
                               name="title" placeholder="عنوان دوره را وارد کنید"
                               value="{{old('title')}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">آدرس دوره</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('slug') is-invalid @enderror" type="text"
                               name="slug" placeholder="آدرس دوره را وارد کنید"
                               value="{{old('slug')}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">قیمت دوره</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control plc-rtl @error('price') is-invalid @enderror" type="number"
                               name="price" placeholder="قیمت دوره را وارد کنید" min="1"
                               value="{{old('price')}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">مدت دوره</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('duration') is-invalid @enderror" type="text"
                               name="duration" placeholder="مدت دوره را وارد کنید"
                               value="{{old('duration')}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">نوع محتوا</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('type') is-invalid @enderror" type="text"
                               name="type" placeholder="نوع محتوای دوره را وارد کنید"
                               value="{{old('type')}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">استاد دوره</label>
                    <div class="col-sm-9 col-lg-10">
                        <select name="teacher_id" class="form-select">
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">شماره پشتیبانی دوره</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control plc-rtl @error('support_number') is-invalid @enderror" type="number"
                               name="support_number" placeholder="شماره پشتیبانی دوره را وارد کنید" minlength="11"
                               maxlength="11" value="{{old('support_number')}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">توضیحات دوره</label>
                    <div class="col-sm-9 col-lg-10">
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" placeholder="توضیحات دوره را وارد کنید">{{old('description')}}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">تصویر دوره</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('image') is-invalid @enderror" type="file" name="image">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit"
                            class="btn btn-sm small btn-primary btn-block col-6 col-sm-4 col-md-3 col-lg-2">
                        افزودن دوره
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
