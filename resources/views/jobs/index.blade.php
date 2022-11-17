@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
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

        <div class="row">
            <div class="card-body">
                <div class="d-flex align-items-center card-section-header">
                    <i class="fa-solid fa-briefcase icon-big"></i>
                    <div class="card-section-text">New recommended jobs</div>
                </div>

                <div class="row">
                    @if($profile->phone && $profile->cover_letter && $profile->cv)
                        @foreach($jobs as $job)
                            <div class="col-lg-4 d-flex align-items-stretch">
                                <div class="card mb-4">
                                    <div class="card-block">
                                        <h4 class="card-title">{{ $job->title }}</h4>
                                        <div class="card-company text-muted font-weight-bold">{{ $job->company }}</div>
                                        <div class="card-salary pb-2 text-muted">£{{ $job->salary }}</div>
                                        <div class="card-text pb-2">
                                            {{ $job->description }}
                                        </div>

                                        <div class="pb-2">
                                            @foreach($job->skills as $jobSkill)
                                                <span class="badge badge-success">{{ $jobSkill->skills->name }}</span>
                                            @endforeach
                                        </div>

                                        <a href="/job/{{ $job->id }}" class="card-link">Detail info</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="h4 text-danger">Please complete your profile to see the recommended jobs!</div>
                    @endif
                </div>

                @if($profile->phone && $profile->cover_letter && $profile->cv)
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            {{ $jobs->links() }}
                        </div>
                    </div>

                    <div class="d-flex align-items-center card-section-header pt-4">
                        <i class="fa-solid fa-briefcase icon-big"></i>
                        <div class="card-section-text">Your applications</div>
                    </div>

                    <div class="row">
                        @foreach($applications as $application)
                            <div class="col-lg-4 d-flex align-items-stretch">
                                <div class="card mb-4">
                                    <div class="card-block">
                                        <h4 class="card-title">{{ $application->title }}</h4>
                                        <div class="card-company text-muted font-weight-bold">{{ $application->company }}</div>
                                        <div class="card-salary pb-2 text-muted">£{{ $application->salary }}</div>
                                        <div class="card-text pb-2">
                                            {{ $application->description }}
                                        </div>
                                        <a href="/job/{{ $application->id }}" class="card-link">Detail info</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
