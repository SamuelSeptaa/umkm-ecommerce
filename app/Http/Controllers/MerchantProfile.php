<?php

namespace App\Http\Controllers;

use App\Models\shop;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class MerchantProfile extends Controller
{
    public function detail_merchant()
    {
        $this->data['title']        = "Detail Toko";
        $this->data['shop']         = shop::with('user')->where('user_id', auth()->user()->id)->firstOrFail();
        $this->data['action']       = route('update-merchant');
        $this->data['script']       = 'merchant.script.detail_merchant';

        return view('merchant.detail_merchant', $this->data);
    }

    public function update(Request $request)
    {
        $shop         = shop::with('user')->where('user_id', auth()->user()->id)->firstOrFail();

        $data           = $request->validate([
            'shop-name'             => ['required', 'regex:/^[a-zA-Z\s]+$/', 'min:5', 'max:100', Rule::unique('shops', 'shop_name')->ignore($shop->id)],
            'address'               => ['required', 'min:5', 'max:255'],
            'phone'                 => ['required', 'numeric', 'digits_between:10,13'],
            'lat'                   => ['required'],
            'long'                  => ['required'],
            'new-password'          => ['nullable', 'min:5'],
            'confirm-password'      => ['same:new-password']
        ], [
            'lat.required' => 'Titik lokasi Anda wajib diisi'
        ]);

        shop::where('user_id', auth()->user()->id)
            ->update([
                'shop_name'     => $request->{'shop-name'},
                'slug'          => createSlug($request->{'shop-name'}),
                'phone'         => $request->phone,
                'address'       => $request->address,
                'lat'           => $request->lat,
                'long'          => $request->long,
            ]);

        if ($request->{'new-password'})
            User::where('id', auth()->user()->id)
                ->update([
                    'password'  => bcrypt($data['password'])
                ]);


        return redirect()->route('detail-merchant')->with('success', 'Berhasil mengubah data');
    }
}
