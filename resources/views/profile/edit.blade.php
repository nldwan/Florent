@extends('layouts.siswa')

@section('content')
<style>
    body {
        background-color: #f8fafc;
        font-family: "Poppins", sans-serif;
        color: #1f2937;
    }

    .profile-section {
        max-width: 900px;
        margin: 60px auto;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 40px 50px;
    }

    .profile-section h2 {
        font-weight: 700;
        color: #1e40af;
        border-bottom: 3px solid #3b82f6;
        display: inline-block;
        margin-bottom: 25px;
        padding-bottom: 5px;
    }

    .profile-card {
        margin-bottom: 50px;
    }

    form {
        margin-top: 20px;
    }

    label {
        font-weight: 600;
        color: #374151;
        margin-top: 15px;
        display: block;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        margin-top: 5px;
        transition: 0.2s;
    }

    input:focus {
        border-color: #3b82f6;
        outline: none;
        box-shadow: 0 0 5px rgba(59, 130, 246, 0.3);
    }

    button {
        background-color: #3b82f6;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 10px;
        margin-top: 15px;
        cursor: pointer;
        transition: 0.2s;
    }

    button:hover {
        background-color: #2563eb;
    }

    .delete-section {
        border-top: 2px dashed #d1d5db;
        padding-top: 20px;
    }

    .delete-section button {
        background-color: #ef4444;
    }

    .delete-section button:hover {
        background-color: #dc2626;
    }
</style>

<div class="profile-section">
    {{-- PROFILE INFORMATION --}}
    <div class="profile-card">
        @include('profile.partials.update-profile-information-form')
    </div>

    {{-- UPDATE PASSWORD --}}
    <div class="profile-card">
        @include('profile.partials.update-password-form')
    </div>

    <!-- {{-- DELETE ACCOUNT --}}
    <div class="profile-card delete-section">
        @include('profile.partials.delete-user-form')
    </div> -->
</div>
@endsection