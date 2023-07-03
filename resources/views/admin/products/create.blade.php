@extends('admin.layouts.dashboard')

@section('title', 'افزودن محصول')

@section('head')
    <script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        function attributeData() {
            return {
                items: [new Date()],
                addAttribute() {
                    this.items.push({id: new Date().getTime() + this.items.length});

                },
                deleteAttribute(field) {
                    this.items.splice(this.items.indexOf(field), 1);
                }
            }
        }
    </script>
@endsection

@section('content')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            افزودن محصول
        </div>
        <div class="card-body">

            @include('admin.components.errorsAlert')

            <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">

                @csrf

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-md-4 col-lg-2 text-nowrap">نام فارسی محصول :</label>
                    <div class="col-sm-9 col-md-8 col-lg-10">
                        <input class="form-control @error('name_fa') is-invalid @enderror" type="text"
                               name="name_fa" value="{{old('name_fa')}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-md-4 col-lg-2 text-nowrap">قیمت محصول : </label>
                    <div class="col-sm-9 col-md-8 col-lg-10">
                        <input class="form-control @error('price') is-invalid @enderror" type="number"
                               name="price" value="{{old('price')}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-md-4 col-lg-2 text-nowrap">تعداد موجودی در انبار :</label>
                    <div class="col-sm-9 col-md-8 col-lg-10">
                        <input class="form-control @error('inventory') is-invalid @enderror" type="number"
                               name="inventory" value="{{old('inventory')}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-md-4 col-lg-2 text-nowrap">گارانتی محصول :</label>
                    <div class="col-sm-9 col-md-8 col-lg-10">
                        <input class="form-control @error('warranty') is-invalid @enderror" type="text"
                               name="warranty" value="{{old('warranty')}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-md-4 col-lg-2 text-nowrap">دسته بندی محصول :</label>
                    <div class="col-sm-9 col-md-8 col-lg-10">
                        <select name="category" id="category" class="form-select mt-2">
                            @foreach($categories as $category)
                                <option class="text-black"
                                        value="{{$category->id}}" {{$category->children->count() ? 'disabled' : '' }}>
                                    {{$category->name}}
                                </option>
                                @foreach($category->children as $category_child)
                                    <option class="small" value="{{$category_child->id}}">
                                        --- {{$category_child->name}}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-md-4 col-lg-2 text-nowrap">برچسب های محصول : </label>
                    <div class="col-sm-9 col-md-8 col-lg-10">
                        <select name="tags[]" id="tags" size="4" class="form-select mt-2" multiple>
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="product-attribute" x-data="attributeData()">
                    <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
                        <lable class="form-label">ویژگی های محصول :</lable>
                        <button type="button" class="btn btn-sm small btn-primary" @click="addAttribute">افزودن ویژگی
                        </button>
                    </div>

                    <template x-for="item in items" :key="item.id">
                        <div class="d-flex justify-content-start flex-nowrap gap-3 mb-3">
                            <div class="d-flex flex-wrap justify-content-start gap-3">
                                <div class="d-flex justify-content-start gap-3">
                                    <label class="col-form-label text-nowrap small d-inline-block">عنوان</label>
                                    <input type="text" name="attributes[]"
                                           class="form-control form-control-sm d-inline-block">
                                </div>
                                <div class="d-flex justify-content-start gap-3">
                                    <label class="col-form-label text-nowrap small d-inline-block">مقدار</label>
                                    <input type="text" name="attributes[]"
                                           class="form-control form-control-sm d-inline-block">
                                </div>
                            </div>
                            <button @click="deleteAttribute(item)" type="button" class="btn btn-sm btn-danger small">
                                <i class="fa fa-trash-alt fa-sm"></i>
                            </button>
                        </div>
                    </template>
                </div>

                <div id="editor-patent" class="mb-3">
                    <label class="d-block form-label">توضیحات محصول : </label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              rows="50" name="description" id="editor"
                              placeholder="توضیحات محصول را وارد کنید ...">{{old('description')}}</textarea>
                </div>
                <script>
                    CKEDITOR.replace('editor', {
                        language: 'fa',
                    });
                </script>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-md-4 col-lg-2 text-nowrap">تصویر اصلی محصول : </label>
                    <div class="col-sm-9 col-md-8 col-lg-10">
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                    </div>
                </div>


                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-md-4 col-lg-2 text-nowrap">تصویرهای محصول : </label>
                    <div class="col-sm-9 col-md-8 col-lg-10">
                        <input type="file" multiple class="form-control @error('images') is-invalid @enderror"
                               name="images[]">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit"
                            class="btn btn-sm btn-primary btn-block col-6 col-sm-4 col-md-3 col-lg-2">
                        افزودن محصول
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
