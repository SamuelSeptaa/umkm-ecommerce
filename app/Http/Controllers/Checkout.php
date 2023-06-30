<?php

namespace App\Http\Controllers;

use App\Models\courier;
use App\Models\shopping_cart;
use App\Models\User;
use Illuminate\Http\Request;

class Checkout extends Controller
{
    public function index()
    {
        $this->headData();
        $this->data['title']        = "Checkout";
        $this->data['profile']      = User::with('member')->find(auth()->user()->id);
        $this->data['courier']      = courier::all();
        $this->data['script']   = "guest.script.checkout";

        return view('guest.checkout', $this->data);
    }

    public function rates(Request $request)
    {
        $biteshipKey    = env('BITESHIP_TEST_KEY');
        $shop           = shopping_cart::with('shop')->where('user_id', auth()->user()->id)->firstOrFail();
        $cartItem       = shopping_cart::with('product')
            ->where('user_id', auth()->user()->id)->get();

        $items = array();
        foreach ($cartItem as $cart) {
            $items[] = [
                "name" => $cart->product->product_name,
                "description" => $cart->product->product_name,
                "weight" => 250,
                "quantity" => $cart->qty,
                "value" => ($cart->product->discount > 0) ? $cart->product->price - ($cart->product->price * $cart->product->discount) / 100 : $cart->product->price,
            ];
        }
        $curl = curl_init();
        $payload = json_encode(array(
            "origin_latitude" => $shop->shop->lat,
            "origin_longitude" => $shop->shop->long,
            "destination_latitude" => $request->lat,
            "destination_longitude" => $request->long,
            "couriers" => $request->courier,
            "items" => $items
        ));
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.biteship.com/v1/rates/couriers",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "authorization: " . $biteshipKey, "Content-Type:application/json"
            ),
        ));

        $result = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($result, true);
        $pricing = (array_key_exists('pricing', $data)) ? $data['pricing'] : null;

        if ($pricing)
            return response()->json([
                'status'        => 'Success',
                'message'       => $data['message'],
                'data'          => [
                    'pricing'     => $pricing
                ]
            ], 201);
        else
            return response()->json([
                'status'        => 'Success',
                'message'       => "Tidak ditemukan kurir ke lokasi Anda, mohon ganti lokasi Anda",
                'data'          => [
                    'data'     => null
                ]
            ], 404);
    }
}
