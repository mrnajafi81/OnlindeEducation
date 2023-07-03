@extends('admin.layouts.dashboard')

@section('title','دسته بندی ها')

@section('head')
    <script>
        function categoryIndexData() {
            return {
                deleteCategory(e,hasChildred) {
                    $form = e.parentElement.parentElement.parentElement;
                    if (hasChildred) {
                        $res = confirm('اگر این دسته بندی را حذف کنید تمام دسته بندی های فرزند نیز حذف می شوند');
                        if ($res) {
                            $form.submit();
                        }
                    } else {
                        $form.submit();
                    }
                }
            }
        }
    </script>
@endsection

@section('content')
    <div x-data="categoryIndexData()" class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>لیست دسته بندی ها</span>
            <a href="{{route('categories.create')}}"
               class="btn btn-outline-primary btn-sm float-end"><small>افزودن</small></a>
        </div>
        <div class="card-body px-0">

            @include('admin.components.successAlert')

            @if($categories->count())
                <div id="table_overflow">
                    <table class="table table-borderless ">
                        <thead class="thead-light">
                        <tr>
                            <th nowrap>آیدی</th>
                            <th nowrap>نام</th>
                            <th nowrap>دسته مادر</th>
                            <th nowrap>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr class="text-primary">
                                <td nowrap>#{{$category->id}}</td>
                                <td nowrap>{{$category->name}}</td>
                                <td nowrap>
                                    دسته بندی مادر
                                </td>
                                <td nowrap>
                                    <a href="{{route('categories.edit',$category->id)}}"
                                       class="btn btn-sm btn-warning"><small>ویرایش</small></a>
                                    <form @click.prevent="deleteCategory($event.target,{{$category->children->count()>0}})"
                                          class="d-inline-block" action="{{route('categories.destroy',$category->id)}}"
                                          method="post">
                                        <div class="form-group">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit">
                                                <small>حذف</small>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @foreach($category->children as $category_child)
                                <tr>
                                    <td class="small">##{{$category_child->id}}</td>
                                    <td class="small">--- {{$category_child->name}}</td>
                                    <td class="small">{{$category_child->parent->name}}</td>
                                    <td class="small">
                                        <a href="{{route('categories.edit',$category_child->id)}}"
                                           class="btn btn-sm btn-warning"><small>ویرایش</small></a>
                                        <form class="d-inline-block"
                                              action="{{route('categories.destroy',$category_child->id)}}"
                                              method="post">
                                            <div class="form-group">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit">
                                                    <small>حذف</small>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-primary fa-8">
                    <span>هیچ دسته بندی وجود ندارد، لطفا یک دسته بندی اضافه کنید.</span>
                </div>
            @endif
        </div>
    </div>
@endsection

