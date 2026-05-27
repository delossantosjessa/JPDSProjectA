<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;

// Route::redirect('/', '/dashboard');

Route::get('/', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.authenticate');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::middleware('session.user')->group(function () {
    Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('password.change.form');
    Route::post('/change-password', [UserController::class, 'updatePassword'])->name('password.change.update');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user_profile', [PagesController::class, 'userProfile'])->name('user.profile');
    Route::get('/user_post', [PagesController::class, 'userPost'])->name('user.post');
    Route::get('/student_course', [PagesController::class, 'studentCourses'])->name('student.course');
    Route::get('/student_courses', [PagesController::class, 'studentCourses']);


    Route::middleware('role:admin')->group(function () {
        Route::resource('/student', StudentController::class);
        Route::resource('/teacher', TeacherController::class);
        Route::resource('/degree', DegreeController::class);
    });
});

Route::get('/maintenance',[PagesController::class, 'maintenance'])->name('maintenance');
