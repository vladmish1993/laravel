<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\ProfileSkills;
use App\Models\Job;
use App\Models\JobSkills;

class DatabaseSeeder extends Seeder
{
    //Prevent events to not create crear profile with new user
    use WithoutModelEvents;

    /**
     * Seed the database.
     * php artisan db:seed
     */
    public function run()
    {
        //Create User with Profile and profile skills
        User::factory(5)->has(
            Profile::factory(1)->has(
                ProfileSkills::factory(3)
            ))->create();

        //Create Job with skills
        Job::factory(10)->hasJobSkill(3)->create();
    }
}