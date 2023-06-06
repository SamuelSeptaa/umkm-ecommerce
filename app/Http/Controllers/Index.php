<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\category;
use App\Models\featured_product;
use App\Models\product;
use App\Models\shop;
use App\Models\shopping_cart;
use App\Models\wishlist;
use Illuminate\Http\Request;

class Index extends Controller
{

    public function index()
    {
        $this->headData();

        $this->data['active']               = "Home";
        $this->data['sub_title']            = "Beranda";
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

    public function shop(Request $request)
    {
        $this->headData();

        $this->data['active']               = "Shop";
        $this->data['sub_title']            = "Belanja";
        $this->data['shops']                = shop::orderBy('shop_name')->get();
        $this->data['categories']           = category::all();

        $this->data['query']                = $request->query();
        unset($this->data['query']['page']);
        $this->data['products']             =
            product::select('products.*', 'shops.shop_name', 'categories.category')
            ->join('shops', 'shops.id', "=", "products.shop_id")
            ->join('categories', 'categories.id', "=", "products.category_id")
            ->where('shops.slug', 'like', ($request->query("shop")) ?  $request->query("shop") : '%%')
            ->where('categories.slug', 'like', ($request->query("category")) ?  $request->query("category") : '%%')
            ->where('products.product_name', 'like', ($request->query("product")) ?  "%" . $request->query("product") . "%" : '%%')
            ->paginate(12)->withQueryString();

        $this->data['script']   = "guest.script.shop";
        return view('guest.shop', $this->data);
    }
}
