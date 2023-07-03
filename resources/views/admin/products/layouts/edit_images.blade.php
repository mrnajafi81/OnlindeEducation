<div class="table-responsive ">
    @if(session()->has('success'))
        <div class="alert alert-success">{{session()->get('success')}}</div>
    @endif
        <form action="{{route('images.store',$product->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4 border p-2 rounded border-primary">
{{--                <label class="form-label"></label>--}}
                <input type="file" class="form-control-sm d-inline-block" name="images[]" multiple>
                <button type="submit" class="btn btn-sm btn-primary">افزودن تصویر</button>
            </div>
        </form>
    <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
            <th nowrap>ردیف</th>
            <th nowrap>تصویر</th>
            <th nowrap>آدرس</th>
            <th nowrap>تصویر اصلی</th>
            <th nowrap>عملیات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($product->allImages as $image)
            <tr>
                <td>#{{$image->id}}</td>
                <td nowrap>
                    <div class="d-inline-block"
                         style="width: 100px !important;height: 60px !important;overflow: hidden !important;">
                        <img src="{{asset($image->path)}}" width="100">
                    </div>
                </td>
                <td style="min-width: 300px !important;">{{$image->path}}</td>
                <td class="text-center">
                    @if($image->main)
                        <span class="badge bg-success rounded-pill text-white">
                            <i class="fa fa-check mt-1"></i>
                        </span>
                    @else
                        <span class="badge bg-danger rounded-pill text-white">
                            <i class="fa fa-times mt-1"></i>
                        </span>
                    @endif
                </td>
                <td>
                    @if($image->main)
                        <small class="text-warning">
                            برای حذف این تصویر، اول یک تصویر اصلی دیگر انتخاب کنید.
                        </small>
                    @else

                    <a href="{{route('images.changemainimage',[$image->id,$product->id])}}" class="btn btn-sm btn-warning">
                        <small>تغییر به تصویر اصلی</small>
                    </a>

                    <form class="d-inline-block" action="{{route('images.destroy',[$image->id,$product->id])}}"
                          method="post">
                        <div class="form-group">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">
                                <small><i class="fa fa-trash-alt small"></i></small>
                            </button>
                        </div>
                    </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
