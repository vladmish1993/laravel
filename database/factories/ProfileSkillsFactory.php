<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'phone' => fake()->phoneNumber(),
            'cover_letter' => fake()->text(),
            'cv' => 'profile/2HOpNN96A0lexXbyGMMuVxtWWbJnaeugk6S2f8IJ.pdf"'
        ];
    }
}
