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
    }

    protected function headData()
    {
        if (auth()->check()) {
            $this->data['favorit']          = wishlist::where('user_id', auth()->user()->id)->get()->pluck('product_id')->toArray();
            $this->data['total_favorit']    = count($this->data['favorit']);


            $this->data['cart']             = shopping_cart::where('user_id', auth()->user()->id)->get()->pluck('product_id')->toArray();
        }
    }
}
