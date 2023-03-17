<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

class ApplicationController extends Controller
{
    //
    /*
    * Job apply, store the application table with job_seeker_id and job_posting_id
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_seeker_id' => 'required',
            'job_posting_id' => 'required',
        ]);

        $job_seeker_id = (int)$validated['job_seeker_id'];
        $job_posting_id = (int)$validated['job_posting_id'];

        // Accounts type of job_seeker are authorized.
        $this->authorize('apply', Application::class);


        // Ensure user has not been applied.
        $old_application_exists = DB::table('applications')
            ->where('job_seeker_id', '=', $job_seeker_id)
            ->where('job_posting_id', '=', $job_posting_id)
            ->exists();

        if ($old_application_exists) {
            Session::flash('flashes', [['status' => 'error', 'message' => 'You have already applied!']]);

            return redirect()->route('jobpostings.show', ['jobposting' => (int)$validated['job_posting_id']]);
        }

        // Create new application 
        $application = new Application;
        $application->job_seeker_id = $job_seeker_id;
        $application->job_posting_id = $job_posting_id;
        $application->save();


        // Return with success
        Session::flash('flashes', [['status' => 'success', 'message' => 'Applied successfully!']]);
        return redirect()->route('jobpostings.show', ['jobposting' => (int)$validated['job_posting_id']]);
    }
}
