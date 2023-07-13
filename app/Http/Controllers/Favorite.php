<?php

namespace App\Http\Controllers;

use App\Models\wishlist;
use Illuminate\Http\Request;

class Favorite extends Controller
{
    public function index()
    {
        $this->headData();

        $this->data['sub_title']        = "Produk Favorit";

        $this->data['favorites']        = wishlist::with('product')->where('user_id', auth()->user()->id)->get();
        return view('guest.favorite', $this->data);
    }
}
