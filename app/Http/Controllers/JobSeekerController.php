<?php

namespace App\Http\Controllers;

use App\Models\JobSeeker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;

use App\Helpers\MyHelper;

class JobSeekerController extends Controller
{
    // Profile page of the jobseeker
    public function profile(string $job_seeker_id): View
    {
        $job_seeker = JobSeeker::findOrFail($job_seeker_id);

        $user = User::find($job_seeker->user_id);


        return view('jobseekers.profile', ['user' => $user]);
    }

    public function update(Request $request)
    {
        // Handle the job_seeker profile image
        if ($request->hasFile('profile_img')) {
            // Ensure file type is valid
            if (!MyHelper::validate_extension($request, 'profile_img')) {
                return Redirect::route('profile.edit')->with('status', 'error')->with('flash', 'Invalid file type!');
            }

            $normalized_path = MyHelper::storeAndGetPath($request, 'images', 'profile_img');

            // Save the path
            $job_seeker = $request->user()->jobSeeker;
            $job_seeker->profile_img = $normalized_path;
            $job_seeker->save();
        }

        // Handle the job_seeker's resume
        if ($request->hasFile('resume')) {
            // Ensure file type is valid
            if (!MyHelper::validate_extension($request, 'resume')) {
                return Redirect::route('profile.edit')->with('status', 'error')->with('flash', 'Invalid file type!');
            }

            $normalized_path = MyHelper::storeAndGetPath($request, 'public/resumes', 'resume');

            $job_seeker = $request->user()->jobSeeker;
            $job_seeker->resume = $normalized_path;
            $job_seeker->save();
        }


        return Redirect::route('profile.edit')->with('status', 'success')->with('flash', 'Profile updated successfully!');
    }
}
