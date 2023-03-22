<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Helpers\MyHelper;
use App\Models\JobPosting;

class EmployerController extends Controller
{
    // Displaying a list of the companies
    public function index(Request $request)
    {
        $q = $request->input('q');

        // Build the query
        $query = Employer::query()->with('jobPostings');

        if (!empty($q)) {
            $query->where('company_name', 'like', '%' . $q . '%');
        }

        $employers = $query->paginate(10);

        return view('employers.list', compact('employers'))->with('q', $q);
    }

    /*
    * Public Company profile
    */
    public function show($id)
    {
        $employer = Employer::with(['jobPostings', 'location', 'industry', 'jobPostings.industry', 'jobPostings.location', 'jobPostings.jobFunction'])->findOrFail($id);

        return view('employers.detail', [
            'employer' => $employer,
        ]);
    }

    /*
    * Update the employer table record. (Update Company profile)
    */
    public function update(Request $request, Employer $employer)
    {
        $this->authorize('update', $employer);
        // handle employer.company_logo
        if ($request->hasFile('company_logo')) {
            // Ensure file type is valid
            if (!MyHelper::validate_extension($request, 'company_logo', 'profile')) {
                $status = 'error';
                $message = 'Invalid file type!';
                return Redirect::route('profile.edit')->with('flashes', [compact('status', 'message')]);
            }

            $normalized_path = MyHelper::storeAndGetPath($request, 'images', 'company_logo');

            // Save the path
            $employer = $request->user()->employer;
            $employer->company_logo = $normalized_path;
            $employer->save();
        }

        // Handle the employer company name
        if ($request->company_name) {
            $employer = $request->user()->employer;
            $employer->company_name = $request->company_name;
            $employer->save();
        }

        // Redirect with success
        $status = 'success';
        $message = 'Profile updated successfully!';
        return Redirect::route('profile.edit')->with('flashes', [compact('status', 'message')]);
    }
}
