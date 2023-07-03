@extends('admin.layouts.dashboard')

@section('title')
    @isset($tag)
        ویرایش برچسب
    @else
        افزودن برچسب
    @endisset
@endsection

@section('content')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>
                @isset($tag)
                    ویرایش برچسب
                @else
                    افزودن برچسب
                @endisset
            </span>
            <a href="{{route('tags.index')}}" class="btn btn-outline-primary btn-sm float-end fa-8">برگشت</a>
        </div>
        <div class="card-body px-0">
            <form action="{{ isset($tag) ? route('tags.update',$tag->id) : route('tags.store') }}"
                  method="post">

                @csrf

                @isset($tag)
                    @method('PUT')
                @endisset

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">عنوان برچسب</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                               name="name" placeholder="عنوان برچسب را وارد کنید"
                               value="{{isset($tag) ? $tag->name : old('name')}}">
                        @include('admin.components.input_error',['inputName' => 'name'])
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    @isset($tag)
                        <button type="submit"
                                class="btn btn-sm small btn-warning btn-block col-6 col-sm-4 col-md-3 col-lg-2">ویرایش
                        </button>
                    @else
                        <button type="submit"
                                class="btn btn-sm small btn-primary btn-block col-6 col-sm-4 col-md-3 col-lg-2">افزودن
                        </button>
                    @endisset
                </div>
            </form>
        </div>
    </div>
@endsection
