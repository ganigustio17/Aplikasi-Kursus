<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $lesson->name }} | @include('component.nameapp')</title>
    @include('component.style')
</head>
<body data-bs-theme="dark">

@include('component.navbar')

<main class="py-5">
    <section>
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h4 class="mb-0">{{ $lesson->name }}</h4>
            </div>
            <div class="progress mb-5" role="progressbar" aria-label="Example with label" aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: {{ $progressPercentage }}%"></div>
            </div>

            <div class="mb-4">
                <p class="mb-4">{{ $lessonContent->content }}</p>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @if ($nextRoute)
                    <a href="{{ $nextRoute }}" class="btn btn-primary w-100 mt-2">Continue</a>
                @else
                    <a href="{{ route('detailcourseregistered', ['id' => $course]) }}"class="btn btn-primary w-100 mt-2">Continue</a>
                @endif                
                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>