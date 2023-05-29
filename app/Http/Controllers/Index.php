<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\shop;
use Illuminate\Http\Request;

class Index extends Controller
{
    public function index()
    {
        $this->data['shops'] = shop::orderBy('shop_name')->get();
        $this->data['categories'] = category::all();
        return view('guest.index', $this->data);
    }

    public function shop()
    {
        return view('guest.shop');
    }
}
