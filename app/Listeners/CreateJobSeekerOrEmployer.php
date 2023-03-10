<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Registered;

use App\Models\JobSeeker;
use App\Models\Employer;

class CreateJobSeekerOrEmployer
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        //
        if ($event->user->type == 'job_seeker') {
            # code..
            $job_seeker = new JobSeeker;
            $job_seeker->user_id = $event->user->id;
            $job_seeker->save();
        } else {
            $employer = new Employer;
            $employer->user_id = $event->user->id;
            $employer->save();
        }
    }
}
