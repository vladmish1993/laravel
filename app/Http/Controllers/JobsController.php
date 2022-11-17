<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Skills;

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Create page
    public function create()
    {
        //Check if user allowed to create job
        $this->authorize('create', Job::class);

        //Select all skills
        $available_skills = [];
        $skills = Skills::all();
        foreach ($skills as $skill) {
            $available_skills[] = $skill;
        }

        return view('jobs.create', compact('available_skills'));
    }

    //Create save
    public function store()
    {
        //Check if user allowed to create job
        $this->authorize('create', Job::class);

        $data = request()->validate([
            'title' => 'required|string|min:5|max:255',
            'salary' => 'required|integer',
            'description' => 'required|string|min:10|max:5000',
            'skills' => ''
        ]);

        $job = Job::create([
            'title' => $data['title'],
            'salary' => $data['salary'],
            'description' => $data['description']
        ]);

        //save skills
        if (!empty($data['skills'])) {
            foreach ($data['skills'] as $skill_id) {
                $job->skills()->create([
                    'job_id' => $job->id,
                    'skills_id' => $skill_id,
                ]);
            }
        }

        return redirect('/')->with('flash_message_success', 'Job created!');
    }

    //Edit page
    public function edit(Job $job)
    {
        //Check if user allowed to update job
        $this->authorize('update', $job);

        //Select all skills
        $available_skills = [];
        $skills = Skills::all();
        foreach ($skills as $skill) {
            $available_skills[] = $skill;
        }

        return view('jobs.edit', compact('job', 'available_skills'));
    }

    //Edit update
    public function update(Job $job)
    {
        //Check if user allowed to update job
        $this->authorize('update', $job);

        $data = request()->validate([
            'title' => 'required|string|min:5|max:255',
            'salary' => 'required|integer',
            'description' => 'required|string|min:10|max:5000',
            'skills' => ''
        ]);

        $skills = $data['skills'];
        unset($data['skills']);

        $job->update($data);

        //save skills
        if (!empty($skills)) {

            //Clear existing skills
            $job->skills()->delete();

            foreach ($skills as $skill_id) {
                $job->skills()->create([
                    'job_id' => $job->id,
                    'skills_id' => $skill_id,
                ]);
            }
        }

        return redirect("/job/" . $job->id)->with('flash_message_success', 'Job updated!');
    }

    //Show detail
    public function show(Job $job)
    {
        //User can see only own jobs
        $this->authorize('view', $job);

        //Gathering job skills in string
        if ($job->skills) {
            $job_skills = [];
            foreach ($job->skills as $job_skill) {
                $job_skills[] = $job_skill->skills->name;
            }
            $job_skill_str = implode(', ', $job_skills);
            $job['job_skills_str'] = $job_skill_str;
        }

        $applied = auth()->user()->applied->contains($job->id);
        return view('jobs.show', compact('job', 'applied'));
    }

    //Delete
    public function destroy($id)
    {
        //User can delete only own jobs
        $this->authorize('delete', Job::class);

        Job::destroy($id);
        return redirect('/')->with('flash_message_warning', 'Job deleted!');
    }
}