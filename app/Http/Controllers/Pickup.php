<?php

namespace App\Http\Controllers;

use App\Models\shop;
use App\Models\transaction;
use Illuminate\Http\Request;

class Pickup extends Controller
{
    public function pickup(Request $request)
    {
        $shop               = shop::with('user')->where('user_id', auth()->user()->id)->firstOrFail();
        $transaction        = transaction::with('transaction_detail')
            ->where('shop_id', $shop->id)
            ->where('transactions.status', "PROCESSING")
            ->where('transactions.id', $request->id)->firstOrFail();

        $items = array();
        foreach ($transaction->transaction_detail as $td) {
            $items[] = [
                "id"            => $td->product_id,
                "name"          => $td->product_name,
                "image"         => "",
                "value"         => $td->price,
                "quantity"      => $td->qty,
            ];
        }
        $jsonBody           = [
            "shipper_contact_name"      => $shop->shop_name,
            "shipper_contact_email"     => $shop->user->email,
            "shipper_organization"      => $shop->shop_name,
            "origin_contact_name"       => $shop->shop_name,
            "origin_contact_phone"      => $shop->phone,
            "origin_address"            => $shop->address,
            "origin_coordinate"         => [
                "latitude"  => $shop->lat,
                "longitude" => $shop->long
            ],
            "destination_contact_name"  => $transaction->name,
            "destination_contact_phone" => $transaction->phone,
            "destination_contact_email" => $transaction->email,
            "destination_address"       => $transaction->address,
            "destination_coordinate"    => [
                "latitude"  => $transaction->latitude,
                "longitude" => $transaction->longitude
            ],
            "courier_company"           => $transaction->shipping_method,
            "courier_type"              => $transaction->shipping_type,
            "delivery_type"             => "now",
            "order_note"                => "Please be carefull",
            "items"                     => $items
        ];
        $curl = curl_init();
        $payload = json_encode($jsonBody);
        $biteshipKey    = env('BITESHIP_TEST_KEY');
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.biteship.com/v1/orders",
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


        if ($data['success']) {
            transaction::where('shop_id', $shop->id)
                ->where('transactions.id', $request->id)->update([
                    'status'        => 'SHIPPING',
                ]);
            return response()->json([
                'status'        => 'Success',
                'message'       => 'Berhasil request pickup, mohon menunggu kurir untuk datang'
            ], 200);
        }

        return response()->json([
            'status'        => 'Failed',
            'message'       => "API Error message - " . $data['error']
        ], 404);
    }
}
