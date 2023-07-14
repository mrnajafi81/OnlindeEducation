@extends('admin.layouts.dashboard')

@section('title','ویرایش پرداخت ها و سفارشات')

@section('head')
    <style>
        input[type=number]::placeholder{
            direction: rtl !important;
            text-align: right;
        }
    </style>
@endsection

@section('content')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>
               ویرایش پرداخت ها و سفارشات
            </span>
            <a href="{{route('pays.index')}}"
               class="btn btn-outline-primary btn-sm float-end fa-8">برگشت</a>
        </div>
        <div class="card-body px-0">

            @include('components.allAlerts')

            <form action="{{route('pays.update',$pay->id)}}" method="post" x-data="{ payStatus: {{$pay->status ? 1 : 0 }} }">

                @csrf
                @method('put')

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">وضعیت پرداخت</label>
                    <div class="col-sm-9 col-lg-10">
                        <select name="status" class="form-select" :class="payStatus=='1'?'text-success':'text-danger'"
                                x-model="payStatus" >
                            <option value="1" class="text-success" {{$pay->status? 'selected' : ''}} >پرداخت موفق
                            </option>
                            <option value="0" class="text-danger" {{$pay->status? '' : 'selected'}} >پرداخت ناموفق
                            </option>
                        </select>
                    </div>
                </div>


                <div class="row mb-3" :class="{'d-none':payStatus=='1'?false:true}">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">شماره تراکنش</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('ref_id') is-invalid @enderror" type="number"
                               name="ref_id" placeholder="شماره تراکنش را وارد کنید"
                               value="{{$pay->ref_id}}">
                    </div>
                </div>


                <div class="mb-3">
                    <p>
                        <sapn>* دوره آموزشی</sapn>
                        <span class="fw-medium">{{$pay->course->title}}</span>
                        <span>برای کاربر </span>
                        <span class="fw-medium">{{$pay->user->fullname}}</span>
                        <span>ثبت</span>
                        <span class="fw-medium">ثبت شود ؟</span>
                    </p>
                    <select name="course_user" class="form-select" x-model="payStatus" :class="payStatus=='1'?'text-success':'text-danger'">
                        <option value="1" class="text-success" {{$pay->status? 'selected' : ''}} >
                            بله
                        </option>
                        <option value="0" class="text-danger" {{$pay->status? '' : 'selected'}} >
                            خیر
                        </option>
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit"
                            class="btn btn-sm small btn-warning btn-block col-6 col-sm-4 col-md-3 col-lg-2">
                        ویرایش پرداخت
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
