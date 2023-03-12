<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\JobPosting;
use App\Models\Location;
use Illuminate\Support\Facades\Session;

class JobPostingController extends Controller
{
    public function __construct()
    {
        // $this->middleware('employer')->only('create', 'store');
        // $this->authorizeResource(JobPosting::class, 'jobpostings');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        Session::flash('flash', 'Testing flash');
        Session::flash('status', 'success');
        return view('job_postings.jobpostings', [
            'jobPostings' => JobPosting::all()
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
            'type' => 'required',
            'time' => 'required',
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

        return redirect()->route('jobpostings.index')->with('flash', 'Job posting created successfully.')->with('status', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
