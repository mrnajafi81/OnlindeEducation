@extends('front.layouts.app')

@section('title','بازیابی رمز عبور')

@section('contents')
    <section class="container-fluid py-2 py-sm-3 py-md-4 py-lg-5 px-2 px-md-3 px-lg-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4 mx-auto mt-3">

            <div class="card border-color-main px-md-4 px-lg-5">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-center mb-4 mt-3">
                        <h1 class="h4 fw-bold text-muted">بازیابی رمز عبور</h1>
                    </div>

                    @include('components.errorsAlert')


                    <form action="{{route('auth.forget-password')}}" method="POST">

                        @csrf

                        <div class="mb-4">
                            <label class="form-label">شماره تلفن همراه :</label>
                            <input class="form-control border-color-main @error('number') is-invalid @enderror"
                                   type="number" name="number" placeholder="مثال : 09170001122"
                                   id="number"
                                   value="{{old('number')}}">
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn text-white border-color-main bg-color-main d-block w-100">
                                دریافت کد
                            </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
