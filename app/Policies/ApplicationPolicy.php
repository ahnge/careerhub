<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\DB;

use Illuminate\Auth\Access\AuthorizationException;


class ApplicationPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether user can apply
     */
    public function apply(User $user, Application $application): Response
    {
        // Ensure user is a job seeker.
        if (!$user->type === 'job_seeker') {
            throw new AuthorizationException('Only job seekers can apply!');
        }

        // Ensure user has uploaded resume.
        if (!$user->jobSeeker->resume) {
            throw new AuthorizationException('Please upload your resume to apply!');
        }

        // Ensure user has uploaded linkedin_url.
        if (!$user->jobSeeker->linkedin_url) {
            throw new AuthorizationException('Please upload your Linkedin url to apply!');
        }

        // Ensure user has not been applied before.
        $old_application_exists = DB::table('applications')
            ->where('job_seeker_id', '=', $user->jobSeeker->id)
            ->where('job_posting_id', '=', $application->jobPosting->id)
            ->exists();

        if ($old_application_exists) {
            throw new AuthorizationException('You have already applied!');
        }
        return Response::allow();
    }
}
