<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['noauth'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
    Route::get('auth/google', [\App\Http\Controllers\socialite\GoogleController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('auth/google/callback', [\App\Http\Controllers\socialite\GoogleController::class, 'handleGoogleCallback']);

    Route::get('auth/facebook', [\App\Http\Controllers\socialite\FacebookController::class, 'redirectToFacebook'])->name('auth.facebook');
    Route::get('auth/facebook/callback', [\App\Http\Controllers\socialite\FacebookController::class, 'handleFacebookCallback']);

    Route::get('auth/twitter', [\App\Http\Controllers\socialite\TwitterController::class, 'redirectToTwitter'])->name('auth.twitter');
    Route::get('auth/twitter/callback', [\App\Http\Controllers\socialite\TwitterController::class, 'handleTwitterCallback']);
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:Admin'])->group(function () {
        Route::resource('/admin-dashboard', App\Http\Controllers\Admin\DashboardController::class);
        Route::resource('/add-student', App\Http\Controllers\Admin\StudentController::class);
        Route::resource('/add-class', App\Http\Controllers\Admin\ClassController::class);
        Route::resource('/add-classTeacher', App\Http\Controllers\Admin\ClassTeacherController::class);
        Route::resource('/add-teacher', \App\Http\Controllers\Admin\TeacherController::class);
        Route::resource('/add-subject', \App\Http\Controllers\Admin\SubjectController::class);
        Route::resource('/add-timetable', \App\Http\Controllers\Admin\TimeTableController::class);
        Route::resource('/view-attendance', \App\Http\Controllers\Admin\AttendanceController::class);
        Route::resource('/add-fees', \App\Http\Controllers\Admin\FeeController::class);
        Route::get('/fetch-feesData', [\App\Http\Controllers\Admin\FeeController::class, 'fetchFees'])->name('fetch-feesData');
        Route::get('/fetch-attendance', [\App\Http\Controllers\Admin\AttendanceController::class, 'fetchAttendance'])->name('fetch-attendance');
        Route::get('/fetch-subjects/{classId}', [\App\Http\Controllers\Admin\TimeTableController::class, 'fetchSubjects'])->name('fetch-subjects');
        Route::get('/fetch-timetable', [\App\Http\Controllers\Admin\TimeTableController::class, 'fetchTimetable'])->name('fetch-timetable');
        Route::get('/excel/list-Students', [App\Http\Controllers\Admin\StudentController::class, 'exportExcel'])->name('excel-listStudents');
        Route::get('/pdf/list-Students', [App\Http\Controllers\Admin\StudentController::class, 'exportPdf'])->name('pdf-listStudents');
        Route::get('/excel/list-Teachers', [App\Http\Controllers\Admin\TeacherController::class, 'exportExcel'])->name('excel-listTeachers');
        Route::get('/pdf/list-Teachers', [App\Http\Controllers\Admin\TeacherController::class, 'exportPdf'])->name('pdf-listTeachers');
        Route::get('/excel/class-Teachers', [App\Http\Controllers\Admin\ClassTeacherController::class, 'exportExcel'])->name('excel-classTeacher');
        Route::get('/pdf/class-Teachers', [App\Http\Controllers\Admin\ClassTeacherController::class, 'exportPdf'])->name('pdf-classTeacher');
        Route::resource('/event', \App\Http\Controllers\Admin\CalendarController::class);
    });

    Route::middleware(['role:Admin|Teacher'])->group(function () {
        Route::resource('/teacher-dashboard',  App\Http\Controllers\Teacher\DashboardController::class);
        Route::resource('/my-students',  App\Http\Controllers\Teacher\MyStudentController::class);
        Route::resource('/my-timetable',  App\Http\Controllers\Teacher\MyTimetableController::class);
        Route::resource('/attendance',  App\Http\Controllers\Teacher\AttendanceController::class);
        Route::resource('/my-calendar',  App\Http\Controllers\Teacher\CalendarController::class);
        Route::get('/excel/myStudents', [App\Http\Controllers\Teacher\MyStudentController::class, 'exportExcel'])->name('excel-myStudents');
        Route::get('/excel/attendance', [App\Http\Controllers\Teacher\AttendanceController::class, 'exportExcel'])->name('excel-attendance');
        Route::get('/pdf/myStudents', [App\Http\Controllers\Teacher\MyStudentController::class, 'exportPdf'])->name('pdf-myStudents');
        Route::get('/pdf/attendance', [App\Http\Controllers\Teacher\AttendanceController::class, 'exportPdf'])->name('pdf-attendance');
    });

    Route::middleware(['role:Admin|Student'])->group(function () {
        Route::resource('/student-dashboard', App\Http\Controllers\Student\DashboardController::class);
        Route::resource('/academic-calendar',  App\Http\Controllers\Student\CalendarController::class);
        Route::resource('/student-timetable',  App\Http\Controllers\Student\MyTimetableController::class);
        Route::resource('/my-attendance',  App\Http\Controllers\Student\MyAttendanceController::class);
        Route::resource('/pay-fees',  App\Http\Controllers\Student\FeeController::class);
    });

    Route::resource('/my-profile', \App\Http\Controllers\MyProfileController::class);
    Route::get('/calendar', [\App\Http\Controllers\Admin\CalendarController::class, 'getEvent'])->name('calendar');
});
