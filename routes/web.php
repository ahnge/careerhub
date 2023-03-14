<?php

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

Route::get('/admin', [JobPostingController::class, 'admin'])->middleware('employer')->name('admin');

Route::resource('jobpostings', JobPostingController::class);

Route::get('/jobseekers/{jobseeker}', [JobSeekerController::class, 'index'])->name('jobseeker.profile');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
