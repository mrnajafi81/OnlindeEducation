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
    <script defer src="{{asset('assets/js/alpinejs.js')}}"></script>

    <link rel="stylesheet" href="{{asset('assets/css/admin_style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/front_style.css')}}">


    <!--for private page js and css-->
    @yield('head')

    <title>@yield('title')</title>
</head>
<body>

<div id="main">

    @include('front.lessons.layouts.header')

    @yield('contents')

    @include('front.layouts.footer')

</div>
<!-- Optional JavaScript -->
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script>
    let sidebar = document.getElementById('sidebar');
    let lessonSidebarCollapse = document.querySelector('.lesson-sidebar-collapse');

    lessonSidebarCollapse.onclick = function () {
        sidebar.classList.toggle('collapse-status');
    }

</script>
<!--for private page codes-->
@yield('end-body')

</body>
</html>
