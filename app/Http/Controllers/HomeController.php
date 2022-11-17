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
            //Get Jobs by User
            $jobs = Job::where('created_by', $user->id)->latest()->paginate(6);
            return view('index_admin', compact('profile', 'jobs'));
        }
        else
        {
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
            })->latest()->paginate(6);

            //Get user applications
            $applications = $user->applied;
            return view('index', compact('profile', 'jobs', 'applications'));
        }
    }
}