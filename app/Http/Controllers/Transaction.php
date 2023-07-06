<?php

namespace App\Http\Controllers;

use App\Models\shop;
use App\Models\transaction as ModelsTransaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Transaction extends Controller
{
    public function index()
    {
        $this->data['title']        = 'Daftar Transaksi';
        $this->data['status']       = get_enum_values('transactions', 'status');
        $this->data['script']       = 'merchant.script.transaction';
        return view('merchant.transaction', $this->data);
    }

    public function show(Request $request)
    {
        $shop           = shop::where('user_id', auth()->user()->id)->firstOrFail();
        $query          = ModelsTransaction::where('shop_id', $shop->id);

        return DataTables::of($query)
            ->addColumn('action', function ($query) {
                return '
                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                    <a href="' . route('transaction-detail', ['id' => $query->id]) . '" class="btn btn-outline-primary"><i class="fa-solid fa-eye"></i></a>
                </div>
            ';
            })
            ->addColumn('statusbadge', function ($query) {
                $badge = 'badge-success';
                if (in_array($query->status, ['PAYMENT']))
                    $badge = "badge-primary";
                else if (in_array($query->status, ['PROCESSING']))
                    $badge = "badge-info";
                else if (in_array($query->status, ['SHIPPING']))
                    $badge = "badge-warning";
                return '<span class="badge ' . $badge . '">' . $query->status . '</span>';
            })
            ->addColumn('receiver', function ($query) {
                return $query->name . '
                            <br>
                            <a href="mailto:' . $query->email . '">' . $query->email . '</a>';
            })
            ->addColumn('paymentstatusbadge', function ($query) {
                $badge = 'badge-success';
                if (in_array($query->payment_status, ['PENDING']))
                    $badge = "badge-primary";
                else if (in_array($query->payment_status, ['EXPIRED', 'FAILED']))
                    $badge = "badge-danger";
                return '<span class="badge ' . $badge . '">' . $query->payment_status . '</span>';
            })
            ->editColumn('total', function ($query) {
                return currencyIDR($query->total);
            })
            ->editColumn('shipping_method', function ($query) {
                return strtoupper($query->shipping_method);
            })
            ->editColumn('paid_date', function ($query) {
                if ($query->paid_date)
                    return parseTanggal($query->paid_date);
                return "";
            })
            ->editColumn('created_at', function ($query) {
                return parseTanggal($query->created_at);
            })
            ->filter(function ($query) use ($request) {
                $this->YajraFilterValue($request->filterValue, $query, "status");
                $this->YajraColumnSearch(
                    $query,
                    ['receipt_number'],
                    $request->search
                );
            })
            ->rawColumns(['action', 'statusbadge', 'receiver', 'paymentstatusbadge'])
            ->removeColumn(['id', 'member_id', 'shop_id', 'transaction_code', 'payment_url'])
            ->make();
    }

    public function detail($id)
    {
        $shop                       = shop::where('user_id', auth()->user()->id)->firstOrFail();
        $this->data['transaction']  = ModelsTransaction::select('transactions.*', 'vouchers.code', 'payment_methods.icon_url')->with('transaction_detail')
            ->where('transactions.id', $id)->where('transactions.shop_id', $shop->id)
            ->leftJoin('voucher_logs', 'voucher_logs.transaction_id', '=', 'transactions.id')
            ->leftJoin('vouchers', 'vouchers.id', '=', 'voucher_logs.voucher_id')
            ->join('payment_methods', 'payment_methods.code', '=', 'transactions.payment_channel')
            ->firstOrFail();

        $this->data['title']        = 'Detail Transaksi ' . $this->data['transaction']->receipt_number;

        // $this->data['script']       = 'merchant.script.transaction';
        return view('merchant.transaction_detail', $this->data);
    }
}
