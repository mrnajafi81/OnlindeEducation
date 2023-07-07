@extends('layouts.app')

@section('body-contents')

    <!--admin panel header-->
    @include('admin.layouts.header')

    <div class="wrapper">

        @include('admin.layouts.sidebar')

        <section id="content">
            @yield('content')
        </section>

    </div>

@endsection
