<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Models\shop;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class ReportSales extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title']        = "Laporan Penjualan Pertahun";
        $this->data['script']       = "";
        $this->data['script']       = 'merchant.script.report';
        return view('merchant.report', $this->data);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $shop           = shop::where('user_id', auth()->user()->id)->firstOrFail();

        $query          = transaction::select(DB::raw("
                                SUM( IF( MONTH(created_at) = 1, total, 0) ) AS jan,
                                SUM( IF( MONTH(created_at) = 2, total, 0) ) AS feb,
                                SUM( IF( MONTH(created_at) = 3, total, 0) ) AS mar,
                                SUM( IF( MONTH(created_at) = 4, total, 0) ) AS apr,
                                SUM( IF( MONTH(created_at) = 5, total, 0) ) AS mei,
                                SUM( IF( MONTH(created_at) = 6, total, 0) ) AS jun,
                                SUM( IF( MONTH(created_at) = 7, total, 0) ) AS jul,
                                SUM( IF( MONTH(created_at) = 8, total, 0) ) AS agt,
                                SUM( IF( MONTH(created_at) = 9, total, 0) ) AS sep,
                                SUM( IF( MONTH(created_at) = 10, total, 0) ) AS okt,
                                SUM( IF( MONTH(created_at) = 11, total, 0) ) AS nov,
                                SUM( IF( MONTH(created_at) = 12, total, 0) ) AS des,
                                YEAR(created_at) AS tahun "))
            ->whereIn('status', ["SHIPPED", "DONE"])
            ->where('shop_id', $shop->id)
            ->groupBy(DB::raw("YEAR(created_at)"));

        return DataTables::of($query)
            ->editColumn('jan', function ($query) {
                return currencyIDR($query->jan);
            })
            ->editColumn('feb', function ($query) {
                return currencyIDR($query->feb);
            })
            ->editColumn('mar', function ($query) {
                return currencyIDR($query->mar);
            })
            ->editColumn('apr', function ($query) {
                return currencyIDR($query->apr);
            })
            ->editColumn('mei', function ($query) {
                return currencyIDR($query->mei);
            })
            ->editColumn('jun', function ($query) {
                return currencyIDR($query->jun);
            })
            ->editColumn('jul', function ($query) {
                return currencyIDR($query->jul);
            })
            ->editColumn('agt', function ($query) {
                return currencyIDR($query->agt);
            })
            ->editColumn('sep', function ($query) {
                return currencyIDR($query->sep);
            })
            ->editColumn('okt', function ($query) {
                return currencyIDR($query->okt);
            })
            ->editColumn('nov', function ($query) {
                return currencyIDR($query->nov);
            })
            ->editColumn('des', function ($query) {
                return currencyIDR($query->des);
            })
            ->make(true);
    }

    public function export(Request $request)
    {
        return Excel::download(new ReportExport($request), 'Laporan-Penjualan.xlsx');
    }
}