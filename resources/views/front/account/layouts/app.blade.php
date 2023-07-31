@extends('front.layouts.app')

@section('title','سامانه آموزش مجازی امامت_پنل کاربری')

@section('head')
    <style>
        #table_overflow {
            width: 100%;
            overflow-x: auto;
        }

        table td, table th {
            vertical-align: middle !important;
        }
    </style>
@endsection

@section('contents')
    <section class="container mb-5">

        <!--page title-->
        <div id="course-title"
             class="shadow-sm d-flex align-items-center bg-white border border-success-subtle rounded-1 my-5 mb-3">
            <h1 class="fw-medium fs-3 border-start border-5 ps-2 ms-3 py-1 border-color-main">حساب کاربری</h1>
        </div>
        <p class="pb-4">
            <span class="fw-medium">{{$user->fullname}}</span>
            <span>به حساب کاربری خوش آمدید.</span>
        </p>
        <!--end page title-->

        <!--contents-->
        <div class="row">
            <div class="col-12 col-md-3 col-xl-2">
                <div class="nav flex-column nav-pills border py-1 rounded-3 shadow-sm h-100">
                    <a href="{{route('account.profile')}}"
                       class="nav-link fw-medium my-1 rounded-0 border-bottom {{request()->routeIs('account.profile') ? 'text-dark' : 'text-secondary'}}">
                        <i class="fa fa-user me-1"></i>
                        <span>پروفایل</span>
                    </a>
                    <a href="{{route('account.pays')}}"
                       class="nav-link fw-medium my-1 rounded-0 border-bottom {{request()->routeIs('account.pays') ? 'text-dark' : 'text-secondary'}}">
                        <i class="fa fa-credit-card me-1"></i>
                        <span>تراکنش ها</span>
                    </a>
                    <a href="{{route('account.courses')}}"
                       class="nav-link fw-medium my-1 rounded-0 border-bottom {{request()->routeIs('account.courses') ? 'text-dark' : 'text-secondary'}}">
                        <i class="fa fa-graduation-cap me-1"></i>
                        <span>دروه های شما</span>
                    </a>
                    <a href="{{route('account.tests')}}"
                       class="nav-link fw-medium my-1 rounded-0 {{request()->routeIs('account.tests') ? 'text-dark' : 'text-secondary'}}">
                        <i class="fa fa-check-square me-1"></i>
                        <span>نتیجه آزمون ها</span>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-9 col-xl-10">
                <div class="page-contents h-100 p-3 rounded-3 mt-3 mt-md-0 shadow-sm"
                     style="background-color: #fafafa!important;">
                    @yield('page-contents')
                </div>
            </div>

        </div>
        <!--end contents-->

    </section>

@endsection
