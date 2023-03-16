<?php

use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\JobSeeker;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\ProfileController;
use App\Models\JobPosting;
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
Route::resource('jobpostings', JobPostingController::class);

// Job Seekers
Route::get('/jobseekers/{jobseeker}', [JobSeekerController::class, 'profile'])->name('jobseeker.profile');
Route::patch('/jobseekers/{jobseeker}', [JobSeekerController::class, 'update'])->name('jobseeker.update');
// Employers
Route::get('/companies', [EmployerController::class, 'index'])->name('employers.index');
Route::get('/companies/{employer}', [EmployerController::class, 'show'])->name('employers.show');
Route::patch('/companies/{employer}', [EmployerController::class, 'update'])->name('employer.update');



// Profile for both employers and job_seekers
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication
require __DIR__ . '/auth.php';
