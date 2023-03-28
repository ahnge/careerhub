<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Throwable;

class ApplicationController extends Controller
{
    //
    /*
    * Job apply, store the application table with job_seeker_id and job_posting_id
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_seeker_id' => 'int|required',
            'job_posting_id' => 'int|required',
        ]);

        $job_seeker_id = (int)$validated['job_seeker_id'];
        $job_posting_id = (int)$validated['job_posting_id'];

        // Create new application 
        $application = new Application;
        $application->job_seeker_id = $job_seeker_id;
        $application->job_posting_id = $job_posting_id;

        // Authorize the user
        try {
            $this->authorize('apply', $application);
        } catch (Throwable $th) {
            $status = 'warning';
            $message = $th->getMessage();

            $route_name = 'profile.update';

            if ($message === 'Only job seekers can apply!') {
                $route_name = 'jobpostings.index';
            };
            if ($message === 'You have already applied!') {
                return back()->with('flashes', [compact('status', 'message')]);
            };

            return redirect()->route($route_name)->with('flashes', [compact('status', 'message')]);
        }

        $application->save();

        // Return with success
        Session::flash('flashes', [['status' => 'success', 'message' => 'Applied successfully!']]);
        return back();
    }
}
