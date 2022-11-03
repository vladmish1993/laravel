<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Profile;
use App\Models\User;
use App\Models\Skills;
use App\Models\JobSkills;

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //get the authorizer user
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $profile = $user->profile;

        //Get User skills
        $user_skills = [];
        foreach ($user->profile->skills as $user_skill)
        {
            $user_skills[] = $user_skill->skills->id;
        }

        //Get Jobs Id by skills
        //$jobs = Job::where('skills', $user_skills)->paginate(6);
        $jobs = Job::where('id', '>', 0)->latest()->paginate(6);


        //Get user applications
        $applications = $user->applied;
        return view('jobs.index', compact('profile', 'jobs', 'applications'));
    }

    public function create()
    {
        //Select all skills
        $available_skills = [];
        $skills = Skills::all();
        foreach ($skills as $skill) {
            $available_skills[] = $skill;
        }

        return view('jobs.create', compact('available_skills'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required|string|min:5|max:255',
            'company' => 'required|string|max:5000',
            'salary' => 'required|integer',
            'description' => 'required|string|min:10|max:5000',
            'skills' => ''
        ]);

        $skills = $data['skills'];
        unset($data['skills']);

        $job_id = Job::create([
            'title' => $data['title'],
            'company' => $data['company'],
            'salary' => $data['salary'],
            'description' => $data['description']
        ]);

        //save skills
        if(!empty($skills))
        {
            foreach ($skills as $skill_id)
            {
                JobSkills::create([
                    'job_id' => $job_id,
                    'skills_id' => $skill_id,
                ]);
            }
        }

        return redirect('/member/' . auth()->user()->id);
    }

    public function show(Job $job)
    {
        //Check if all nesessary fields are filled
        if(auth()->user()->profile->phone && auth()->user()->profile->cover_letter && auth()->user()->profile->cv)
        {
            //Gathering job skills in string
            if($job->skills)
            {
                $job_skills = [];
                foreach ($job->skills as $job_skill)
                {
                    $job_skills[] = $job_skill->skills->name;
                }
                $job_skill_str = implode(', ', $job_skills);
                $job['job_skills_str'] = $job_skill_str;
            }

            $applied = auth()->user()->applied->contains($job->id);
            return view('jobs.show', compact('job', 'applied'));
        }
        else
        {
            return redirect('/member/' . auth()->user()->id);
        }
    }
}