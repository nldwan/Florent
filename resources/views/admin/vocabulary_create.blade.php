@extends('layouts.admin')
@section('title', 'Add Vocabulary')

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
        <h4 class="mb-1 fw-semibold">Add Vocabulary</h4>
        <p class="text-muted mb-0" style="font-size: 0.90rem">
            Fill the form below to create a new vocabulary.
        </p>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.vocabulary.store') }}">
            @csrf

            <div class="mb-3">
                <label>Verb 1</label>
                <input type="text" name="verb1"
                       class="form-control"
                       placeholder="First verb"
                       required>
            </div>

            <div class="mb-3">
                <label>Verb 2</label>
                <input type="text" name="verb2"
                       class="form-control"
                       placeholder="Second verb"
                       required>
            </div>

            <div class="mb-3">
                <label>Verb 3</label>
                <input type="text" name="verb3"
                       class="form-control"
                       placeholder="Third verb"
                       required>
            </div>

            <div class="mb-4">
                <label>Meaning</label>
                <textarea name="meaning" rows="4" class="form-control" placeholder="Meaning of the verbs" required></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    Save
                </button>
                <a href="{{ route('admin.vocabulary.index') }}" class="btn btn-secondary px-4">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
