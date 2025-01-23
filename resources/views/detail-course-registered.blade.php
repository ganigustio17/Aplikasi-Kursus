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
            <div class="progress mb-5" role="progressbar" aria-label="Progress" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: {{ $progress }}%">{{ $progress }}%</div>
            </div>

            @php
                $jumpHereSet = null;
                $newCompletedLesson = null;
            @endphp

            @foreach ($sets as $set)
                <div class="mb-4">
                    <h4 class="mb-3">{{ $set->name }}</h4>
                    <div class="row">
                        <div class="col md-12">

                            @foreach ($set->lessons ?? [] as $lesson)
                                @php
                                    $lessonStatus = 'locked';
                                    if (in_array($lesson->id, $completedLessons)) {
                                        $lessonStatus = 'completed';
                                    } elseif ($currentLesson && $lesson->id === $currentLesson->id) {
                                        $lessonStatus = 'current';
                                        if (!$jumpHereSet) {
                                            $jumpHereSet = $set;
                                        }
                                    }
                                @endphp
    
                                @if ($lessonStatus === 'current')
                                    <a href="{{ route('detaillesson', [
                                        'course' => $course->id, 
                                        'id' => $currentLesson->id, 
                                        'order' => $currentOrder
                                    ]) }}" class="card mb-3 text-decoration-none bg-body-tertiary">
                                @else
                                    <div class="card mb-3 text-decoration-none bg-body-tertiary {{ $lessonStatus == 'locked' ? 'opacity-50' : '' }}">
                                @endif
                                    <div class="card-body d-flex justify-content-between">
                                        <div>
                                            <small class="text-muted">Lesson</small>
                                            <h5 class="mt-2">{{ $lesson->name }}</h5>
                                        </div>
                                        <div>
                                            @if ($lessonStatus == 'completed')
                                                <div class="badge border border-primary text-primary">Completed</div>
                                            @elseif ($lessonStatus == 'current')
                                                <div class="badge border">Current</div>
                                            @else
                                                <div class="badge">Locked</div>
                                            @endif
                                        </div>
                                    </div>
                                    @if ($lessonStatus === 'current')
                                        </a>
                                    @else
                                        </div>
                                    @endif
    
                                    @if ($lessonStatus == 'completed' && !$newCompletedLesson) 
                                        @php
                                            $newCompletedLesson = true;
                                        @endphp
                                    @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                @if ($jumpHereSet && $set->id === $jumpHereSet->id)
                    <div class="text-center mb-4">
                        <p class="mb-2"><b>Too easy?</b></p>
                        <a href="{{ route('jumphere', [
                            'setId' => $set->id,
                            'lessonId' => $currentLesson->id,
                            'order' => 1]) }}" 
                            class="btn btn-outline-primary">Jump Here</a>
                    </div>
                @endif

            @endforeach

            @if ($progress == 100)
                <script>
                    window.location.href = "{{ route('detailcoursefinished', $course->id) }}";
                </script>
            @endif

        </div>
    </section>
</main>


</body>
</html>

