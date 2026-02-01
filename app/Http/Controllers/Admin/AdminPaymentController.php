<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    public function index(Request $request)
    {
        $payments = Payment::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.payments', compact('payments'));
    }

    public function create()
    {
        return view('admin.payments_create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'month' => 'required',
            'amount' => 'required|numeric',
            'method' => 'required|in:cash,transfer',
        ]);

        // LOGIKA STATUS
        $status = $request->method === 'cash'
            ? 'paid'
            : 'pending';

        Payment::create([
            'user_id' => $request->user_id,
            'order_id' => strtoupper($request->method) . '-' . time(),
            'month' => $request->month,
            'amount' => $request->amount,
            'method' => $request->method,
            'status' => $status,
        ]);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Pembayaran berhasil disimpan');
    }
}
