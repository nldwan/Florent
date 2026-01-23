@extends('layouts.admin')
@section('title', 'Add Conversation')

@section('content')

<style>
.form-card {
    max-width: 800px;
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
        <h4 class="fw-semibold mb-1">Add Conversation</h4>
        <p class="text-muted mb-0">Input conversation video</p>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.conversations.store') }}">
            @csrf

            <div class="mb-3">
                <label>Course</label>
                <select name="course_id" class="form-control" required>
                    <option value="">-- Select Course --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Title</label>
                <input type="text"
                       name="title"
                       class="form-control"
                       placeholder="Example: Daily Conversation at School"
                       required>
            </div>

            <div class="mb-4">
                <label>YouTube Link</label>
                <input type="text"
                       name="video"
                       class="form-control"
                       placeholder="https://www.youtube.com/watch?v=..."
                       required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Save</button>
                <a href="{{ route('admin.conversations.index') }}"
                   class="btn btn-secondary px-4">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>

@endsection
