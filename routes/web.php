<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullController;


Route::middleware(['guestion'])->group( function() 
{
    Route::get('/register', [FullController::class, 'register'])->name('register');
    Route::post('/register', [FullController::class, 'doregister'])->name('doregister');
    Route::get('/login', [FullController::class, 'login'])->name('login');
    Route::post('/login', [FullController::class, 'dologin'])->name('dologin');
});

Route::middleware(['authentic'])->group( function()
{
    Route::get('/index', [FullController::class, 'index'])->name('index');
    Route::get('/logout', [FullController::class, 'logout'])->name('logout');  
    Route::match(['GET', 'POST'], '/detail-course/{id}', [FullController::class, 'detailcourse'])->name('detailcourse');
    Route::match(['GET', 'POST'], '/detail-course-registered/{id}', [FullController::class, 'detailcourseregistered'])->name('detailcourseregistered');
    Route::get('/lesson/{course}/{id}/{order}', [FullController::class, 'detaillesson'])->name('detaillesson');
    Route::match(['get', 'post'], '/lesson/quiz/{course}/{id}/{order}', [FullController::class, 'detaillessonquiz'])->name('detaillessonquiz');
    Route::match(['get','post'],'/jump/{setId}/{lessonId}/{order}', [FullController::class, 'jump'])->name('jumphere');
    Route::get('/courses/{id}/finished', [FullController::class, 'detailcoursefinished'])->name('detailcoursefinished');
});

