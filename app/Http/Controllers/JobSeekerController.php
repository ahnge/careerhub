<?php

namespace App\Http\Controllers;

use App\Models\JobSeeker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobSeekerController extends Controller
{
    //
    public function index(string $job_seeker_id): View
    {
        $job_seeker = JobSeeker::findOrFail($job_seeker_id);

        $user = User::find($job_seeker->user_id);


        return view('jobseekers.profile', ['user' => $user]);
    }
}
