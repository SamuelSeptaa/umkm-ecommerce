<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\shopping_cart;
use App\Models\wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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

    public function check_cart(Request $request)
    {
        $product            = product::findOrFail($request->product_id);
        $memberCart         = shopping_cart::where('user_id', auth()->user()->id)->first();

        if (!$memberCart) {
            return $this->add_to_cart($request);
        }

        if ($memberCart->shop_id != $product->shop_id)
            return response()->json([
                'status'        => 'failed',
                'message'       => 'Terdapat perbedaan toko',
                'data'          => [
                    'title'     => 'Peringatan',
                    'body'      => 'Mau ganti pesan dari toko ini aja?'
                ]
            ], 400);

        return $this->add_to_cart($request);
    }

    public function add_to_cart(Request $request)
    {
        $product            = product::findOrFail($request->product_id);
        shopping_cart::where('user_id', auth()->user()->id)
            ->where('shop_id', '!=', $product->shop_id)
            ->orWhere('product_id', $product->id)
            ->delete();

        shopping_cart::create([
            'user_id'       => auth()->user()->id,
            'product_id'    => $product->id,
            'shop_id'       => $product->shop->id,
            'qty'           => $request->qty
        ]);

        return response()->json([
            'status'        => 'success',
            'message'       => 'Berhasil menambahkan kedalam keranjang',
            'data'          => [
                'total_cart'    => count(shopping_cart::where('user_id', auth()->user()->id)->get()->pluck('product_id')->toArray())
            ]
        ], 201);
    }

    public function cart()
    {
        $this->headData();
        $this->data['sub_title']            = "Keranjang Belanja";
        $this->data['carts']                = shopping_cart::with('product')->where('user_id',  auth()->user()->id)->get();

        $user_id                            = auth()->user()->id;
        $results = DB::select("select SUM(temp_table.sub_total) as total FROM (
            SELECT *, (SELECT
              CASE
                WHEN discount > 0 THEN (price - (price * discount / 100)) * shopping_carts.qty
                ELSE price * shopping_carts.qty
              END AS discounted_price
            FROM products WHERE products.id = shopping_carts.product_id) AS sub_total FROM shopping_carts WHERE user_id = $user_id) AS temp_table");
        $this->data['cart_total']           = ($results[0]->total != null) ? $results[0]->total : 0;
        $this->data['script']               = 'guest.script.cart';
        return view('guest.cart', $this->data);
    }

    public function update_cart(Request $request)
    {
        $data = $request->post();

        shopping_cart::where('user_id', auth()->user()->id)->delete();

        if (!empty($data))
            for ($i = 0; $i < count($data['product_id']); $i++) {
                $product            = product::findOrFail($data['product_id'][$i]);
                shopping_cart::create([
                    'user_id'       => auth()->user()->id,
                    'product_id'    => $product->id,
                    'shop_id'       => $product->shop_id,
                    'qty'           => $data['qty'][$i]
                ]);
            }

        $user_id                            = auth()->user()->id;
        $results = DB::select("select SUM(temp_table.sub_total) as total FROM (
            SELECT *, (SELECT
              CASE
                WHEN discount > 0 THEN (price - (price * discount / 100)) * shopping_carts.qty
                ELSE price * shopping_carts.qty
              END AS discounted_price
            FROM products WHERE products.id = shopping_carts.product_id) AS sub_total FROM shopping_carts WHERE user_id = $user_id) AS temp_table");

        return response()->json([
            'status'        => 'Success',
            'message'       => 'Berhasil update Keranjang',
            'data'          => [
                'total'     => ($results[0]->total != null) ? $results[0]->total : 0
            ]
        ], 201);
    }
}
