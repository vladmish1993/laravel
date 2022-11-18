<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //redirected to login
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        //get the authorizer user
        $user = auth()->user();
        $profile = $user->profile;

        //If user is employer
        if($user->is_employer)
        {
            //User can view jobs
            $allowedToView = false;
            if($profile->phone && $profile->company_name)
            {
                $allowedToView = true;
            }

            //Get Jobs by User
            $jobs = Job::where('created_by', $user->id)->latest()->paginate(6);
            return view('index_admin', compact('profile', 'allowedToView', 'jobs'));
        }
        else
        {
            //User can view jobs
            $allowedToView = false;
            if($profile->phone && $profile->cover_letter && $profile->cv)
            {
                $allowedToView = true;
            }

            //Get User skills
            $user_skills = [];
            if ($user->profile->skills) {
                foreach ($user->profile->skills as $user_skill) {
                    $user_skills[] = $user_skill->skills->id;
                }
            }

            //Get Jobs by User skills
            $jobs = Job::with('skills')->whereHas('skills', function ($query) use ($user_skills) {
                $query->whereIn('skills_id', $user_skills);
            })->latest()->paginate(6, ['*'], 'rec_jobs_page');

            //Get user applications
            $applications = $user->applied()->paginate(6, ['*'], 'applications_page');
            return view('index', compact('profile','allowedToView',  'jobs', 'applications'));
        }
    }
}