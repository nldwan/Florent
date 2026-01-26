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
    font-weight: 600;
}
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="page-title">Laporan Pembayaran Siswa</h4>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama Siswa</th>
                    <th>Bulan</th>
                    <th>Jumlah</th>
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
                    <td>
                        <span class="badge-status 
                            @if($payment->status == 'paid') bg-success
                            @elseif($payment->status == 'pending') bg-warning text-dark
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
