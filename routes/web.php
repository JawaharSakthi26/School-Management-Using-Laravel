<?php

use App\Http\Controllers\Admin\DashboardController;
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
        Route::resource('/admin', DashboardController::class);
        Route::resource('/add-student', App\Http\Controllers\Admin\StudentController::class);
    });

    Route::middleware(['role:Admin|Teacher'])->group(function () {
        Route::resource('/teacher',  App\Http\Controllers\Teacher\TeacherController::class);
    });

    Route::resource('/student', App\Http\Controllers\Student\DashboardController::class);
});



