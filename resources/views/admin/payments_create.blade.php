@extends('layouts.admin')
@section('title', 'Tambah Pembayaran')

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
        <h4 class="fw-semibold mb-1">Tambah Pembayaran</h4>
        <p class="text-muted mb-0">Input pembayaran siswa (cash / transfer)</p>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.payments.store') }}">
            @csrf

            <div class="mb-3">
                <label>Siswa</label>
                <select name="user_id" class="form-control" required>
                    <option value="">-- Pilih Siswa --</option>
                    @foreach(\App\Models\User::where('role','siswa')->get() as $siswa)
                        <option value="{{ $siswa->id }}">
                            {{ $siswa->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Bulan</label>
                <input type="month" name="month" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Jumlah</label>
                <input type="number"
                       name="amount"
                       class="form-control"
                       value="350000"
                       required>
            </div>

            <div class="mb-4">
                <label>Metode Pembayaran</label>
                <select name="method" class="form-control" required>
                    <option value="cash">Cash</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    Save
                </button>
                <a href="{{ route('admin.payments.index') }}"
                   class="btn btn-secondary px-4">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection