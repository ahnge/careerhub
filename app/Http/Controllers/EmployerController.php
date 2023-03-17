<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Helpers\MyHelper;

class EmployerController extends Controller
{
    // Displaying a list of the companies
    public function index()
    {
        return view('employers.list', [
            'employers' => Employer::paginate(5)
        ]);
    }

    /*
    * Public Company profile
    */
    public function show(Employer $employer)
    {
        return view('employers.detail', [
            'employer' => $employer,
        ]);
    }

    /*
    * Update the employer table record. (Update Company profile)
    */
    public function update(Request $request, Employer $employer)
    {
        // handle employer.company_logo
        if ($request->hasFile('company_logo')) {
            // Ensure file type is valid
            if (!MyHelper::validate_extension($request, 'company_logo')) {
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
