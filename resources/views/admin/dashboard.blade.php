@extends('layouts.admin')

@section('content')
<style>
    /* Dashboard card sederhana */
    .dashboard-card {
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        background-color: #fff;
        transition: 0.2s ease;
    }

    .dashboard-card:hover {
        box-shadow: 0 6px 14px rgba(0,0,0,0.08);
        transform: translateY(-2px);
    }

    .dashboard-title {
        font-size: 14px;
        color: #6b7280;
    }

    .dashboard-number {
        font-size: 26px;
        font-weight: 600;
        color: #111827;
    }
</style>

<h2 class="mb-3 fw-semibold">Dashboard</h2>

<div class="row g-3">

    <div class="col-md-6 col-xl-3">
        <div class="card dashboard-card p-3">
            <div class="dashboard-title">Users</div>
            <div class="dashboard-number">{{ $userCount ?? 0 }}</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card dashboard-card p-3">
            <div class="dashboard-title">Materials</div>
            <div class="dashboard-number">{{ $materialCount ?? 0 }}</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card dashboard-card p-3">
            <div class="dashboard-title">Active Admins</div>
            <div class="dashboard-number">{{ $adminCount ?? 0 }}</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card dashboard-card p-3">
            <div class="dashboard-title">Other Info</div>
            <div class="dashboard-number">—</div>
        </div>
    </div>

</div>
@endsection
