<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.rtl.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/Vazirmatn-font-face.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/admin_style.css')}}">

    <script defer src="{{asset('assets/js/alpinejs.js')}}"></script>

    <!--for private page js and css-->
    @yield('head')

    <title>@yield('title')</title>
</head>
<body>

<div id="main">

    @yield('body-contents')

</div>
<!-- Optional JavaScript -->
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/admin_main.js')}}"></script>

<!--for private page codes-->
@yield('end-body')

</body>
</html>