<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\wishlist;
use Illuminate\Http\Request;

class Cart extends Controller
{
    public function add_favorit(Request $request)
    {
        $product            = product::findOrFail($request->product_id);
        $isExist            = wishlist::where('product_id', $product->id)->first();
        if ($isExist)
            wishlist::where([
                ['product_id', '=', $product->id],
                ['user_id', '=', auth()->user()->id],
            ])->delete();
        else
            wishlist::create([
                'user_id'           => auth()->user()->id,
                'product_id'        => $product->id,
                'shop_id'           => $product->shop->id
            ]);
    }
}
