<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $course->name }} | @include('component.nameapp')</title>
    @include('component.style')
</head>
<body data-bs-theme="dark">

@include('component.navbar')

<main class="py-5">
    <section>
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h3 class="mb-0">{{ $course->name }}</h3>
                @if (!$isRegistered)
                    <form action="{{ route('detailcourse', $course->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Register to this course</button>
                    </form>
                @endif
            </div>

            <p class="mb-5">
                {{ $course->description }}
            </p>

            <div class="mb-4">
                <h4 class="mb-3">Outline</h4>
                <div class="row">
                    @forelse ($sets as $set)
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="mb-0">{{ $loop->iteration }}. {{ $set->name }}</h5>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No sets available for this course.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>