<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\JobPosting;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class JobPostingController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // Get query parameters if exists
        $q = $request->input('q');
        $industry_id = $request->input('industry');
        $job_function_id = $request->input('job_function');

        // Build the query
        $query = JobPosting::query()->with(['location', 'jobFunction', 'industry', 'employer']);

        if (!empty($q)) {
            $query->where('title', 'like', '%' . $q . '%');
        }
        if (!empty($industry_id)) {
            $query->where('industry_id', $industry_id);
        }
        if (!empty($job_function_id)) {
            $query->where('job_function_id', $job_function_id);
        }

        $jobPostings = $query->paginate(10);

        $industries  = DB::table('industries')->pluck('id', 'name');
        $job_functions = DB::table('job_functions')->pluck('id', 'name');

        return view('job_postings.jobpostings', compact('jobPostings', 'industries', 'job_functions'))->with('q', $q)->with('job_function_id', $job_function_id)->with('industry_id', $industry_id);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $this->authorize('create', JobPosting::class);
        } catch (\Throwable $th) {
            $status = 'warning';
            $message = $th->getMessage();
            return redirect()->route('profile.update')->with('flashes', [compact('status', 'message')]);
        }

        // Get industries to display in the select input
        $industries  = DB::table('industries')->pluck('id', 'name');

        // Get job_functions to display in the select input
        $job_functions = DB::table('job_functions')->pluck('id', 'name');

        return view('job_postings.create', compact('industries', 'job_functions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', JobPosting::class);

        $validatedData = $request->validate([
            'title' => 'ascii|required|max:255',
            'description' => 'ascii|required',
            'requirements' => 'required',
            'type' => 'required|in:remote,on_site',
            'time' => 'required|in:full_time,part_time',
            'location' => 'required',
            'industry_id' => 'integer|exists:industries,id',
            'job_function_id' => 'integer|exists:job_functions,id',
            'salary' => 'integer|nullable',
            'post' => 'integer|required',
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
        $jobPosting->salary = $request->salary ? (int)$validatedData['salary'] : null;
        $jobPosting->industry_id = $validatedData['industry_id'];
        $jobPosting->job_function_id = $validatedData['job_function_id'];
        $jobPosting->post = $validatedData['post'];
        $jobPosting->location_id = $location->id;
        $jobPosting->employer_id = $request->user()->employer->id;
        $jobPosting->save();

        $status = 'success';
        $message = 'Job Posting created successfully!';
        return redirect()->route('jobpostings.admin')->with('flashes', [compact('status', 'message')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPosting $jobposting)
    {
        $relatedJobPostings = JobPosting::with(['location', 'jobFunction', 'industry', 'employer'])
            ->where([
                ['industry_id', '=', $jobposting->industry->id],
                ['id', '!=', $jobposting->id],
            ])
            ->orWhere([
                ['job_function_id', '=', $jobposting->jobFunction->id],
                ['id', '!=', $jobposting->id],
            ])
            ->limit(5)
            ->get();

        return view('job_postings.detail', [
            'jobPosting' => $jobposting,
            'relatedJobPostings' => $relatedJobPostings
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPosting $jobposting)
    {
        $this->authorize('update', $jobposting);

        // Get industries to display in the select input
        $industries  = DB::table('industries')->pluck('id', 'name');

        // Get job_functions to display in the select input
        $job_functions = DB::table('job_functions')->pluck('id', 'name');

        return view('job_postings.edit', compact('jobposting', 'industries', 'job_functions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobPosting $jobposting)
    {
        // Authorize
        $this->authorize('update', $jobposting);

        $validatedData = $request->validate([
            'title' => 'ascii|required|max:255',
            'description' => 'ascii|required',
            'requirements' => 'required',
            'type' => 'required|in:remote,on_site',
            'time' => 'required|in:full_time,part_time',
            'location' => 'required',
            'industry_id' => 'integer|exists:industries,id',
            'job_function_id' => 'integer|exists:job_functions,id',
            'salary' => 'integer|nullable',
            'post' => 'integer|required',
        ]);


        $location = Location::firstOrCreate([
            'name' => strtolower($validatedData['location'])
        ]);

        $jobposting->title = $validatedData['title'];
        $jobposting->description = $validatedData['description'];
        $jobposting->requirements = $validatedData['requirements'];
        $jobposting->type = $validatedData['type'];
        $jobposting->time = $validatedData['time'];
        $jobposting->salary = $request->salary ? (int)$validatedData['salary'] : null;
        $jobposting->industry_id = $validatedData['industry_id'];
        $jobposting->job_function_id = $validatedData['job_function_id'];
        $jobposting->post = $validatedData['post'];
        $jobposting->location_id = $location->id;
        $jobposting->employer_id = $request->user()->employer->id;
        $jobposting->save();

        $status = 'success';
        $message = 'Job Posting updated successfully!';
        return redirect()->route('jobpostings.admin')->with('flashes', [compact('status', 'message')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPosting $jobposting)
    {
        // authorize the user to delete the job posting
        $this->authorize('delete', $jobposting);

        $jobposting->delete();

        $status = 'success';
        $message = 'Job Posting has been deleted!';
        return redirect()->route('jobpostings.admin')->with('flashes', [compact('status', 'message')]);
    }

    /**
     * Admin panel for user of type 'employer'
     */
    public function admin(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Get the job postings for the user
        $jobPostings = $user->employer->jobPostings()->with('applicants')->orderBy('created_at', 'desc')->paginate(10);

        // Render the admin view with the job postings
        return view('admin.index', compact('jobPostings'));
    }

    /*
    * See all applicants of this jobPosting
    */
    public function viewApplicants(Request $request, JobPosting $jobposting)
    {
        $this->authorize('viewApplicants', $jobposting);

        $applicants = $jobposting->applicants()->paginate(10);

        return view('employers.view_applicants', compact('jobposting', 'applicants'));
    }
}
