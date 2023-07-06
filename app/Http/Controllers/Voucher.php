<?php

namespace App\Http\Controllers;

use App\Models\shop;
use App\Models\voucher as ModelsVoucher;
use App\Models\voucher_log;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class Voucher extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show(voucher $voucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, voucher $voucher)
    {
        //
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function voucher_log()
    {
        $this->data['title']        = 'Riwayat Penggunaan Voucher/Kupon';
        $this->data['script']       = 'merchant.script.voucher_logs';
        return view('merchant.voucher_logs', $this->data);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show_log(Request $request)
    {
        $shop           = shop::where('user_id', auth()->user()->id)->firstOrFail();
        $query          = voucher_log::select(
            'voucher_logs.shop_id',
            'voucher_logs.created_at',
            'vouchers.code',
            'vouchers.discount',
            'transactions.receipt_number'
        )
            ->where('voucher_logs.shop_id', $shop->id)
            ->whereNotIn('transactions.payment_status', ['EXPIRED', 'FAILED'])
            ->join('vouchers', 'vouchers.id', '=', 'voucher_logs.voucher_id')
            ->join('transactions', 'transactions.id', '=', 'voucher_logs.transaction_id');

        return DataTables::of($query)
            ->editColumn('created_at', function ($query) {
                return parseTanggal($query->created_at);
            })
            ->editColumn('discount', function ($query) {
                return currencyIDR($query->discount);
            })
            ->make(true);
    }
}
