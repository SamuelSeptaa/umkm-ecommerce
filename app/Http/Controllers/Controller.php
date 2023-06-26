<?php

namespace App\Http\Controllers;

use App\Models\shopping_cart;
use App\Models\wishlist;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $data = [];

    public function __construct()
    {
        $this->data['active']       = "";
        $this->data['sub_title']    = "";
        $this->data['title']        = 'UMKM Palangka Raya';

        $this->data['favorit']          = [];
        $this->data['total_favorit']    = 0;
        $this->data['cart']             = [];
        $this->data['total_cart']       = 0;
    }

    protected function headData()
    {
        if (auth()->check()) {
            $this->data['favorit']          = wishlist::where('user_id', auth()->user()->id)->get()->pluck('product_id')->toArray();
            $this->data['total_favorit']    = count($this->data['favorit']);


            $this->data['cart']             = shopping_cart::where('user_id', auth()->user()->id)->get()->pluck('product_id')->toArray();
            $this->data['total_cart']       = count($this->data['cart']);
        }
    }

    protected function YajraFilterValue(
        $filterValue,
        $query,
        $columnFilter,
        $join = false,
        $table = null,
        $columnRelation = null,
        $tableJoin = null
    ) {
        if ($join)
            $query->join($tableJoin, "$table.$columnRelation", '=', "$tableJoin.id");

        $filterValue = json_decode($filterValue);
        if (!empty($filterValue)) {
            $query->whereIn($columnFilter, $filterValue);
        }
    }

    /**
     * YajraColumnSearch
     *
     * @param  mixed $query
     * @param  array $columnSearch
     * @param  string $searchValue
     * @return void
     */
    protected function YajraColumnSearch($query, $columnSearch, $searchValue)
    {
        $query->where(function ($query) use ($columnSearch, $searchValue) {
            $i = 0;
            foreach ($columnSearch as $item) {
                if ($i == 0)
                    $query->where($item, 'like', "%{$searchValue}%");
                else
                    $query->orWhere($item, 'like', "%{$searchValue}%");
                $i++;
            }
        });
    }

    /**
     * filterDateRange
     *
     * @param  mixed $query
     * @param  string $columnFilter
     * @param  object $request
     * @return void
     */
    protected function filterDateRange($query, $columnFilter, $request)
    {
        if ($request->startDate && $request->endDate) {
            $query->where($columnFilter, '>=', "$request->startDate 00:00:00");
            $query->where($columnFilter, '<=', "$request->endDate 23:59:59");
        }
    }
}
