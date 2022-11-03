@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Profile</div>

                    <div class="card-body">
                        <form action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data" method="post">
                            @csrf
                            @method('PATCH')

                            <div class="row mb-3">
                                <label for="phone" class="col-md-4 col-form-label text-md-end">Phone</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $user->profile->phone }}" required autocomplete="phone" placeholder="07397101091" autofocus>

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="cover_letter" class="col-md-4 col-form-label text-md-end">Cover Letter</label>

                                <div class="col-md-6">
                                    <textarea id="cover_letter" name="cover_letter" type="text" class="form-control @error('cover_letter') is-invalid @enderror" rows="4" cols="50" required>{{ old('cover_letter') ?? $user->profile->cover_letter }}</textarea>

                                    @error('cover_letter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">CV (only PDF accepted)</label>

                                <div class="col-md-6">
                                    <input type="file" class="form-control @error('cv') is-invalid @enderror" id="cv" name="cv">

                                    @error('cv')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="skills[]" class="col-md-4 col-form-label text-md-end">Skills</label>

                                <div class="col-md-6">
                                    <select id="skills[]" name="skills[]" type="text" class="form-control @error('skills') is-invalid @enderror" multiple required>
                                        @foreach ($available_skills as $skill)
                                            <option value="{{ $skill->id }}"
                                                @foreach ($user->profile->skills as $user_skill)
                                                    @if ($user_skill->skills_id == $skill->id)
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
                                        Save Profile
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
