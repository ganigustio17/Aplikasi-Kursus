<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home | @include('component.nameapp')</title>
    @include('component.style')
</head>
<body data-bs-theme="dark">

@include('component.navbar')

<main class="py-5">
    @if ($myCourses->isEmpty())
        <section class="my-courses">
            <div class="container">
                <h4 class="mb-3">Select The Course You Are Interested In</h4>
                <div class="courses d-flex flex-column gap-3">
                    @foreach ($otherCourses as $course)
                        <a href="{{ route('detailcourse', $course->id) }}" class="card text-decoration-none bg-body-tertiary">
                            <div class="card-body">
                                <h5 class="mb-2">{{ $course->name }}</h5>
                                <p class="text-muted mb-0">{{ $course->description }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <section class="my-courses">
            <div class="container">
                <h4 class="mb-3">My Courses</h4>
                <div class="courses d-flex flex-column gap-3">
                    @foreach ($myCourses as $course)
                        <a href="{{ route('detailcourseregistered', $course->id) }}" class="card text-decoration-none bg-body-tertiary">
                            <div class="card-body">
                                <h5 class="mb-2">{{ $course->name }}</h5>
                                <p class="text-muted mb-0">{{ $course->description }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        @if ($otherCourses->isNotEmpty())
            <section class="other-courses mt-4">
                <div class="container">
                    <h4 class="mb-3">Other Courses</h4>
                    <div class="d-flex flex-column gap-3">
                        @foreach ($otherCourses as $course)
                            <a href="{{ route('detailcourse', $course->id) }}" class="card text-decoration-none bg-body-tertiary">
                                <div class="card-body">
                                    <h5 class="mb-2">{{ $course->name }}</h5>
                                    <p class="text-muted mb-0">{{ $course->description }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endif
</main>


</body>
</html>