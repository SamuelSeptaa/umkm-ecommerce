<?php

namespace App\Http\Controllers;

use App\Models\featured_product;
use App\Models\product;
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
        $this->data['title']                    = "Produk Teratas";
        $this->data['featured_products']        = featured_product::with('product')->get();
        $this->data['ids_featured']             = featured_product::get()->pluck('product_id')->toArray();
        $this->data['products']                 = product::all();
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
        $request->validate([
            'featured'  => ['required', 'size:8']
        ], [
            'featured.size' => 'Produk teratas wajib berjumlah 8'
        ]);

        featured_product::truncate();

        foreach ($request->featured as $value) {
            featured_product::create([
                'product_id'    => $value
            ]);
        }

        return redirect()->route('featured-product')->with('success', "Berhasil memperbarui data");
    }
}
