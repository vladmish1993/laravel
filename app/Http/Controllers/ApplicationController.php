<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Job $job)
    {
        //Check if user allowed to update application
        $this->authorize('create', Application::class);

        $application = Application::create([
            'job_id' => $job->id,
            'user_id' => auth()->user()->id
        ]);

        return $application;
    }

    //Edit update
    public function update(Application $application)
    {
        //Check if user allowed to update application
        $this->authorize('update', $application);

         $data = request()->validate([
            'status' => 'required|boolean',
            'comment' => 'required|string',
        ]);

        $application = $application->update([
            'status' => $data['status'],
            'comment' => $data['comment'],
            'viewed' => false
        ]);

        return $application;
    }

    public function updateView(Application $application)
    {
        $data = [
            'viewed' => true
        ];
        return $application->update($data);
    }
}
