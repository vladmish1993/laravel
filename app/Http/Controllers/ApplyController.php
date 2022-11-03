<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Job;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Job $job)
    {
        return auth()->user()->applied()->toggle($job->id);
    }
}