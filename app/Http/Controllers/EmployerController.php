<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Helpers\MyHelper;
use App\Models\JobPosting;
use App\Models\Location;

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
    public function show(Employer $employer)
    {
        $employer = $employer->load(['jobPostings', 'location', 'industry', 'jobPostings.industry', 'jobPostings.location', 'jobPostings.jobFunction']);

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

        $validated = $request->validate([
            'company_logo' => 'image|nullable',
            'company_name' => 'ascii|nullable',
            'about' => 'ascii|nullable',
            'location' => 'ascii|nullable',
            'industry_id' => 'integer|exists:industries,id|nullable',
        ]);

        // Ensure uploaded picture has no errors.
        if ($request->file('company_logo') && $request->file('company_logo')->getError()) {
            $status = 'error';
            $message = 'Something went wrong. Maybe the file uploaded was too big.';
            return Redirect::route('profile.edit')->with('flashes', [compact('status', 'message')]);
        }

        $employer = $request->user()->employer;

        // handle employer.company_logo
        if ($request->hasFile('company_logo') && $request->file('company_logo')->isValid()) {
            $normalized_path = MyHelper::storeAndGetPath($request, 'images', 'company_logo');

            // Save the path
            $employer->company_logo = $normalized_path;
        }

        // Handle the employer company name
        if ($request->company_name) {
            $employer->company_name = $validated['company_name'];
        }

        // Handle company about
        if ($request->about) {
            $employer->about = $validated['about'];
        }

        // Handle company location
        if ($request->location) {
            $location = Location::firstOrCreate([
                'name' => strtolower($validated['location'])
            ]);
            $employer->location_id = $location->id;
        }

        // Handle company industry
        if ($request->industry_id) {
            $employer->industry_id = $validated['industry_id'];
        }

        // save the info
        $employer->save();

        // Redirect with success
        $status = 'success';
        $message = 'Profile updated successfully!';
        return Redirect::route('profile.edit')->with('flashes', [compact('status', 'message')]);
    }
}
