<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('MIDTRANS WEBHOOK MASUK', $request->all());

        $payment = Payment::where('order_id', $request->order_id)->first();

        if (!$payment) {
            Log::error('PAYMENT NOT FOUND', [
                'order_id' => $request->order_id
            ]);
            return response()->json(['error' => 'not found'], 404);
        }

        if ($request->transaction_status === 'settlement') {
            $payment->status = 'paid';
        }

        $payment->save();

        return response()->json(['ok' => true]);
    }
}
