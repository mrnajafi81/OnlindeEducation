<nav id="sidebar" class="overflow-y-auto">
    <div class="navbar w-100">
        <div class="navbar-nav flex-column sidebar-navigation-box w-100">

            @foreach($lesson->course->lessons()->orderBy('order')->get() as $lesson)
                <a href="#" class="border border-2 rounded p-2 my-1 mx-3 nav-item nav-link d-block active dropdown-toggle d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                   data-bs-target="#lesson{{$lesson->id}}" role="button" aria-expanded="false">
                    <p class="text-wrap p-0 m-0">{{$lesson->title}}</p>
                    <i class="fa fa-sm fa-angle-left ms-3 d-inline-block"></i>
                </a>
                <div class="collapse" id="lesson{{$lesson->id}}">
                    <nav class="nav flex-column align-items-start ps-4">
                        <a href="{{route('front.lessons',$lesson->id)}}" class="nav-link">محتوای درس</a>
                        <a href="{{route('tests.index',$lesson->id)}}" class="nav-link">آزمون درس</a>
                    </nav>
                </div>
            @endforeach

        </div>
    </div>
</nav>
