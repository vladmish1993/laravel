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
                    <i class="fa-solid fa fa-bell-o  icon-big"></i>
                    <div class="card-section-text">Notifications</div>
                </div>
            </div>

            <div class="row">
                @if($notifications->isNotEmpty())
                    @foreach($notifications as $notification)
                        <div class="col-lg-4 d-flex align-items-stretch">
                            <div class="card mb-4 @if($notification->status) notification-success @else notification-unsuccess @endif">
                                <div class="card-block">
                                    <h4 class="card-title">{{ $notification->job->title }}</h4>
                                    <div class="card-company text-muted font-weight-bold">{{ $notification->job->company }}</div>
                                    @if($notification->job->creator->profile->show_phone)
                                        <div class="text-muted">Contact phone: {{ $notification->job->creator->profile->phone }}</div>
                                    @endif
                                    <div class="card-salary pb-2 text-muted">£{{ $notification->job->salary }}</div>
                                    <div class="pb-2">
                                        {{ $notification->job->description }}
                                    </div>

                                    <div class="pb-2">
                                        @foreach($notification->job->skills as $jobSkill)
                                            <span class="badge badge-success">{{ $jobSkill->skills->name }}</span>
                                        @endforeach
                                    </div>

                                    <a href="/job/{{ $notification->job->id }}" class="card-link">Detail info</a>

                                    <hr>

                                    <div class="row pb-3">
                                        <div class="col-md-4 profile_titles">Employer</div>
                                        <div class="col-md-8">{{$notification->job->creator->first_name}} {{$notification->job->creator->last_name}}</div>
                                    </div>
                                    <div class="row pb-3">
                                        <div class="col-md-4 profile_titles">Comment from emloyer</div>
                                        <div class="col-md-8">{{$notification->comment}}</div>
                                    </div>

                                    <div class="col-md-4">
                                        <view-notification notification-id="{{ $notification->id }}"></view-notification>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div>There is nothing</div>
                @endif
            </div>

            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
