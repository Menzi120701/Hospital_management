<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\StaffControllerController;
use App\Models\Department;
use App\Models\Patient;
use App\Models\Staff;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('chirps', ChirpController::class)
->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);


 Route::resource("messages",MessageController::class);   
require __DIR__.'/auth.php';
Route::resource('department', DepartmentController::class)
->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);
     Route::resource('doctor', DoctorController::class)
->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);
    Route::resource('staff', StaffController::class)
->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);
    Route::resource('patient', PatientController::class)
->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);


