@extends('layouts.admin')
@section('title', 'Add Grade')

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
.section-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: #374151;
    margin-top: 1.5rem;
}
</style>

<div class="card shadow-sm border-0 mx-auto form-card">
    <div class="card-header bg-transparent">
        <h4 class="fw-semibold mb-1">Add Student Grade</h4>
        <p class="text-muted mb-0">Input student assessment result</p>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.grades.store') }}">
            @csrf

            {{-- STUDENT --}}
            <div class="mb-3">
                <label>Student</label>
                <select name="user_id" class="form-control" required>
                    <option value="">-- Select Student --</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">
                            {{ $student->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- COURSE --}}
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

            {{-- LEVEL --}}
            <div class="mb-3">
                <label>Level</label>
                <select name="level_id" class="form-control" required>
                    <option value="">-- Select Level --</option>
                    @foreach($levels as $level)
                        <option value="{{ $level->id }}">
                            {{ $level->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- SUBLEVEL --}}
            <div class="mb-4">
                <label>Sublevel</label>
                <select name="sublevel_id" class="form-control" required>
                    <option value="">-- Select Sublevel --</option>
                    @foreach($sublevels as $sublevel)
                        <option value="{{ $sublevel->id }}">
                            {{ $sublevel->order }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="section-title">Writing</div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label>Grammar</label>
                    <input type="text" name="writing_grammar" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Translation</label>
                    <input type="text" name="writing_translation" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Composition</label>
                    <input type="text" name="writing_composition" class="form-control">
                </div>
            </div>

            <div class="section-title">Reading</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label>Comprehension</label>
                    <input type="text" name="reading_compre" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Vocabulary</label>
                    <input type="text" name="reading_vocabulary" class="form-control">
                </div>
            </div>

            <div class="section-title">Listening</div>
            <div class="mb-3">
                <label>Listening Comprehension</label>
                <input type="text" name="listening_compre" class="form-control">
            </div>

            <div class="section-title">Speaking</div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label>Pronouncing</label>
                    <input type="text" name="speaking_pronouncing" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Intonation</label>
                    <input type="text" name="speaking_intonation" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Fluency</label>
                    <input type="text" name="speaking_fluency" class="form-control">
                </div>
            </div>

            <div class="mb-4 mt-3">
                <label>Notes</label>
                <textarea name="notes" rows="3" class="form-control"></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Save</button>
                <a href="{{ route('admin.grades.index') }}"
                   class="btn btn-secondary px-4">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>

@endsection
