<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $course->name }} | @include('component.nameapp')</title>
    @include('component.style')
</head>
<body data-bs-theme="dark">

@include('component.navbar')

<main class="py-5">
    <section>
        <div class="container">
            <h3 class="mb-3">{{ $course->name }}</h3>
            <div class="progress mb-5" role="progressbar" aria-label="Example with label" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: 100%">100%</div>
            </div>

            @foreach ($sets as $set)
            <div class="mb-4">
                <h4 class="mb-3">{{ $set->name }}</h4>
                <div class="row">
                    @foreach ($set->lessons as $lesson)
                    <div class="col-md-12">
                        <a href="#" class="card mb-3 text-decoration-none bg-body-tertiary">
                            <div class="card-body d-flex justify-content-between">
                                <div>
                                    <small class="text-muted">Lesson</small>
                                    <h5 class="mt-2">{{ $lesson->name }}</h5>
                                </div>
                                <div>
                                    <div class="badge border border-primary text-primary">Completed</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach

            <div>
                <h4 class="mb-3">Certificate</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3 text-decoration-none bg-body-tertiary">
                            <div class="card-body text-center d-flex flex-column gap-5 p-4">
                                <h5>Course Certificate</h5>

                                <div class="text-center d-flex flex-column gap-2">
                                    <p class="mb-0 text-muted"><small>This is to certify that</small></p>
                                    <h1 class="mb-0 fw-bold">{{ Auth::user()->full_name }}</h1>
                                    <p class="mb-0 text-muted">
                                        <small>has successfully completed the course by demonstrating <br/> theoretical and practical understanding to</small>
                                    </p>
                                    <h3 class="fw-normal">{{ $course->name }}</h3>
                                </div>

                                <h6 class="mb-0">@include('component.app')</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>
</body>
</html>