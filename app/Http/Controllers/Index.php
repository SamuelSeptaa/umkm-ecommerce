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
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeUnit\FunctionUnit;

class Index extends Controller
{

    public function index()
    {
        $this->headData();

        $this->data['active']               = "Home";
        $this->data['sub_title']            = "Beranda";
        $this->data['shops']                = shop::orderBy('shop_name')->get();
        $this->data['categories']           = category::all();
        $this->data['featured']             = featured_product::with('product.category')->orderBy(DB::raw("RAND()"))->limit(8)->get();
        $this->data['latest_product_1']     = product::where('status', 'PUBLISH')->orderBy('created_at', 'desc')->limit(3)->get();
        $this->data['latest_product_2']     = product::where('status', 'PUBLISH')->orderBy('created_at', 'desc')->limit(3)->offset(3)->get();
        $this->data['best_selling_1']       = product::where('status', 'PUBLISH')->orderBy('total_sold', 'desc')->limit(3)->get();
        $this->data['best_selling_2']       = product::where('status', 'PUBLISH')->orderBy('total_sold', 'desc')->limit(3)->offset(3)->get();
        $this->data['latest_blog']          = blog::orderBy('created_at', 'desc')->limit(3)->get();

        $this->data['script']               = "guest.script.index";


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
            ->where('products.product_name', 'like', ($request->query("search")) ?  "%" . $request->query("search") . "%" : '%%')
            ->where('products.status', 'PUBLISH')
            ->paginate(12)->withQueryString();

        $this->data['script']   = "guest.script.shop";
        return view('guest.shop', $this->data);
    }

    public function shop_detail($shop_id, $slug)
    {
        $this->headData();

        $this->data['product']          = product::where('slug', $slug)
            ->where('products.shop_id', $shop_id)
            ->where('products.status', 'PUBLISH')
            ->firstOrFail();
        $this->data['related']          =
            product::where('shop_id', $this->data['product']->shop_id)
            ->where('products.status', 'PUBLISH')
            ->inRandomOrder()->limit(4)->get();

        $this->data['script']           = 'guest.script.shop_detail';
        return view('guest.shop_detail', $this->data);
    }

    public function blog()
    {
        $this->headData();
        $this->data['active']               = "Blog";
        $this->data['sub_title']            = "Blog";
        $this->data['blog']     = blog::paginate(12);
        return view('guest.blog', $this->data);
    }

    public function blog_detail($slug)
    {
        $this->headData();
        $this->data['blog']                 = blog::where('slug', $slug)->firstOrFail();
        $this->data['active']               = "Blog";
        $this->data['sub_title']            = $this->data['blog']->title;

        return view('guest.blog_detail', $this->data);
    }
}
