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
        if ($request->fraud_status === "accept") {
            $transaction_code   = $request->transaction_id;
            $status             = $request->transaction_status;
            $transaction_time   = $request->transaction_time;
            $transaction        = transaction::with('transaction_detail', 'shop')->where('transaction_code', $transaction_code)->firstOrFail();
            // return response()->json($transaction);
            if ($status === "settlement") {
                transaction::where('transaction_code', $transaction_code)->update([
                    'payment_status'    => strtoupper($status),
                    'status'            => 'PROCESSING',
                    'paid_date'         => $transaction_time
                ]);

                Mail::to($transaction->email)->send(new TransactionPaid($transaction));
            } else {
                transaction::where('transaction_code', $transaction_code)->update([
                    'payment_status'    => strtoupper($status),
                    'status'            => 'DONE',
                    'paid_date'         => NULL
                ]);
            }
        }
    }
}
