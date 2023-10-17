<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/login', [App\Http\Controllers\HomeController::class, 'index'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::resource('/admin', App\Http\Controllers\Admin\DashboardController::class);
    Route::resource('/add-student', App\Http\Controllers\Admin\StudentController::class);
    
    Route::resource('/teacher', App\Http\Controllers\Teacher\DashboardController::class);
    Route::resource('/student', App\Http\Controllers\Student\DashboardController::class);
});



