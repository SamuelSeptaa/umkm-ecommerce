<?php

namespace App\Exports;

use App\Models\shop;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AdminReportExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;
    public $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function query()
    {

        $query      =
            transaction::query()->select(DB::raw("
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

        if (isset($this->request->year))
            $query->where(DB::raw("YEAR(created_at)"), '=', "{$this->request->year}");
        return $query;
    }

    public function headings(): array
    {
        return [
            'Nama Toko',
            'Tahun',
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
    }

    public function map($transaction): array
    {
        return [
            shop::find($transaction->shop_id)->shop_name,
            $transaction->tahun,
            $transaction->jan ? $transaction->jan : "0",
            $transaction->feb  ? $transaction->feb : "0",
            $transaction->mar  ? $transaction->mar : "0",
            $transaction->apr  ? $transaction->apr : "0",
            $transaction->mei  ? $transaction->mei : "0",
            $transaction->jun  ? $transaction->jun : "0",
            $transaction->jul  ? $transaction->jul : "0",
            $transaction->agt  ? $transaction->agt : "0",
            $transaction->sep  ? $transaction->sep : "0",
            $transaction->des  ? $transaction->des : "0",
            $transaction->okt  ? $transaction->okt : "0",
            $transaction->des  ? $transaction->des : "0",
        ];
    }
}
