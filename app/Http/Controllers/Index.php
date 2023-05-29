<?php

namespace App\Http\Controllers;

use App\Models\shop;
use Illuminate\Http\Request;

class Index extends Controller
{
    public function index()
    {
        $this->data['shops'] = shop::all();
        return view('guest.index', $this->data);
    }

    public function shop()
    {
        return view('guest.shop');
    }
}
