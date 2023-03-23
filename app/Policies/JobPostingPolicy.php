<?php

namespace App\Policies;

use App\Models\JobPosting;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPostingPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        if (
            !$user->type === 'employer' ||
            !isset($user->employer->company_name) ||
            !isset($user->employer->industry_id) ||
            !isset($user->employer->about) ||
            !isset($user->employer->location_id)
        ) {
            return Response::deny('Please update all company infomations first.');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, JobPosting $jobPosting): bool
    {
        return $user->type === 'employer' && $user->employer->id === $jobPosting->employer_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, JobPosting $jobPosting): bool
    {
        return $user->type === 'employer' && $user->employer->id === $jobPosting->employer_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, JobPosting $jobPosting): bool
    {
        return $user->type === 'employer' && $user->employer->id === $jobPosting->employer_id;
    }

    /**
     * Determine whether the employer can view its applicants.
     */
    public function viewApplicants(User $user, JobPosting $jobPosting): bool
    {
        return $user->type === 'employer' && $user->employer->id === $jobPosting->employer_id;
    }
}
