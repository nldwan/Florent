@extends('layouts.admin')
@section('title', 'Add Siswa')

@section('content')

<style>
    .form-card {
        max-width: 820px;
        border-radius: 18px;
    }

    .form-card .card-header {
        background: transparent;
        border-bottom: 1px solid #f0f0f0;
        padding: 24px;
    }

    .form-card .card-body {
        padding: 28px;
    }

    .form-card label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #6b7280;
        margin-bottom: 6px;
    }

    .form-card .form-control {
        border-radius: 10px;
        font-size: 0.9rem;
        padding: 10px 12px;
    }
</style>

<div class="card shadow-sm border-0 mx-auto form-card">
    <div class="card-header">
        <h4 class="mb-1 fw-semibold">Add Siswa</h4>
        <p class="text-muted mb-0" style="font-size: 0.90rem">
            Fill the form below to create a new siswa account.
        </p>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.siswa.store') }}">
            @csrf

            <div class="mb-3">
                <label>Course</label>
                <select name="course_id" class="form-control" required>
                    <option value="" disabled selected>-- Pilih Course --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name"
                       class="form-control"
                       placeholder="Full name"
                       required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email"
                       class="form-control"
                       placeholder="example@email.com"
                       required>
            </div>

            <div class="mb-3">
                <label>Phone Number</label>
                <input type="text" name="no_hp"
                       class="form-control"
                       placeholder="08xxxxxxxxxx"
                       required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password"
                       class="form-control"
                       placeholder="Minimum 6 characters"
                       required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    Save
                </button>
                <a href="{{ route('admin.users.siswa') }}" class="btn btn-secondary px-4">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
