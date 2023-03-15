<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Helpers\MyHelper;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        // Handle the employer or job_seeker profile image
        if ($request->hasFile('profile_img') || $request->hasFile('company_logo')) {

            if ($request->user()->type === 'job_seeker') {
                // Ensure file type is valid
                if (!MyHelper::validate_extension($request, 'profile_img')) {
                    return Redirect::route('profile.edit')->with('status', 'error')->with('flash', 'Invalid file type!');
                }

                $normalized_path = MyHelper::storeAndGetPath($request, 'images', 'profile_img');

                // Save the path
                $job_seeker = $request->user()->jobSeeker;
                $job_seeker->profile_img = $normalized_path;
                $job_seeker->save();
            } else {
                // Ensure file type is valid
                if (!MyHelper::validate_extension($request, 'company_logo')) {
                    return Redirect::route('profile.edit')->with('status', 'error')->with('flash', 'Invalid file type!');
                }

                $normalized_path = MyHelper::storeAndGetPath($request, 'images', 'company_logo');

                // Save the path
                $employer = $request->user()->employer;
                $employer->company_logo = $normalized_path;
                $employer->save();
            }
        }

        // Handle the job_seeker's resume
        if ($request->hasFile('resume') && $request->user()->type === 'job_seeker') {
            // Ensure file type is valid
            if (!MyHelper::validate_extension($request, 'resume')) {
                return Redirect::route('profile.edit')->with('status', 'error')->with('flash', 'Invalid file type!');
            }

            $normalized_path = MyHelper::storeAndGetPath($request, 'public/resumes', 'resume');

            $job_seeker = $request->user()->jobSeeker;
            $job_seeker->resume = $normalized_path;
            $job_seeker->save();
        }

        // Handle the employer company name
        if ($request->company_name) {
            $employer = $request->user()->employer;
            $employer->company_name = $request->company_name;
            $employer->save();
        }

        // Handle the user table
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'success')->with('flash', 'Profile updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
