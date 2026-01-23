@extends('layouts.admin')
@section('title', 'Add Material')

@section('content')

<style>
.form-card {
    max-width: 900px;
    border-radius: 18px;
}
.form-card label {
    font-size: 0.85rem;
    font-weight: 500;
    color: #6b7280;
}
.form-card .form-control {
    border-radius: 10px;
    font-size: 0.9rem;
}
</style>

<div class="card shadow-sm border-0 mx-auto form-card">
    <div class="card-header bg-transparent">
        <h4 class="fw-semibold mb-1">Add Material</h4>
        <p class="text-muted mb-0">Upload new learning material</p>
    </div>

    <div class="card-body">
        <form method="POST"
              action="{{ route('admin.materials.store') }}"
              enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Course</label>
                <select name="course_id" class="form-control" required>
                    <option value="">-- Select Course --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Level</label>
                <select name="level_id" class="form-control" required>
                    @foreach($levels as $level)
                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Sublevel</label>
                <select name="sublevel_id" class="form-control" required>
                    @foreach($sublevels as $sublevel)
                        <option value="{{ $sublevel->id }}">
                            {{ $sublevel->order }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Material Title</label>
                <input type="text"
                    name="title"
                    class="form-control"
                    required>
            </div>

            <div class="mb-4">
                <label>PDF File</label>
                <input type="file"
                    name="file"
                    class="form-control"
                    accept="application/pdf"
                    required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Save</button>
                <a href="{{ route('admin.materials.index') }}"
                   class="btn btn-secondary px-4">
                   Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
