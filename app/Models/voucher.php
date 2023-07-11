<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voucher extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function shop()
    {
        return $this->belongsTo(shop::class);
    }

    public function jumlah_penggunaan($voucher_id)
    {
        return voucher_log::where('voucher_logs.voucher_id', $voucher_id)
            ->whereNotIn('transactions.payment_status', ['EXPIRED', 'FAILED'])
            ->join('vouchers', 'vouchers.id', '=', 'voucher_logs.voucher_id')
            ->join('transactions', 'transactions.id', '=', 'voucher_logs.transaction_id')->count();
    }
}
