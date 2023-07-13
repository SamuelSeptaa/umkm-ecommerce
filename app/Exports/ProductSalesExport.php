<?php

namespace App\Exports;

use App\Models\shop;
use App\Models\transaction_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductSalesExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;
    public $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $shop           = shop::where('user_id', auth()->user()->id)->firstOrFail();
        $request    = $this->request;
        $query      =
            transaction_detail::select(DB::raw("
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
        return $query;
    }

    public function headings(): array
    {
        return [
            'Nama Produk',
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
            $transaction->product_name,
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
