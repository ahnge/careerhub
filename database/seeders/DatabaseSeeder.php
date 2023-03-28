<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\JobPosting;
use App\Models\JobSeeker;
use App\Models\Location;




class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            IndustrySeeder::class,
            JobFunctionSeeder::class,
        ]);

        $admin = User::factory()
            ->state([
                'name' => 'admin',
                'email' => 'a@a.com',
                'type' => 'employer'
            ]);

        $yangon = Location::factory()->state(['name' => 'yangon']);

        Employer::factory()->has(
            JobPosting::factory()->for($yangon)
                ->count(10)
        )
            ->count(1)
            ->for($admin)
            ->for($yangon)
            ->create();

        $admin1 = User::factory()
            ->state([
                'name' => 'admin1',
                'email' => 'b@b.com',
                'type' => 'employer'
            ]);

        $mandalay = Location::factory()->state(['name' => 'mandalay']);

        Employer::factory()->has(
            JobPosting::factory()->for($mandalay)
                ->count(10)
        )
            ->count(1)
            ->for($admin1)
            ->for($mandalay)
            ->create();

        JobSeeker::factory()
            ->count(1)
            ->for(User::factory()->state([
                'name' => 'luke',
                'email' => 'l@l.com',
                'type' => 'job_seeker',
            ]))
            ->create();
    }
}
