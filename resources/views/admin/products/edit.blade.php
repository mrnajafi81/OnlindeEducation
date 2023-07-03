@extends('admin.layouts.dashboard')

@section('title', 'ویرایش محصول')

@section('head')
    <script src="//cdn.ckeditor.com/4.19.1/full/ckeditor.js"></script>
@endsection

@section('content')
    <div id="main-content" class="col-12 p-4 mx-auto">
        <div class="card text-dark my-4 shadow border">
            <div class="card-header">
                ویرایش محصول
                {{$product->name_fa}}
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{(!isset(request()->tab)) ? 'active' : '' }}" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                                aria-selected="true">
                            ویرایش مشخصات اصلی محصول
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{(request()->tab == 'images') ? 'active' : ''}}" id="images-tab" data-bs-toggle="tab"
                                data-bs-target="#images-tab-pane" type="button" role="tab"
                                aria-controls="profile-tab-pane" aria-selected="false">
                            ویرایش تصاویر محصول
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade {{(!isset(request()->tab)) ? 'show active' : '' }} py-4 px-1" id="home-tab-pane" role="tabpanel"
                         aria-labelledby="home-tab" tabindex="0">
                        @include('admin.products.layouts.edit_main')
                    </div>
                    <div class="tab-pane fade {{(request()->tab == 'images') ? 'show active' : ''}} py-4 px-1" id="images-tab-pane" role="tabpanel"
                         aria-labelledby="images-tab" tabindex="0">
                        @include('admin.products.layouts.edit_images')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
