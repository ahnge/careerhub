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
    //     $table->string('title');
    // $table->text('description');
    // $table->text('requirements');
    // $table->enum('type', ['remote', 'on_site']);
    // $table->enum('time', ['full_time', 'part_time']);
    // $table->decimal('salary', 8, 2);
    // $table->timestamps();
    public function definition(): array
    {
        $random = fake()->numberBetween(0, 2);

        return [
            'title' => fake()->name(),
            'description' => fake()->text(200),
            'requiremtns' => fake()->text(),
            'type' => $random > 0 ? 'remote' : 'on_site',
            'time' => $random > 0 ? 'full_time' : 'part_time',
            'salary' => fake()->numberBetween(400000, 2000000),
        ];
    }
}
