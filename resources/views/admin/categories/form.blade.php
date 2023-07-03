@extends('admin.layouts.dashboard')

@section('title')
    @isset($category)
        ویرایش دسته بندی
    @else
        افزودن دسته بندی
    @endisset
@endsection

@section('content')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>
                @isset($category)
                    ویرایش دسته بندی
                @else
                    افزودن دسته بندی
                @endisset
            </span>
            <a href="{{route('categories.index')}}" class="btn btn-outline-primary btn-sm float-end fa-8">برگشت</a>
        </div>
        <div class="card-body px-0">
            <form action="{{ isset($category) ? route('categories.update',$category->id) : route('categories.store') }}"
                  method="post">

                @csrf

                @isset($category)
                    @method('PUT')
                @endisset

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">عنوان دسته بندی</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                               name="name" placeholder="عنوان دسته بندی را وارد کنید"
                               value="{{isset($category) ? $category->name : old('name')}}">
                        @include('admin.components.input_error',['inputName' => 'name'])
                    </div>
                </div>

                <div class="row mb-3">
                    <lable class="form-label col-sm-3 col-lg-2 text-nowrap" for="parent_id">دسته بندی مادر</lable>
                    <div class="col-sm-9 col-lg-10">
                        <select name="parent_id" id="parent_id" class="form-select">
                            <option value="0">دسته مادر</option>
                            @if($parents)
                                @foreach($parents as $parent)
                                    <option value="{{$parent->id}}"
                                            @isset($category) @if($category->parent_id == $parent->id) selected @endif @endisset>{{$parent->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @include('admin.components.input_error',['inputName' => 'parent_id'])
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    @isset($category)
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
