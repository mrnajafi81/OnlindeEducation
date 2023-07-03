@extends('admin.layouts.dashboard')

@section('title')
    @if(request()->is('admin/products'))
        لیست محصولات
    @else
        لیست محصولات داخل سطل زباله
    @endif
@endsection

@section('content')
    <div class="card text-dark my-4 shadow border">
        <div class="card-header">
            @if(request()->is('admin/products'))
                <span>لیست محصولات</span>
                <div class="btn-group btn-group-sm float-end" role="group">
                    <a href="{{route('products.trashed')}}" class="btn btn-danger btn-sm"><small>سطل زباله</small></a>
                    <a href="{{route('products.create')}}" class="btn btn-primary btn-sm"><small>افزودن</small></a>
                </div>
            @else
                <span>لیست محصولات داخل سطل زباله</span>
                <a class="btn btn-sm btn-primary float-end" href="{{route('products.index')}}">
                    <small>
                        لیست محصولات
                    </small>
                </a>
            @endif
        </div>
        <div class="card-body">

            <div class="card w-100 p-2 my-3 mt-0">
                <div class="mt-0 d-inline-block">
                </div>
                <div id="ordering">
                    <h6 style="font-weight: bold !important;" class="card-title d-inline-block">مرتب‌سازی بر اساس :</h6>
                    <ul class="nav d-inline-flex">
                        <li class="nav-item">
                            <a class="nav-link @if(request()->query('ordering')=='newest') active @endif"
                               href="{{\request()->fullUrlWithQuery(['page'=>1,'ordering'=>'newest'])}}">
                                جدیدترین
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->query('ordering')=='most_visited') active @endif"
                               href="{{\request()->fullUrlWithQuery(['page'=>1,'ordering'=>'most_visited'])}}">
                                پربازدیدترین
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->query('ordering')=='best_selling') active @endif"
                               href="{{\request()->fullUrlWithQuery(['page'=>1,'ordering'=>'best_selling'])}}">
                                پرفروش ترین
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->query('ordering')=='most_expensive') active @endif"
                               href="{{\request()->fullUrlWithQuery(['page'=>1,'ordering'=>'most_expensive'])}}">
                                گرانترین
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->query('ordering')=='cheapest') active @endif"
                               href="{{\request()->fullUrlWithQuery(['page'=>1,'ordering'=>'cheapest'])}}">
                                ارزانترین
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            @if(session()->has('success'))
                <div class="alert alert-success">{{session()->get('success')}}</div>
            @endif

            @if($products->count())

            <div id="table_overflow">
                    <table class="table table-borderless">
                        <thead class="thead-light">
                        <tr>
                            <th nowrap>ردیف</th>
                            <th nowrap>تصویر</th>
                            <th nowrap>نام فارسی</th>
                            <th nowrap>قیمت</th>
                            <th nowrap>دسته بندی</th>
                            <th nowrap>برچسب ها</th>
                            <th nowrap>تصاویر</th>
                            <th nowrap>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>#{{$product->id}}</td>
                                <td nowrap>
                                    <div class="d-inline-block"
                                         style="width: 100px !important;height: 60px !important;overflow: hidden !important;">
                                        <img src="{{asset($product->mainImage->path)}}" height="100%">
                                    </div>
                                </td>
                                <td style="min-width: 300px !important;">{{$product->name_fa}}</td>
                                <td>{{number_format($product->price)}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>
                                    @foreach($product->tags as $tag)
                                        <span class="badge bg-info rounded-pill text-white">{{$tag->name}}</span>
                                    @endforeach
                                </td>
                                <td nowrap>
                                    @foreach($product->subImages as $img)
                                        <div class="d-inline-block"
                                             style="width: 100px !important;height: 60px !important;overflow: hidden !important;">
                                            <img src="{{asset($img->path)}}" height="100%">
                                        </div>
                                    @endforeach
                                </td>
                                <td nowrap>
                                    <a href="{{route('fronts.product',$product->slug)}}"
                                       class="btn btn-sm btn-success"><small>نمایش</small></a>
                                    @if($product->trashed())
                                        <a href="{{route('products.restore',$product->id)}}"
                                           class="btn btn-sm btn-success">
                                            <small>بازیابی</small>
                                        </a>
                                    @else
                                        <a href="{{route('products.edit',$product->id)}}"
                                           class="btn btn-sm btn-warning">
                                            <small><i class="fa fa-edit"></i></small>
                                        </a>
                                    @endif
                                    <form class="d-inline-block" action="{{route('products.destroy',$product->id)}}"
                                          method="post">
                                        <div class="form-group">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit">
                                                <small><i class="fa fa-trash-alt small"></i></small>
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
                <div class="alert alert-primary">
                    @if(request()->is('admin/products'))
                        <span>هیچ محصولی وجود ندارد</span>
                        <a class="btn btn-sm btn-success float-end" href="{{route('products.create')}}">
                            <small>
                                افزودن محصول
                            </small>
                        </a>
                    @else
                        <span>هیچ محصولی در سطل زباله وجود ندارد.</span>
                    @endif
                </div>
            @endif
        </div>
    </div>
    <div id="paginate" class="mt-3 ms-1 d-inline-block h-auto">
        {{$products->links()}}
    </div>
@endsection

