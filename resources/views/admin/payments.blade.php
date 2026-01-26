@extends('layouts.admin')

@section('title', 'Laporan Pembayaran')

@section('content')
<div class="container">
    <h4 class="mb-4">Laporan Pembayaran Siswa</h4>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
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
                        <span class="badge 
                            @if($payment->status == 'paid') bg-success
                            @elseif($payment->status == 'pending') bg-warning
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
                    <td colspan="6" class="text-center">Belum ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
