<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/login', [App\Http\Controllers\HomeController::class, 'index'])->name('login');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:Admin'])->group(function () {
        Route::resource('/admin', App\Http\Controllers\Admin\DashboardController::class);
        Route::resource('/add-student', App\Http\Controllers\Admin\StudentController::class);
        Route::resource('/add-class', App\Http\Controllers\Admin\ClassController::class);
        Route::resource('/add-classTeacher', App\Http\Controllers\Admin\ClassTeacherController::class);
        Route::resource('/add-teacher', \App\Http\Controllers\Admin\TeacherController::class);
        Route::resource('/add-subject', \App\Http\Controllers\Admin\SubjectController::class);
        Route::resource('/add-timetable', \App\Http\Controllers\Admin\TimeTableController::class);
        Route::get('/fetch-subjects/{classId}', [\App\Http\Controllers\Admin\TimeTableController::class, 'fetchSubjects'])->name('fetch-subjects');
        Route::get('/fetch-timetable', [\App\Http\Controllers\Admin\TimeTableController::class, 'fetchTimetable'])->name('fetch-timetable');
        Route::resource('/event', \App\Http\Controllers\Admin\CalendarController::class);
        Route::get('/calendar', [\App\Http\Controllers\Admin\CalendarController::class, 'getEvent'])->name('calendar');
    });

    Route::middleware(['role:Admin|Teacher'])->group(function () {
        Route::resource('/teacher',  App\Http\Controllers\Teacher\DashboardController::class);
        Route::resource('/my-students',  App\Http\Controllers\Teacher\MyStudentController::class);
        Route::resource('/my-timetable',  App\Http\Controllers\Teacher\MyTimetableController::class);
        Route::resource('/attendance',  App\Http\Controllers\Teacher\AttendanceController::class);
        Route::resource('/my-calendar',  App\Http\Controllers\Teacher\CalendarController::class);
    });

    Route::middleware(['role:Admin|Student'])->group(function () {
        Route::resource('/student', App\Http\Controllers\Student\DashboardController::class);
    });

Route::resource('/my-profile', \App\Http\Controllers\MyProfileController::class);

});