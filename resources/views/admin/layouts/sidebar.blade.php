<nav id="sidebar">
    <div class="navbar">
        <div class="navbar-nav flex-column sidebar-navigation-box align-items-start">
            <a href="{{route('admin.index')}}" class="nav-item nav-link active d-block">
                <span class="fa fa-tachometer-alt" style="margin-left: 5px"></span>
                میزکار
            </a>
            <a href="#" class="nav-item nav-link d-block dropdown-toggle" data-bs-toggle="collapse"
               data-bs-target="#products" role="button" aria-expanded="false">
                <span class="fa fa-shopping-bag" style="margin-left: 5px"></span>
                محصولات
            </a>
            <div class="collapse" id="products">
                <nav class="nav flex-column align-items-start ps-4">
                    <a href="{{route('products.create')}}" class="nav-link">افزودن محصول</a>
                    <a href="{{route('categories.index')}}" class="nav-link">دسته بندی ها</a>
                    <a href="{{route('tags.index')}}" class="nav-link">برچسب ها</a>
                    <a href="{{route('products.trashed')}}" class="nav-link">محصولات حذف شده</a>
                </nav>
            </div>
            <a href="#" class="nav-item nav-link d-block">
                <span class="fa fa-chart-pie" style="margin-left: 5px"></span>
                گزارشات
            </a>
            <a href="#" class="nav-item nav-link d-block">
                <span class="fa fa-credit-card" style="margin-left: 5px"></span>
                کیف پول
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
            <a href="#" class="nav-item nav-link d-block">
                <span class="fa fa-shopping-cart" style="margin-left: 5px"></span>
                محصولات
            </a>
        </div>
    </div>
</nav>
