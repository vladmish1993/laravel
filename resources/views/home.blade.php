@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center">
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

        <div class="row card">
            <div class="card-body">
                <div class="d-flex align-items-center card-section-header">
                    <i class="fa-solid fa-briefcase icon-big"></i>
                    <div class="card-section-text">New recommended jobs</div>
                </div>

                <div class="row">
                    @if($profile->phone && $profile->cover_letter && $profile->cv)
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-block">
                                    <h4 class="card-title">Software Developer</h4>
                                    <div class="card-company text-muted font-weight-bold">Company name</div>
                                    <div class="card-salary pb-2 text-muted">£35000</div>
                                    <div class="card-text pb-2">Amazing opportunity to grow rapidly with a company!
                                    </div>
                                    <a href="#" class="card-link">Detail info</a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="h4 text-danger">Please complete your profile to see the recommended jobs!</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
