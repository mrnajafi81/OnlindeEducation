<nav id="sidebar" style="min-height: calc(100vh - 60px) !important;">
    <div class="navbar">
        <div class="navbar-nav flex-column sidebar-navigation-box align-items-start">
            <a href="{{route('admin.index')}}" class="nav-item nav-link active d-block">
                <span class="fa fa-tachometer-alt" style="margin-left: 5px"></span>
                میزکار
            </a>
            <a href="#" class="nav-item nav-link d-block dropdown-toggle" data-bs-toggle="collapse"
               data-bs-target="#products" role="button" aria-expanded="false">
                <span class="fa fa-graduation-cap" style="margin-left: 5px"></span>
                دوره ها
            </a>
            <div class="collapse" id="products">
                <nav class="nav flex-column align-items-start ps-4">
                    <a href="{{route('courses.index')}}" class="nav-link">لیست دوره ها</a>
                    <a href="{{route('courses.create')}}" class="nav-link">افزودن دوره</a>
                    <a href="{{route('teachers.index')}}" class="nav-link">لیست اساتید</a>
                    <a href="{{route('teachers.create')}}" class="nav-link">افزودن استاد</a>
                </nav>
            </div>
            <a href="{{route('groups.index')}}" class="nav-item nav-link d-block">
                <span class="fa fa-database" style="margin-left: 5px"></span>
                گروه ها
            </a>
            <a href="{{route('pays.index')}}" class="nav-item nav-link d-block">
                <span class="fa fa-credit-card" style="margin-left: 5px"></span>
                پرداخت ها
            </a>
            <a href="{{route('admin.tests.index')}}" class="nav-item nav-link d-block">
                <span class="fa fa-check-square" style="margin-left: 5px"></span>
                آزمون ها
            </a>
            <a href="#" class="nav-item nav-link d-block dropdown-toggle" data-bs-toggle="collapse"
               data-bs-target="#userCollapse" role="button" aria-expanded="false">
                <span class="fa fa-users" style="margin-left: 5px"></span>
                کاربران
            </a>
            <div class="collapse" id="userCollapse">
                <nav class="nav flex-column align-items-start ps-4">
                    <a href="#" class="nav-link">مشاهده</a>
                    <a href="#" class="nav-link">ویرایش</a>
                    <a href="#" class="nav-link">حذف</a>
                </nav>
            </div>
        </div>
    </div>
</nav>
