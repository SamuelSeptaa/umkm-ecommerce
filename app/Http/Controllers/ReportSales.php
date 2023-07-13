<?php

namespace App\Http\Controllers;

use App\Exports\AdminReportExport;
use App\Exports\ProductSalesExport;
use App\Exports\ReportExport;
use App\Models\shop;
use App\Models\transaction;
use App\Models\transaction_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
        if (Auth::user()->hasRole('merchant')) {
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
        } else if (Auth::user()->hasRole('admin')) {
            $query          = transaction::select(DB::raw("
                        shop_id,
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
                ->orderBy(DB::raw("YEAR(created_at)"), 'desc')
                ->groupBy(DB::raw("YEAR(created_at)"), 'shop_id');

            return DataTables::of($query)
                ->addColumn('shop_name', function ($query) {
                    $shop           = shop::find($query->shop_id);
                    return $shop->shop_name;
                })
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
                })->filter(function ($query) use ($request) {
                    $this->YajraColumnSearch(
                        $query,
                        [DB::raw("YEAR(created_at)")],
                        $request->year
                    );
                })
                ->make(true);
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new ReportExport($request), 'Laporan-Penjualan.xlsx');
    }

    public function export_excell(Request $request)
    {
        return Excel::download(new AdminReportExport($request), 'Laporan-Penjualan.xlsx');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function laporan_penjualan_product()
    {
        $this->data['title']        = "Jumlah Produk Terjual";
        $this->data['script']       = 'merchant.script.report_product';
        return view('merchant.report_product', $this->data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_laporan_penjualan_product(Request $request)
    {

        $shop           = shop::where('user_id', auth()->user()->id)->firstOrFail();
        $query          = transaction_detail::select(DB::raw("
                products.product_name,
                SUM(IF(MONTH(transactions.created_at) = 1, transaction_details.qty, 0)) AS jan,
                SUM(IF(MONTH(transactions.created_at) = 2, transaction_details.qty, 0)) AS feb,
                SUM(IF(MONTH(transactions.created_at) = 3, transaction_details.qty, 0)) AS mar,
                SUM(IF(MONTH(transactions.created_at) = 4, transaction_details.qty, 0)) AS apr,
                SUM(IF(MONTH(transactions.created_at) = 5, transaction_details.qty, 0)) AS mei,
                SUM(IF(MONTH(transactions.created_at) = 6, transaction_details.qty, 0)) AS jun,
                SUM(IF(MONTH(transactions.created_at) = 7, transaction_details.qty, 0)) AS jul,
                SUM(IF(MONTH(transactions.created_at) = 8, transaction_details.qty, 0)) AS agt,
                SUM(IF(MONTH(transactions.created_at) = 9, transaction_details.qty, 0)) AS sep,
                SUM(IF(MONTH(transactions.created_at) = 10, transaction_details.qty, 0)) AS okt,
                SUM(IF(MONTH(transactions.created_at) = 11, transaction_details.qty, 0)) AS nov,
                SUM(IF(MONTH(transactions.created_at) = 12, transaction_details.qty, 0)) AS des
            "))
            ->join('transactions', function ($join) use ($request) {
                $join->on('transactions.id', '=', 'transaction_details.transaction_id')
                    ->whereIn('.transactions.status', ["SHIPPED", "DONE"]);
                if ($request->year && $request->year !== "")
                    $join->where(DB::raw("YEAR(transactions.created_at)"), $request->year);
            })->rightJoin('products', 'products.id', '=', 'transaction_details.product_id')
            ->where('products.shop_id',  $shop->id)
            ->groupBy('products.product_name')
            ->orderBy('products.id', 'asc');

        return DataTables::of($query)
            ->editColumn('jan', function ($query) {
                return "$query->jan item terjual";
            })
            ->editColumn('feb', function ($query) {
                return "$query->feb item terjual";
            })
            ->editColumn('mar', function ($query) {
                return "$query->mar item terjual";
            })
            ->editColumn('apr', function ($query) {
                return "$query->apr item terjual";
            })
            ->editColumn('mei', function ($query) {
                return "$query->mei item terjual";
            })
            ->editColumn('jun', function ($query) {
                return "$query->jun item terjual";
            })
            ->editColumn('jul', function ($query) {
                return "$query->jul item terjual";
            })
            ->editColumn('agt', function ($query) {
                return "$query->agt item terjual";
            })
            ->editColumn('sep', function ($query) {
                return "$query->sep item terjual";
            })
            ->editColumn('okt', function ($query) {
                return "$query->okt item terjual";
            })
            ->editColumn('nov', function ($query) {
                return "$query->nov item terjual";
            })
            ->editColumn('des', function ($query) {
                return "$query->des item terjual";
            })
            ->filter(function ($query) use ($request) {
                $this->YajraColumnSearch(
                    $query,
                    ['products.product_name'],
                    $request->search
                );
            })
            ->make(true);
    }

    public function export_laporan_penjualan_product(Request $request)
    {
        return Excel::download(new ProductSalesExport($request), 'Jumlah-Penjualan-Product.xlsx');
    }
}
