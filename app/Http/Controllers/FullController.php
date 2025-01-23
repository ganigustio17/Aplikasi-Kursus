<?php

namespace App\Http\Controllers;

#Model
use App\Models\Set;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonContent;
use App\Models\Option;
use App\Models\CompletedLesson;
use App\Models\Enrollment;
use App\Models\Administrator;

#More
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class FullController extends Controller
{
    function register()
    {
     return view('register');
    }

    function doregister(Request $request)
    {
      $request->validate([
        'full_name' => 'required|min:5|max:25',
        'username' => 'required|min:3|max:15|unique:users,username',
        'password' => 'required|min:6|max:12',
        'password_confirm' => 'required|same:password'
      ],[
        'full_name.required' => 'Fullname is required',
        'full_name.min' => 'Fullname must be at least 5 characters',
        'full_name.max' => 'Fullname must not exceed 25 characters',
        'username.required' => 'Username is required',
        'username.min' => 'Username must be at least 3 characters',
        'username.max' => 'Username must not exceed 15 characters',
        'username.unique' => 'Username is already taken',
        'password.required' => 'Password is required',
        'password.min' => 'Password must be at least 6 characters',
        'password.max' => 'Password must not exceed 10 characters',
        'password_confirm.required' => 'Password Confirmation is required',
        'password_confirm.same' => 'Password Confirmation must be the same as password'
      ]);

      $user = new User;
      $user->full_name = $request->full_name;
      $user->username = $request->username;
      $user->password = bcrypt($request->password);
      $user->save();

      return back()->withSuccess('Registration is successfully');

    }

    function login()
    {
      return view('login');
    }

    function dologin(Request $request)
    {
      $request->validate([
        'username' => 'required|exists:users,username',
        'password' => 'required'
      ],[
        'username.required' => 'Username is required',
        'username.exists' => 'Username is not found',
        'password.required' => 'Password is required',
       
      ]);

      $data = [
        'username' => $request->username,
        'password' => $request->password
      ];

      if(Auth::attempt($data)){
        return redirect()->route('index');
      }else{
        return back()->withErrors(['password' => 'Password is incorrect']);
      }
    }

    function logout(){
      Auth::logout();

      return redirect()->route('login');
    }

    
    function index()
    {
        $myCourses = Course::whereIn('id', function ($query) 
        {
            $query->select('course_id')
                ->from('enrollments')
                ->where('user_id', auth()->id());
        })->orderBy('id', 'asc')->get();

        $otherCourses = Course::whereNotIn('id', function ($query) 
        {
            $query->select('course_id')
                ->from('enrollments')
                ->where('user_id', auth()->id());
        })->where('is_published', 1)
          ->orderBy('id', 'asc')->get();

        return view('index', compact('myCourses', 'otherCourses'));
    }

    public function detailcourse(string $id, Request $request)
    {
        $course = Course::findOrFail($id);

        $sets = Set::where('course_id', $id)
            ->orderBy('order', 'asc')
            ->get();

        $isRegistered = DB::table('enrollments')
            ->where('user_id', auth()->id())
            ->where('course_id', $id)
            ->exists();

        if ($request->isMethod('post') && !$isRegistered) 
        {
            DB::table('enrollments')->insert([
                'user_id' => auth()->id(),
                'course_id' => $id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('detailcourseregistered', ['id' => $id]);
        }

        return view('detail-course', compact('course', 'sets', 'isRegistered'));
    }


    public function detailcourseregistered($id)
    {
        $course = Course::findOrFail($id);

        $sets = Set::with(['lessons' => function ($query) {
            $query->orderBy('order', 'asc');
        }])
        ->where('course_id', $id)
        ->orderBy('order', 'asc')
        ->get();

        $completedLessons = DB::table('completed_lessons')
            ->where('user_id', auth()->id())
            ->pluck('lesson_id')
            ->toArray();

        $lessons = $sets->flatMap->lessons;

        $completedLessonsCount = $lessons->whereIn('id', $completedLessons)->count();

        $totalLessons = $lessons->count();
        $progress = $totalLessons > 0 ? round(($completedLessonsCount / $totalLessons) * 100) : 0;

        $newCompletedLesson = false;
        if ($totalLessons > 0) 
        {
            $lastLesson = $lessons->last();
        }

        $currentLesson = $lessons->first(function ($lesson) use ($completedLessons) {
            return !in_array($lesson->id, $completedLessons);
        });

        $currentOrder = 0;

        return view('detail-course-registered', compact('course', 'sets', 'completedLessons', 'progress', 'currentLesson', 'currentOrder','newCompletedLesson'));
    }

    public function detaillesson($course, $id, $order)
    {
        $lesson = Lesson::findOrFail($id);
        $lessonContent = LessonContent::where('lesson_id', $id)
            ->where('order', $order)
            ->firstOrFail();
    
        $totalContents = LessonContent::where('lesson_id', $id)->count();
        $progressPercentage = ($totalContents > 0 && $order > 0) ? ($order / $totalContents) * 100 : 0;
    
        $nextContent = LessonContent::where('lesson_id', $id)
            ->where('order', '>', $order)
            ->orderBy('order')
            ->first();
    
        if (!$nextContent) {
            DB::table('completed_lessons')->updateOrInsert(
                ['user_id' => auth()->id(), 'lesson_id' => $id],
                ['created_at' => now(), 'updated_at' => now()]
            );
    
            $nextRoute = route('detailcourseregistered', ['id' => $course]);

        } else {
            $nextRoute = route($nextContent->type === 'quiz' ? 'detaillessonquiz' : 'detaillesson', [
                'course' => $course,
                'id' => $id,
                'order' => $nextContent->order,
            ]);
        }
    
        return view('detail-lesson', compact('lesson', 'lessonContent', 'progressPercentage', 'nextRoute', 'course'));
    }
    
    public function detaillessonquiz(Request $request, $course, $id, $order)
    {
         $lesson = Lesson::findOrFail($id);
         $lessonContent = LessonContent::where('lesson_id', $id)
             ->where('order', $order)
             ->firstOrFail();

         $options = Option::where('lesson_content_id', $lessonContent->id)->get()->toArray();
           shuffle($options);

         $totalContents = LessonContent::where('lesson_id', $id)->count();
         $progressPercentage = ($totalContents > 0 && $order > 0) ? ($order / $totalContents) * 100 : 0;


         if ($request->isMethod('post')) {
             $selectedOption = $request->input('answer');

             $isCorrect = Option::where('lesson_content_id', $lessonContent->id)
                 ->where('id', $selectedOption)
                 ->where('is_correct', true)
                 ->exists();

             if ($isCorrect) {
                 $nextContent = LessonContent::where('lesson_id', $id)
                     ->where('order', '>', $order)
                     ->orderBy('order')
                     ->first();

                 if ($nextContent) {
                     return redirect()->route($nextContent->type === 'quiz' ? 'detaillessonquiz' : 'detaillesson', [
                         'course' => $course,
                         'id' => $id,
                         'order' => $nextContent->order,
                     ]);
                 }

                 DB::table('completed_lessons')->updateOrInsert(
                     ['user_id' => auth()->id(), 'lesson_id' => $id],
                     ['created_at' => now(), 'updated_at' => now()]
                 );

                 return redirect()->route('detailcourseregistered', ['id' => $course]);
             } else {
                 return back()->with('error', 'Your answer is incorrect. Please try again.');
             }
          }

         return view('detail-lesson-quiz', compact('lesson', 'lessonContent', 'options', 'progressPercentage', 'course', 'order'));
    }

    public function jump(Request $request, $setId, $lessonId, $order)
    {
          $set = Set::findOrFail($setId);
          $lesson = Lesson::where('set_id', $setId)->findOrFail($lessonId);

          $firstLesson = Lesson::where('set_id', $setId)->orderBy('order', 'asc')->first();

          $isFirstRoute = ($lessonId == $firstLesson->id && $order == 1);

          $lessonContents = LessonContent::whereIn('lesson_id', $set->lessons->pluck('id'))
              ->whereIn('order', [1, 3, 5])
              ->orderBy('lesson_id')
              ->orderBy('order')
              ->get();

          $lessonContent = $lessonContents->where('lesson_id', $lessonId)->where('order', $order)->first();

          if (!$lessonContent) {
              CompletedLesson::updateOrInsert(
                  ['user_id' => auth()->id(), 'lesson_id' => $lesson->id],
                  ['created_at' => now(), 'updated_at' => now()]
              );

              $nextLesson = Lesson::where('set_id', $setId)
                  ->where('id', '>', $lesson->id)
                  ->orderBy('id')
                  ->first();

              if ($nextLesson) {
                  return redirect()->route('jumphere', [
                      'setId' => $setId,
                      'lessonId' => $nextLesson->id,
                      'order' => 1
                  ]);
              }

              return redirect()->route('detailcourseregistered', ['id' => $set->course_id]);
          }

          $options = Option::where('lesson_content_id', $lessonContent->id)->get()->toArray();
          shuffle($options);

          $totalContents = $lessonContents->count();

          $totalSteps = 0;
          $completedContents = 0;

          foreach ($lessonContents as $index => $content) {
              $totalSteps++;
              
              if (($content->lesson_id < $lessonId) || ($content->lesson_id == $lessonId && $content->order <= $order)) {
                  $completedContents++;
              }
          }
          
          if($isFirstRoute){
            $progressPercentage = 0;
          }else{
            $progressPercentage = $totalContents > 0 ? round(($completedContents / ($totalContents + 1)) * 100) : 0;
          }

          if ($request->isMethod('post')) {
              $selectedOption = $request->input('answer');
              $isCorrect = Option::where('lesson_content_id', $lessonContent->id)
                  ->where('id', $selectedOption)
                  ->where('is_correct', true)
                  ->exists();

              if ($isCorrect) {
                  $nextContent = LessonContent::where('lesson_id', $lesson->id)
                      ->whereIn('order', [1, 3, 5])
                      ->where('order', '>', $order)
                      ->orderBy('order')
                      ->first();

                  if ($nextContent) {
                      return redirect()->route('jumphere', [
                          'setId' => $setId,
                          'lessonId' => $lesson->id,
                          'order' => $nextContent->order
                      ]);
                  }

                  CompletedLesson::updateOrInsert(
                      ['user_id' => auth()->id(), 'lesson_id' => $lesson->id],
                      ['created_at' => now(), 'updated_at' => now()]
                  );

                  $nextLesson = Lesson::where('set_id', $setId)
                      ->where('id', '>', $lesson->id)
                      ->orderBy('id')
                      ->first();

                  if ($nextLesson) {
                      return redirect()->route('jumphere', [
                          'setId' => $setId,
                          'lessonId' => $nextLesson->id,
                          'order' => 1
                      ]);
                  }

                  return redirect()->route('detailcourseregistered', ['id' => $set->course_id]);
              } else {
                  return back()->with('error', 'Your answer is incorrect. Please try again.');
              }
          }

          return view('jump', compact('set', 'lesson', 'lessonContent', 'options', 'progressPercentage'));
    }

    public function detailcoursefinished($id)
    {
        $course = Course::findOrFail($id);
    
        $sets = Set::with(['lessons' => function ($query) 
        {
            $query->orderBy('order', 'asc');
        }])->where('course_id', $id)->orderBy('order', 'asc')->get();
    
        $completedLessons = DB::table('completed_lessons')
            ->where('user_id', auth()->id())
            ->pluck('lesson_id')
            ->toArray();
    
        return view('detail-course-finished', compact('course', 'sets'));
    }
}

    


