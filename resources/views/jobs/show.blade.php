@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card col-md-9 p-3">
                <h4 class="card-title">{{ $job->title }}</h4>
                <div class="card-company text-muted font-weight-bold">{{ $job->company }}</div>
                @if($job->creator->profile->show_phone)
                    <div class="text-muted">Contact phone: {{ $job->creator->profile->phone }}</div>
                @endif
                <div class="card-salary pb-2 text-muted">£{{ $job->salary }}</div>
                <div class="pb-2">
                    {{ $job->description }}
                </div>

                <div class="pb-2">
                    @foreach($job->skills as $jobSkill)
                        <span class="badge badge-success">{{ $jobSkill->skills->name }}</span>
                    @endforeach
                </div>

                @can('update', $job)
                    <div class="row pt-2">
                        <div class="col-md-3">
                            <a class="btn btn-success" href="/job/{{$job->id}}/edit">Edit job</a>
                        </div>

                        <form class="col-md-3" action="{{ route('job.destroy', $job->id) }}" method="POST">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button class="btn btn-danger">Delete job</button>
                        </form>
                    </div>
                @else
                    <div class="col-md-4">
                        <apply-button job-id="{{ $job->id }}" applied="{{ $applied }}"></apply-button>
                    </div>
                @endcan

                <div class="pt-2">
                    <a href="/" class="card-link">Back to job list</a>
                </div>
            </div>
        </div>
    </div>
@endsection