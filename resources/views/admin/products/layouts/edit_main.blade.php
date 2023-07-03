<form action="{{route('products.update',$product->id)}}" method="POST"
      enctype="multipart/form-data">

    @csrf

    @method('PUT')

    <div class="form-group">
        <label class="form-label">نام فارسی محصول :</label>
        <input class="form-control @error('name_fa') is-invalid @enderror" type="text"
               name="name_fa" value="{{$product->name_fa}}">
    </div>
    <br>
    <div class="form-group">
        <label class="form-label">نام انگلیسی محصول :</label>
        <input class="form-control @error('name_en') is-invalid @enderror" type="text"
               name="name_en" value="{{$product->name_en}}">
    </div>
    <br>
    <div class="form-group">
        <label class="form-label">قیمت محصول :</label>
        <input class="form-control @error('price') is-invalid @enderror" type="number"
               name="price" value="{{$product->price}}">
    </div>
    <br>
    <div class="form-group">
        <label class="form-label">تعداد موجودی محصول در انبار :</label>
        <input class="form-control @error('inventory') is-invalid @enderror" type="number"
               name="inventory" value="{{$product->inventory}}">
    </div>
    <br>
    <div class="form-group">
        <label class="form-label">گارانتی محصول :</label>
        <input class="form-control @error('warranty') is-invalid @enderror" type="text"
               name="warranty" value="{{$product->warranty}}">
    </div>
    <br>
    <div class="form-group">
        <lable class="form-label ms-1" for="category">دسته بندی محصول :</lable>
        <select name="category" id="category" class="form-select mt-2">
            @foreach($categories as $category)
                <option class="text-black"
                        @if($product->category_id == $category->id) selected @endif
                        value="{{$category->id}}" {{$category->children->count() ? 'disabled' : '' }}>
                    {{$category->name}}
                </option>
                @foreach($category->children as $category_child)
                    <option class="small"
                            @if($product->category_id == $category_child->id) selected @endif
                            value="{{$category_child->id}}">
                        --- {{$category_child->name}}
                    </option>
                @endforeach
            @endforeach
        </select>
    </div>
    <br>
    <div class="form-group">
        <lable class="form-label ms-1" for="tags">برچسب های محصول :</lable>
        <select name="tags[]" id="tags" size="4" class="form-select mt-2" multiple>
            @foreach($tags as $tag)
                <option @if(in_array($tag->id,$product_tags)) selected @endif
                    value="{{$tag->id}}">
                    {{$tag->name}}
                </option>
            @endforeach
        </select>
    </div>
    <br>
    <div class="form-group">
        <lable class="form-label ms-1">ویژگی های محصول :</lable>
        <textarea name="properties" rows="5" class="form-control mt-2"
                  placeholder="ویژگی 1 : مقدار 1 &#13;&#10;ویژگی 2 : مقدار 2">{{$product->properties}}</textarea>
    </div>
    <br>
    <div class="form-group">
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              rows="50" name="description" id="editor" >{!! $product->description !!}</textarea>
    </div>
    <script>
        CKEDITOR.replace('editor', {
            language: 'fa',
        });
    </script>
    <br>
    <div class="form-group">
        <button type="submit" class="btn btn-warning btn-block w-100">ویرایش محصول</button>
    </div>
</form>
