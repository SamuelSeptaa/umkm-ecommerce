<?php

namespace App\Http\Controllers;

use App\Models\featured_product;
use App\Models\product;
use App\Models\shop;
use Illuminate\Http\Request;

class FeaturedProduct extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shop       = shop::where('user_id', auth()->user()->id)->firstOrFail();

        $this->data['title']                    = "Produk Teratas";
        $this->data['featured_products']        = featured_product::join('products', 'products.id', '=', 'featured_products.product_id')
            ->where('products.shop_id', $shop->id)->get();
        $this->data['ids_featured']             = featured_product::join('products', 'products.id', '=', 'featured_products.product_id')
            ->where('products.shop_id', $shop->id)->get()->pluck('product_id')->toArray();
        $this->data['products']                 = product::where('shop_id', $shop->id)->get();
        $this->data['script']                   = "admin.script.featured_product";
        return view('admin.featured_product', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $shop       = shop::where('user_id', auth()->user()->id)->firstOrFail();

        $request->validate([
            'featured'  => ['required', 'size:8']
        ], [
            'featured.size' => 'Produk teratas wajib berjumlah 8'
        ]);

        featured_product::join('products', 'products.id', '=', 'featured_products.product_id')
            ->where('products.shop_id', $shop->id)->delete();

        foreach ($request->featured as $value) {
            featured_product::create([
                'product_id'    => $value
            ]);
        }

        return redirect()->route('featured-product')->with('success', "Berhasil memperbarui data");
    }
}
