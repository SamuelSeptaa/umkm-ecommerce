<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\courier;
use App\Models\payment_method;
use Illuminate\Http\Request;
use App\Models\shopping_cart;
use App\Models\voucher;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class Checkout extends Controller
{
    public function index()
    {
        $this->headData();
        $this->data['title']            = "Checkout";
        $this->data['sub_title']        = "UKM Palangka Raya";
        $this->data['profile']          = User::with('member')->find(auth()->user()->id);
        $this->data['courier']          = courier::all();
        $this->data['shopping_carts']   = shopping_cart::with('product')
            ->where('user_id', auth()->user()->id)->get();

        $user_id                            = auth()->user()->id;
        $results = DB::select("select SUM(temp_table.sub_total) as total FROM (
                SELECT *, (SELECT
                  CASE
                    WHEN discount > 0 THEN (price - (price * discount / 100)) * shopping_carts.qty
                    ELSE price * shopping_carts.qty
                  END AS discounted_price
                FROM products WHERE products.id = shopping_carts.product_id) AS sub_total FROM shopping_carts WHERE user_id = $user_id) AS temp_table");
        $this->data['cart_total']           = ($results[0]->total != null) ? $results[0]->total : 0;

        $this->data['payment_methods']      = payment_method::all();
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
                'status'        => 'Failed',
                'message'       => "Tidak ditemukan kurir ke lokasi Anda, mohon ganti lokasi Anda",
                'data'          => [
                    'data'     => null
                ]
            ], 404);
    }

    public function apply_coupon(Request $request)
    {
        $coupon = $request->coupon;
        $isExist = voucher::where('code', $coupon)->first();

        if (!$isExist) {
            return response()->json([
                'status'        => 'Failed',
                'message'       => "Kupon kamu sepertinya tidak berlaku",
            ], 404);
        }

        $dateStart  = strtotime($isExist->valid_from);
        $dateEnd    = strtotime($isExist->valid_until);
        $now        = strtotime(date('Y-m-d H:i:s'));

        if ($now < $dateStart)
            return response()->json([
                'status'        => "Failed",
                'message'       => "Kupon yang kamu masukkan belum berlaku nih",
            ], 404);
        if ($now > $dateEnd)
            return response()->json([
                'status'        => "Failed",
                'message'       => "Kupon yang kamu masukkan sudah kadaluarsa nih",
            ], 404);
        if ($request->purchase_value < $isExist->min_purchase)
            return response()->json([
                'status'        => "Failed",
                'message'       => "Kamu belum mencapai minimum belanja untuk kupon ini",
            ], 404);

        return response()->json([
            'status'        => "Success",
            'message'       => "Berhasil memasang kupon, kamu dapat diskon!",
            'data'          => [
                'discount'  => $isExist->discount,
            ]
        ], 200);
    }

    public function make_transaction(Request $request)
    {
        $data       = $request->validate([
            'email'                 => ['required', 'email:dns', 'max:100'],
            'name'                  => ['required', 'min:5', 'max:100', 'regex:/^[a-zA-Z\s]+$/'],
            'phone'                 => ['required', 'numeric', 'digits_between:10,13'],
            'address'               => ['required'],
            'latitude'              => ['required'],
            'longitude'             => ['required'],
            'shipping_method'       => ['required'],
            'type'                  => ['required'],
            'payment_channel'       => ['required'],
        ], [
            'latitude.required' => 'Titik lokasi Anda wajib diisi'
        ]);

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');
    }
}
