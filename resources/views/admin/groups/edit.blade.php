@extends('admin.layouts.dashboard')

@section('title','ویرایش گروه آموزشی')

@section('head')
    <link rel="stylesheet" href="{{asset('assets/css/jalalidatepicker.min.css')}}">
@endsection

@section('content')
    <div class="card m-5 border bg-transparent border-0"
         x-data="{started_at:'{{$group->started_at->toJalali()->format('Y-m-d')}}'}">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>
               ویرایش گروه آموزشی
            </span>
            <a href="{{route('groups.index')}}"
               class="btn btn-outline-primary btn-sm float-end fa-8">برگشت</a>
        </div>
        <div class="card-body px-0">

            @include('components.allAlerts')

            <form action="{{route('groups.update',$group->id)}}" method="post">

                @csrf
                @method('put')

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">عنوان گروه</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('title') is-invalid @enderror" type="text"
                               name="title" placeholder="عنوان گروه آموزشی را وارد کنید"
                               value="{{$group->title}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">دوره مربوطه</label>
                    <div class="col-sm-9 col-lg-10">
                        <select name="course_id" class="form-select">
                            @foreach($courses as $course)
                                <option value="{{$course->id}}"
                                        selected="{{$group->course_id == $course->id ? true:false}}">
                                    {{$course->title}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">شروع ثبت نام از</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('started_at') is-invalid @enderror"
                               name="started_at" x-model="started_at" @click="$refs.ended_at.value = ''"
                               data-jdp data-jdp-min-date="today" placeholder="لطفا تاریخ شروع ثبت نام را انتخاب کنید">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">پایان ثبت نام تا</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('ended_at') is-invalid @enderror"
                               name="ended_at" value="{{$group->ended_at->toJalali()->format('Y-m-d')}}"
                               x-ref="ended_at"
                               data-jdp :data-jdp-min-date="started_at"
                               placeholder="لطفا تاریخ پایان ثبت نام را انتخاب کنید">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit"
                            class="btn btn-sm small btn-warning btn-block col-6 col-sm-4 col-md-3 col-lg-2">
                        ویرایش گروه آموزشی
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('end-body')
    <script src="{{asset('assets/js/jalalidatepicker.min.js')}}"></script>
    <script>
        jalaliDatepicker.startWatch({
            minDate: "attr",
            maxDate: "attr",
            separatorChars: {date: '-'},
        });
    </script>
@endsection
