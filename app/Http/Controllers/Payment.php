<?php

namespace App\Http\Controllers;

use App\Mail\TransactionPaid;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Payment extends Controller
{
    public function index(Request $request)
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');
        $notif = new \Midtrans\Notification();
        if ($notif->fraud_status === "accept") {
            $receipt_number     = $notif->order_id;
            $status             = $notif->transaction_status;
            $transaction_time   = $notif->settlement_time;
            $transaction        = transaction::with('transaction_detail', 'shop')->where('receipt_number', $receipt_number)->firstOrFail();
            if ($status === "settlement") {
                transaction::where('receipt_number', $receipt_number)->update([
                    'payment_status'    => strtoupper($status),
                    'status'            => 'PROCESSING',
                    'paid_date'         => $transaction_time
                ]);

                Mail::to($transaction->email)->send(new TransactionPaid($transaction));

                return response()->json(
                    [
                        'status'        => 'Success',
                        'message'       => 'Pembayaran diterima',
                    ]
                );
            } else {
                if ($status === "failed")
                    transaction::where('receipt_number', $receipt_number)->update([
                        'payment_status'    => strtoupper($status),
                        'status'            => 'FAILED',
                        'paid_date'         => NULL
                    ]);
                if ($status === "expire")
                    transaction::where('receipt_number', $receipt_number)->update([
                        'payment_status'    => strtoupper($status),
                        'status'            => 'EXPIRE',
                        'paid_date'         => NULL
                    ]);

                return response()->json(
                    [
                        'status'        => 'Success',
                        'message'       => 'Status pembayaran updated',
                    ]
                );
            }
        }
    }
}
