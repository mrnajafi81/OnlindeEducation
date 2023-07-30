<header>
    <div class="row no-gutters">
        <div class="col-auto logo-collapse">
            <a href="{{route('admin.index')}}" class="logo d-none d-sm-inline-block">
                پنل مدیریت
            </a>
            <a href="#" class="sidebar-collapse">
                <span class="fa fa-bars"></span>
            </a>
        </div>

        <div class="col d-flex justify-content-end align-items-center pe-3">
            <div class="dropdown m-0">
                <a class="btn btn-success btn-sm dropdown-toggle me-3" href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <small>
                        {{auth()->user()->fullname}}
                    </small>
                </a>

                <ul class="dropdown-menu p-1">
                    <li>
                        <a class="dropdown-item text-primary small d-flex justify-content-center align-items-center gap-2" href="{{route('front.index')}}">
                            <i class="fa fa-sm fa-home"></i>
                            <span>دیدن سایت</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item text-danger small d-flex justify-content-center align-items-center gap-2" href="{{route('auth.logout')}}">
                            <i class="fa fa-sm fa-user-times"></i>
                            <span>خروج</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
