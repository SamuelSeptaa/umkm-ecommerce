<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Index extends Controller
{
    public function index()
    {
        return view('guest.index');
    }

    public function shop()
    {
        return view('guest.shop');
    }
}
