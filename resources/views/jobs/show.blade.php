@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card col-md-9 p-3">
                <h4 class="card-title">{{ $job->title }}</h4>
                <div class="card-company text-muted font-weight-bold">{{ $job->company }}</div>
                <div class="card-salary pb-2 text-muted">£{{ $job->salary }}</div>
                <div class="pb-2">
                    {{ $job->description }}
                </div>

                <div class="col-md-4">
                    <button class="btn btn-primary ml-4 apply-button{{$applied ? ' disabled' : ''}}" data-job-id="{{ $job->id }}" data-apply="{{ $applied }}">{{$applied ? 'Already applied' : 'Apply'}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection