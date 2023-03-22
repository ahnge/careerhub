<?php

namespace App\Policies;

use App\Models\Employer;
use App\Models\JobPosting;
use App\Models\User;

class EmployerPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Employer $employer): bool
    {
        return $employer->user->id === $user->id;
    }
}
