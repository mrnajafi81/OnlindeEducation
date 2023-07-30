@extends('admin.layouts.dashboard')

@section('title', 'داشبورد مدیریت سامانه امامت')

@section('content')
    <div class="container-fluid d-flex flex-column justify-content-end align-items-start"
         id="content-header-image">
        <h2 class="mb-0">میزکار</h2>
        <p>به پنل مدیریت سامانه امامت خوش آمدید</p>
    </div>
    <div class="container">

        <div class="row boxes-info ">
            <div class="col my-5 mx-3 d-flex flex-row justify-content-around align-items-center">
                <div class="box-info d-block">
                    <span class="number-box-info">{{$usersCount}}</span>
                    <span class="name-box-info d-block">تعداد کاربران</span>
                </div>
                <span class="fa fa-user d-block icon-box-info" style="color: #26dad2;"></span>

            </div>

            <div class="col my-5 mx-3 d-flex flex-row justify-content-around align-items-center">
                <div class="box-info d-block">
                    <span class="number-box-info">{{$coursesCount}}</span>
                    <span class="name-box-info d-block">تعداد دوره ها</span>
                </div>
                <span class="fa fa-graduation-cap d-block icon-box-info" style="color: #26dad2;"></span>

            </div>

            <div class="col my-5 mx-3 d-flex flex-row justify-content-around align-items-center">
                <div class="box-info d-block">
                    <span class="number-box-info">{{number_format($currentDaySales)}}</span>
                    <span class="name-box-info d-block">فروش امروز</span>
                </div>
                <span class="fa fa-dollar-sign d-block icon-box-info" style="color: #26dad2;"></span>

            </div>

            <div class="col my-5 mx-3 d-flex flex-row justify-content-around align-items-center">
                <div class="box-info d-block">
                    <span class="number-box-info">{{number_format($currentMonthSales)}}</span>
                    <span class="name-box-info d-block">فروش این ماه</span>
                </div>
                <span class="fa fa-money-bill-alt d-block icon-box-info" style="color: #26dad2;transform: rotateX(30deg);"></span>

            </div>

        </div>

    </div>
@endsection
