<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Job;
use App\Models\Skills;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobSkills>
 */
class JobSkillsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'job_id' => Job::factory(),
            'skills_id' => Skills::all()->unique()->random()
        ];
    }
}
