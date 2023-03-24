<?php

namespace App\Policies;

use App\Models\JobSeeker;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobSeekerPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, JobSeeker $jobSeeker): bool
    {
        return $user->id === $jobSeeker->user_id;
    }
}
