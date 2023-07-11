<nav id="sidebar" style="height:100vh !important" class="overflow-y-auto">
    <div class="navbar">
        <div class="navbar-nav flex-column sidebar-navigation-box align-items-start">

            @foreach($lesson->course->lessons as $lesson)
                <a href="#" class="nav-item nav-link d-block active dropdown-toggle " data-bs-toggle="collapse"
                   data-bs-target="#lesson{{$lesson->id}}" role="button" aria-expanded="false">
                    <i class="fa fa-folder ms-2 " style="margin-left: 5px"></i>
                    {{$lesson->title}}
                    <i class="fa fa-sm fa-angle-left ms-3 d-inline-block"></i>
                </a>
                <div class="collapse" id="lesson{{$lesson->id}}">
                    <nav class="nav flex-column align-items-start ps-4">
                        <a href="{{route('front.lessons',$lesson->id)}}" class="nav-link">محتوای درس</a>
                        <a href="{{route('courses.create')}}" class="nav-link">آزمون درس</a>
                    </nav>
                </div>
            @endforeach

        </div>
    </div>
</nav>
