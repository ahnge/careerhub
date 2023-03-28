<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobPosting>
 */
class JobPostingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $random = fake()->numberBetween(0, 2);

        return [
            'title' => fake()->name(),
            'description' => "This is a fake job created to test the application.",
            'requirements' => fake()->text(),
            'type' => $random > 0 ? 'remote' : 'on_site',
            'time' => $random > 0 ? 'full_time' : 'part_time',
            'industry_id' => fake()->numberBetween(1, 26),
            'job_function_id' => fake()->numberBetween(1, 191),
            'salary' => fake()->numberBetween(400000, 2000000),
            'post' => fake()->numberBetween(1, 10),
        ];
    }
}
