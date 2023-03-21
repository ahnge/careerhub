<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Application;
use App\Models\Employer;
use App\Models\JobPosting;
use App\Policies\ApplicationPolicy;
use App\Policies\EmployerPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Policies\JobPostingPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        JobPosting::class => JobPostingPolicy::class,
        Application::class => ApplicationPolicy::class,
        Employer::class => EmployerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
