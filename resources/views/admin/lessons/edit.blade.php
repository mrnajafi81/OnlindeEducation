@extends('admin.layouts.dashboard')

@section('title','ویرایش درس')

@section('head')
    <script>
        function testData() {
            return {
                hasTest: '{{$lesson->has_test}}',
                deleteVideo: null,
                deleteSound: null,
                deleteFile: null,
            }
        }
    </script>
@endsection

@section('content')
    <div class="card m-5 border bg-transparent border-0">
        <div class="card-header border-bottom border-info border-3 bg-transparent px-0 fw-medium">
            <span>
                ویرایش درس
            </span>
            <a href="{{route('lessons.index',$lesson->course_id)}}"
               class="btn btn-outline-primary btn-sm float-end fa-8">برگشت</a>
        </div>
        <div class="card-body px-0">

            @include('admin.components.allAlerts')

            <form x-data="testData()" action="{{route('lessons.update',$lesson->id)}}" method="post"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">عنوان درس</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('title') is-invalid @enderror" type="text"
                               name="title" value="{{$lesson->title}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">ترتیب درس</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control plc-rtl @error('order') is-invalid @enderror" type="number"
                               name="order" value="{{$lesson->order}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">ویدئوی درس</label>
                    <div class="col-sm-9 col-lg-10 d-flex gap-3 align-items-center">
                        @if($lesson->video)
                            <a href="{{url($lesson->video)}}" class="btn btn-sm btn-primary" target="_blank">
                                <small><i class="fa fa-sm fa-link"></i></small>
                            </a>
                            <div class="text-nowrap">
                                <input name="delete_video" class="form-check-input danger-checked" type="checkbox" value="1" x-model="deleteVideo">
                                <label class="form-check-label small">
                                    حذف کردن
                                </label>
                            </div>
                        @endif
                        <input class="form-control @error('video') is-invalid @enderror" type="file"
                               name="video" :disabled="deleteVideo">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">صوت درس</label>
                    <div class="col-sm-9 col-lg-10 d-flex gap-3 align-items-center">
                        @if($lesson->sound)
                            <a href="{{url($lesson->sound)}}" class="btn btn-sm btn-primary" target="_blank">
                                <small><i class="fa fa-sm fa-link"></i></small>
                            </a>
                            <div class="text-nowrap">
                                <input name="delete_sound" class="form-check-input danger-checked" type="checkbox" value="1" x-model="deleteSound">
                                <label class="form-check-label small">
                                    حذف کردن
                                </label>
                            </div>
                        @endif
                        <input class="form-control @error('sound') is-invalid @enderror" type="file"
                               name="sound" :disabled="deleteSound">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">فایل درس</label>
                    <div class="col-sm-9 col-lg-10 d-flex gap-3 align-items-center">
                        @if($lesson->file)
                            <a href="{{url($lesson->file)}}" class="btn btn-sm btn-primary" target="_blank">
                                <small><i class="fa fa-sm fa-link"></i></small>
                            </a>
                            <div class="text-nowrap">
                                <input name="delete_file" class="form-check-input danger-checked" type="checkbox" value="1" x-model="deleteFile">
                                <label class="form-check-label small">
                                    حذف کردن
                                </label>
                            </div>
                        @endif
                        <input class="form-control @error('file') is-invalid @enderror" type="file"
                               name="file" :disabled="deleteFile">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">آزمون دارد؟</label>
                    <div class="col-sm-9 col-lg-10 d-flex align-items-center gap-3">
                        <div>
                            <input class="form-check-input" type="radio" name="has_test" value="1" x-model="hasTest"
                                   checked>
                            <label class="form-check-label">
                                بله
                            </label>
                        </div>
                        <div>
                            <input class="form-check-input" type="radio" name="has_test" value="0" x-model="hasTest">
                            <label class="form-check-label">
                                خیر
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3" :class="hasTest == 0 ? 'd-none' : ''">
                    <label class="col-form-label col-sm-3 col-lg-2 text-nowrap">نمره قبولی آزمون</label>
                    <div class="col-sm-9 col-lg-10">
                        <input class="form-control @error('passing_mark') is-invalid @enderror" type="number"
                               name="passing_mark" min="0" max="100"
                               value="{{old('passing_mark') ? old('passing_mark') : 80}}">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm small btn-warning btn-block col-6 col-sm-4 col-md-3 col-lg-2">
                        ویرایش درس
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
