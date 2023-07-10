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
        $this->data['title']        = 'Daftar Voucher';
        $this->data['script']       = 'merchant.script.voucher';
        return view('merchant.voucher', $this->data);
    }

    public function add()
    {
        $this->data['title']        = 'Tambah Vouchers';
        $this->data['action']       = route('store-voucher');
        $this->data['back']         = route('voucher');

        $forms = [
            array('code', 'text', 'Kode'),
            array('nominal_discount', 'number', 'Nominal Diskon'),
            array('min_purchase', 'number', 'Minimal Pembelian'),
            array('valid_date', 'daterange', 'Tanggal Berlaku'),
        ];
        $this->data['forms']        = $forms;

        return view('layout.admin.add', $this->data);
    }

    /**
     * show
     *
     * @param  mixed $voucher
     * @return void
     */
    public function show(Request $request)
    {
        $shop           = shop::where('user_id', auth()->user()->id)->firstOrFail();
        $query          = ModelsVoucher::where('shop_id', $shop->id);

        return DataTables::of($query)
            ->addColumn('action', function ($query) {
                return '
                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                        <a href="' . route('voucher-detail', ['id' => $query->id]) . '" class="btn btn-outline-primary"><i class="fa-solid fa-eye"></i></a>
                    </div>
                ';
            })
            ->addColumn('tanggal_berlaku', function ($query) {
                return parseTanggal($query->valid_from) . " s/d " . parseTanggal($query->valid_until);
            })
            ->addColumn('jumlah_penggunaan', function ($query) {
                return $query->jumlah_penggunaan($query->id);
            })
            ->editColumn('discount', function ($query) {
                return currencyIDR($query->discount);
            })
            ->filter(function ($query) use ($request) {
                $this->YajraColumnSearch(
                    $query,
                    ['vouchers.code'],
                    $request->search
                );
            })
            ->rawColumns(['action'])
            ->removeColumn(['id'])
            ->make(true);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data       = $request->validate([
            'code'              => ['alpha_num', 'required', 'min:5', 'max:15', 'unique:vouchers,code'],
            'nominal_discount'  => ['required'],
            'min_purchase'      => ['required', 'gte:nominal_discount'],
            'valid_date'        => ['required']
        ]);


        $shop           = shop::where('user_id', auth()->user()->id)->firstOrFail();

        $daterange      = explode(" s/d ", $request->valid_date);
        ModelsVoucher::create(
            [
                'shop_id'       => $shop->id,
                'code'          => $request->code,
                'discount'      => $request->nominal_discount,
                'min_purchase'  => $request->min_purchase,
                'valid_from'    => $daterange[0],
                'valid_until'   => $daterange[1],
            ]
        );

        return redirect()->route('add-voucher')->with('success', 'Berhasil menambahkan data');
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
