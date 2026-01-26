<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        // SETTING MIDTRANS (LANGSUNG DARI ENV)
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $orderId = 'ORDER-' . auth()->id() . '-' . now()->timestamp;

        // SIMPAN KE DB (STATUS PENDING)
        $payment = Payment::create([
            'user_id' => auth()->id(),
            'order_id' => $orderId,
            'month' => now()->format('Y-m'),
            'amount' => 350000, // bebas, bisa dari request
            'status' => 'pending',
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $payment->amount,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'snap_token' => $snapToken
        ]);
    }
}
