<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\category;
use App\Models\featured_product;
use App\Models\product;
use App\Models\shop;
use Illuminate\Http\Request;

class Index extends Controller
{
    public function index()
    {
        $this->data['shops']                = shop::orderBy('shop_name')->get();
        $this->data['categories']           = category::all();
        $this->data['featured']             = featured_product::with('product.category')->get();
        $this->data['latest_product_1']     = product::orderBy('created_at', 'desc')->limit(3)->get();
        $this->data['latest_product_2']     = product::orderBy('created_at', 'desc')->limit(3)->offset(3)->get();
        $this->data['best_selling_1']       = product::orderBy('total_sold', 'desc')->limit(3)->get();
        $this->data['best_selling_2']       = product::orderBy('total_sold', 'desc')->limit(3)->offset(3)->get();
        $this->data['latest_blog']          = blog::orderBy('created_at', 'desc')->limit(3)->get();

        return view('guest.index', $this->data);
    }

    public function shop()
    {
        return view('guest.shop');
    }
}
