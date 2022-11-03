@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 d-flex justify-content-between align-items-center">
                <div>
                    <h1>{{ $user->first_name.' '.$user->last_name }}'s Profile</h1>
                </div>
                @can('update', $user->profile)
                    <div>
                        <a href="/member/{{ $user->id }}/edit">Edit Profile</a>
                    </div>
                @endcan

                @if($user->is_admin)
                    <div>
                        <a href="/job/create">Add Vacancy</a>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="card col-md-9">
                <div class="card-body">
                    <div class="row pb-3">
                        <div class="col-md-4 profile_titles">Phone</div>
                        <div class="col-md-8">{{ $user->profile->phone ?? 'Not specified' }}</div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-md-4 profile_titles">Cover Letter</div>
                        <div class="col-md-8">{{ $user->profile->cover_letter ?? 'Not specified' }}</div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-md-4 profile_titles">CV</div>
                        <div class="col-md-8">
                            @if($user->profile->cv)
                                <a href="/storage/{{ $user->profile->cv }}" target="_blank">Download</a>
                            @else
                                Not specified
                            @endif
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-md-4 profile_titles">Skills</div>
                        <div class="col-md-8">
                            @if($user->user_skills_str)
                                {{ $user->user_skills_str }}
                            @else
                                Not specified
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection