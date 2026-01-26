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
}
