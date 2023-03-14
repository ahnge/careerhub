<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\JobPosting;
use App\Models\Location;

class JobPostingController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('job_postings.jobpostings', [
            'jobPostings' => JobPosting::with('location')->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', JobPosting::class);
        return view('job_postings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', JobPosting::class);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'requirements' => 'required',
            'type' => 'required|in:remote,on_site',
            'time' => 'required|in:full_time,part_time',
            'location' => 'required',
        ]);

        $location = Location::firstOrCreate([
            'name' => strtolower($validatedData['location'])
        ]);


        $jobPosting = new JobPosting;
        $jobPosting->title = $validatedData['title'];
        $jobPosting->description = $validatedData['description'];
        $jobPosting->requirements = $validatedData['requirements'];
        $jobPosting->type = $validatedData['type'];
        $jobPosting->time = $validatedData['time'];
        $jobPosting->salary = $request->salary ? (int)$request->salary : null;

        $jobPosting->location_id = $location->id;
        $jobPosting->user_id = $request->user()->id;

        $jobPosting->save();

        return redirect()->route('admin')->with('flash', 'Job posting created successfully.')->with('status', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jobPosting = JobPosting::find($id);
        $this->authorize('update', $jobPosting);

        return view('job_postings.edit', [
            'jobPosting' => $jobPosting
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Get the jobPosting instance
        $jobPosting = JobPosting::find($id);
        // Authorize
        $this->authorize('update', $jobPosting);

        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'requirements' => 'required',
            'type' => 'required|in:remote,on_site',
            'time' => 'required|in:full_time,part_time',
            'location' => 'required',
        ]);


        $location = Location::firstOrCreate([
            'name' => strtolower($validatedData['location'])
        ]);

        $jobPosting->title = $validatedData['title'];
        $jobPosting->description = $validatedData['description'];
        $jobPosting->requirements = $validatedData['requirements'];
        $jobPosting->type = $validatedData['type'];
        $jobPosting->time = $validatedData['time'];

        $jobPosting->salary = $request->salary ? (int)$request->salary : null;
        $jobPosting->location_id = $location->id;

        $jobPosting->save();

        return redirect()->route('admin')->with('flash', 'Job posting updated successfully!')->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobPosting = JobPosting::findOrFail($id);

        // authorize the user to delete the job posting
        $this->authorize('delete', $jobPosting);

        $jobPosting->delete();

        return redirect()->route('admin')->with('flash', 'Job Posting has been deleted!')->with('status', 'success');
    }

    public function admin(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Get the job postings for the user
        $jobPostings = $user->jobPostings()->orderBy('created_at', 'desc')->paginate(10);

        // Render the admin view with the job postings
        return view('admin.index', compact('jobPostings'));
    }
}
