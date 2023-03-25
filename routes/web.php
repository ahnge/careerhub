<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\ProfileController;
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
    return redirect()->route('jobpostings.index');
});


// Job Postings
Route::get('/admin', [JobPostingController::class, 'admin'])->middleware('employer')->name('jobpostings.admin');
Route::resource('jobpostings', JobPostingController::class)->parameter('jobposting', 'jobposting:slug');

// Job Seekers
Route::patch('/jobseekers/{jobseeker}', [JobSeekerController::class, 'update'])->name('jobseeker.update');
Route::get('/jobpostings/{jobposting:slug}/applicants', [JobPostingController::class, 'viewApplicants'])->name('jobposting.applications');

// Employers
Route::get('/companies', [EmployerController::class, 'index'])->name('employers.index');
Route::get('/companies/{employer:slug}', [EmployerController::class, 'show'])->name('employers.show');
Route::patch('/companies/{employer:slug}', [EmployerController::class, 'update'])->name('employer.update');

// Applications
Route::post('/apply', [ApplicationController::class, 'store'])->name('application.store');

// Profile for both employers and job_seekers
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication
require __DIR__ . '/auth.php';
