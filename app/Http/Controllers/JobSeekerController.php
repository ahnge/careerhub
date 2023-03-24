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
        $job_seeker = $request->user()->jobSeeker;

        $this->authorize('update', $job_seeker);

        // Validate the request data
        $validated = $request->validate([
            'profile_img' => 'image|nullable',
            'resume' => 'file|nullable',
        ]);

        // Handle the job_seeker profile image
        if ($request->hasFile('profile_img')) {
            $normalized_path = MyHelper::storeAndGetPath($request, 'images', 'profile_img');

            $job_seeker->profile_img = $normalized_path;
        }

        // Handle the job_seeker's resume
        if ($request->hasFile('resume')) {
            $normalized_path = MyHelper::storeAndGetPath($request, 'public/resumes', 'resume');

            $job_seeker->resume = $normalized_path;
        }

        $job_seeker->save();

        $status = 'success';
        $message = 'Profile updated successfully!';
        return Redirect::route('profile.edit')->with('flashes', [compact('status', 'message')]);
    }
}
