@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add vacancy</div>

                    <div class="card-body">
                        <form action="{{ route('job.update', $job->id) }}" enctype="multipart/form-data" method="post">
                            @csrf
                            @method('PATCH')

                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $job->title }}" required autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="salary" class="col-md-4 col-form-label text-md-end">Salary</label>

                                <div class="col-md-6">
                                    <input id="salary" type="number" class="form-control @error('salary') is-invalid @enderror" name="salary" value="{{ old('salary') ?? $job->salary }}" required autofocus>

                                    @error('salary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>

                                <div class="col-md-6">
                                    <textarea id="description" name="description" type="text" class="form-control @error('description') is-invalid @enderror" rows="4" cols="50" required>{{ old('description') ?? $job->description }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="skills[]" class="col-md-4 col-form-label text-md-end">Required Skills</label>

                                <div class="col-md-6">
                                    <select id="skills[]" name="skills[]" class="form-control @error('skills') is-invalid @enderror" multiple required>
                                        @foreach ($available_skills as $skill)
                                            <option value="{{ $skill->id }}"
                                            @foreach ($job->skills as $job_skill)
                                                @if ($job_skill->skills_id == $skill->id)
                                                    {{'selected="selected"'}}
                                                        @endif
                                                    @endforeach>
                                                {{ $skill->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('skills')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Job
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="pt-2">
                            <a href="/" class="card-link">Back to job list</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
