<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\JobPosting;
use App\Models\JobSeeker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()
            ->has(JobPosting::factory()->count(10))
            ->state([
                'name' => 'admin',
                'email' => 'a@a.com',
                'type' => 'employer'
            ]);

        Employer::factory()
            ->count(1)
            ->for($admin)
            ->create();

        $admin1 = User::factory()
            ->has(JobPosting::factory()->count(10))
            ->state([
                'name' => 'admin1',
                'email' => 'b@b.com',
                'type' => 'employer'
            ]);

        Employer::factory()
            ->count(1)
            ->for($admin1)
            ->create();

        JobSeeker::factory()
            ->count(1)
            ->for(User::factory()->state([
                'name' => 'luke',
                'email' => 'l@l.com',
                'type' => 'job_seeker'
            ]))
            ->create();
    }
}
