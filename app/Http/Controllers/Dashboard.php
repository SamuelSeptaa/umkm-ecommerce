<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\shop;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class Dashboard extends Controller
{
    public function index()
    {
        $this->data['title']            = 'Dashboaard';
        $shop                           = shop::where('user_id', auth()->user()->id)->firstOrFail();
        $this->data['products']         = product::where('shop_id', $shop->id)->count();
        $this->data['latest_order']     = transaction::where('shop_id', $shop->id)->whereIn('status', ["PAYMENT", "PROCESSING"])->count();

        $month                          = date('m');
        $this->data['monthly_income']   = transaction::select(DB::raw('SUM(total) as monthly_income'))
            ->where('shop_id', $shop->id)
            ->where(DB::raw("MONTH(created_at)"), $month)
            ->whereIn('status', ["SHIPPED", "DONE"])->first()->monthly_income;

        return view('merchant.index', $this->data);
    }
}
