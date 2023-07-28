<?php

namespace App\Http\Controllers;

use App\Models\shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class Pajak extends Controller
{
    public function index()
    {
        $this->data['title']        = "Pajak UMKM Palangka Raya";
        $this->data['shops']        = shop::all();
        return view('tax.index', $this->data);
    }

    public function download(Request $request)
    {
        $validate = $request->validate([
            'tahun'      => 'required',
            'toko'      => 'required'
        ]);

        $shop       = shop::with('user')->findOrFail($request->toko);

        $rawQuery           = DB::raw("
            WITH months AS (
                SELECT 1 AS month_number UNION SELECT 2 UNION SELECT 3 UNION SELECT 4
                UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8
                UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
            )
            SELECT
                CASE months.month_number
                    WHEN 1 THEN 'Januari'
                    WHEN 2 THEN 'Februari'
                    WHEN 3 THEN 'Maret'
                    WHEN 4 THEN 'April'
                    WHEN 5 THEN 'Mei'
                    WHEN 6 THEN 'Juni'
                    WHEN 7 THEN 'Juli'
                    WHEN 8 THEN 'Agustus'
                    WHEN 9 THEN 'September'
                    WHEN 10 THEN 'Oktober'
                    WHEN 11 THEN 'November'
                    WHEN 12 THEN 'Desember'
                END AS month_name,
                IFNULL(SUM(transactions.total), 0) AS jumlah_pendapatan,
                IFNULL(SUM(transactions.total) * 0.5 / 100, 0) AS pph
            FROM
                months
            LEFT JOIN transactions ON months.month_number = MONTH(transactions.created_at)
            and shop_id = $request->toko
            AND transactions.`status` IN ('SHIPPED', 'DONE') AND YEAR(transactions.created_at) = $request->tahun
            GROUP BY
                months.month_number
        ");
        $results = DB::select(DB::raw($rawQuery));
        $this->data['shop']                 = $shop;
        $this->data['data_pajak']           = $results;
        $this->data['tahun']                = $request->tahun;


        $pdf = PDF::loadview('tax.tax_report', $this->data);
        return $pdf->download("laporan-pajak-tahun-$request->tahun-$shop->shop_name.pdf");
    }
}
