@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <div class="d-flex justify-content-between align-items-center p-0 mb-4">
                <div>
                    <h1>Hi, {{ Auth::user()->first_name.' '.Auth::user()->last_name }}</h1>
                </div>
                @can('update', Auth::user()->profile)
                    <div>
                        <a href="/member/{{Auth::user()->id}}">View Profile</a>
                    </div>
                @endcan
            </div>
        </div>

        <div>
            <div class="card-body">
                <div class="d-flex align-items-center card-section-header">
                    <i class="fa-solid fa-briefcase icon-big"></i>
                    <div class="card-section-text">My jobs</div>
                </div>

                @if($allowedToView)
                    <div class="row">
                        @if($jobs->isNotEmpty())
                            @foreach($jobs as $job)
                                <div class="col-lg-4 d-flex align-items-stretch">
                                    <div class="card mb-4">
                                        <div class="card-block">
                                            <h4 class="card-title">{{ $job->title }}</h4>

                                            <div class="card-company text-muted font-weight-bold">{{ $job->creator->profile->company_name }}</div>
                                            @if($job->creator->profile->show_phone)
                                                <div class="text-muted">Contact phone: {{ $job->creator->profile->phone }}</div>
                                            @endif
                                            <div class="card-salary pb-2 text-muted">£{{ $job->salary }}</div>
                                            <div class="card-text pb-2">
                                                {{ $job->description }}
                                            </div>

                                            <div class="pb-2">
                                                @foreach($job->skills as $jobSkill)
                                                    <span class="badge badge-success">{{ $jobSkill->skills->name }}</span>
                                                @endforeach
                                            </div>

                                            <a href="/job/{{ $job->id }}" class="card-link">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <a href="/job/create" class="w-25 btn btn-success">Add job</a>

                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            {{ $jobs->links() }}
                        </div>
                    </div>
                @else
                    <div class="h4 text-danger">Please complete your profile to be able to add the new job!</div>
                @endif

                <div class="d-flex align-items-center card-section-header pt-4">
                    <i class="fa-solid fa-check icon-big"></i>
                    <div class="card-section-text">Applications to your jobs</div>
                </div>

                @if($allowedToView)
                    <div class="row">
                        @if($jobs->isNotEmpty())
                            @foreach($jobs as $job)
                                @if($job->applications->count() > 0)
                                    @foreach($job->applications as $jobApplication)
                                        <div class="col-lg-4 d-flex align-items-stretch">
                                            <div class="card mb-4">
                                                <div class="card-block">
                                                    <h4 class="card-title"><a href="/job/{{ $job->id }}">{{ $job->title }}</a></h4>

                                                    <div class="card-company text-muted font-weight-bold">{{ $job->creator->profile->company_name }}</div>
                                                    @if($job->creator->profile->show_phone)
                                                        <div class="text-muted">Contact phone: {{ $job->creator->profile->phone }}</div>
                                                    @endif
                                                    <div class="card-salary pb-2 text-muted">£{{ $job->salary }}</div>
                                                    <div class="card-text pb-2">
                                                        {{ $job->description }}
                                                    </div>

                                                    <div class="pb-2">
                                                        @foreach($job->skills as $jobSkill)
                                                            <span class="badge badge-success">{{ $jobSkill->skills->name }}</span>
                                                        @endforeach
                                                    </div>

                                                    <hr>

                                                    <div class="row pb-3">
                                                        <div class="col-md-4 profile_titles">Candidate</div>
                                                        <div class="col-md-8">{{$jobApplication->user->first_name}} {{$jobApplication->user->last_name}}</div>
                                                    </div>
                                                    <div class="row pb-3">
                                                        <div class="col-md-4 profile_titles">Phone</div>
                                                        <div class="col-md-8">{{ $jobApplication->user->profile->phone}}</div>
                                                    </div>
                                                    <div class="row pb-3">
                                                        <div class="col-md-4 profile_titles">Cover Letter</div>
                                                        <div class="col-md-8">{{ $jobApplication->user->profile->cover_letter}}</div>
                                                    </div>
                                                    <div class="row pb-3">
                                                        <div class="col-md-4 profile_titles">CV</div>
                                                        <div class="col-md-8"><a
                                                                    href="/storage/{{ $jobApplication->user->profile->cv }}"
                                                                    target="_blank">Download</a></div>
                                                    </div>
                                                    <div class="row pb-3">
                                                        <div class="col-md-4 profile_titles">Skills</div>
                                                        <div class="col-md-8">
                                                            @foreach($jobApplication->user->profile->skills as $candidateSkill)
                                                                <span class="badge badge-success">{{ $candidateSkill->skills->name }}</span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <application-buttons application-id="{{ $jobApplication->id }}"></application-buttons>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        @else
                            <div>There is nothing</div>
                        @endif
                    </div>
                @else
                    <div class="h4 text-danger">Please complete your profile to be able to add the new job!</div>
                @endif
            </div>
        </div>
    </div>
@endsection
