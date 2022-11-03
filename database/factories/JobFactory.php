<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\Skills;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->jobTitle(),
            'company' => fake()->company(),
            'salary' => fake()->numberBetween(35000, 50000),
            'description' => fake()->text(),
            'created_at' => now()
        ];
    }
}
