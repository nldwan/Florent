@extends('layouts.admin')

@section('title', 'Laporan Pembayaran')

@section('content')

<style>
.page-title {
    font-weight: 600;
    letter-spacing: .3px;
}
.card {
    border-radius: 14px;
}
table th {
    font-size: 0.85rem;
    text-transform: uppercase;
    color: #6c757d;
}
table td {
    vertical-align: middle;
    font-size: 0.95rem;
}
.btn {
    border-radius: 8px;
}
.badge-status {
    font-size: 0.85rem;
    padding: 0.4em 0.6em;
    border-radius: 8px;
}
.btn-paid {
    background-color: #10b981;
    color: #fff;
}
.btn-pending {
    background-color: #f59e0b;
    color: #fff;
}
</style>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <h4 class="page-title mb-0">Report Payment</h4>
    <a href="{{ route('admin.payments.create') }}" class="btn btn-primary btn-sm ms-auto">
        <i class="bi bi-plus-lg"></i> Add Payment
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>No.</th>
                    <th>Nama Siswa</th>
                    <th>Bulan</th>
                    <th>Jumlah</th>
                    <th>Metode</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $payment->user->name }}</td>
                    <td>{{ $payment->month }}</td>
                    <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                    <td>{{ strtoupper($payment->method) }}</td>
                    <td>
                        <span class="badge-status 
                            @if($payment->status == 'paid') btn-paid
                            @elseif($payment->status == 'pending') btn-pending
                            @else bg-danger
                            @endif
                        ">
                            {{ strtoupper($payment->status) }}
                        </span>
                    </td>
                    <td>{{ $payment->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        Belum ada data pembayaran
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
