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
    public function update(Request $request)
    {
        $job_seeker = $request->user()->jobSeeker;

        $this->authorize('update', $job_seeker);

        // Validate the request data
        $validated = $request->validate([
            'profile_img' => 'image|nullable',
            'resume' => 'file|nullable',
            'linkedin_url' => 'url|nullable',
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

        // Handle the job_seeker's linkedin
        if ($request->linkedin_url) {
            $job_seeker->linkedin_url = $validated['linkedin_url'];
        }

        $job_seeker->save();

        $status = 'success';
        $message = 'Profile updated successfully!';
        return Redirect::route('profile.edit')->with('flashes', [compact('status', 'message')]);
    }
}
