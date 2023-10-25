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
        Route::resource('/add-teacher', \App\Http\Controllers\Admin\TeacherController::class);
        Route::resource('/add-subject', \App\Http\Controllers\Admin\SubjectController::class);
        Route::resource('/add-timetable', \App\Http\Controllers\Admin\TimeTableController::class);
        Route::get('/fetch-subjects/{classId}', [\App\Http\Controllers\Admin\TimeTableController::class, 'fetchSubjects'])->name('fetch-subjects');
    });

    Route::middleware(['role:Admin|Teacher'])->group(function () {
        Route::resource('/teacher',  App\Http\Controllers\Teacher\DashboardController::class);
    });

    Route::middleware(['role:Admin|Student'])->group(function () {
        Route::resource('/student', App\Http\Controllers\Student\DashboardController::class);
    });

Route::resource('/my-profile', \App\Http\Controllers\MyProfileController::class);

});