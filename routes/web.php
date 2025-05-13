<?php

use App\Http\Controllers\ReportController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::middleware('can:access-admin')->group(function () {
        Route::resource('/teachers', TeacherController::class);
        Route::resource('/courses', CourseController::class);
        Route::resource('/batches', BatchController::class);
    });

    Route::resource('/students', StudentController::class);
    Route::resource('/teachers', TeacherController::class);
    Route::resource('/courses', CourseController::class);
    Route::resource('/batches', BatchController::class);

    // Print payment BEFORE resource route
    Route::get('/report/report1/{id}', [ReportController::class, 'report1'])
     ->name('report.print');

    Route::resource('payments', PaymentController::class);
    Route::resource('enrollments', EnrollmentController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
