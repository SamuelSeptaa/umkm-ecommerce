<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\shop;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Dashboard extends Controller
{
    public function index()
    {
        $this->data['title']        = 'Dashboaard';
        return view('merchant.index', $this->data);
    }

    public function product()
    {
        $this->data['title']        = 'Daftar Produk';
        $this->data['script']       = 'merchant.script.products';
        return view('merchant.products', $this->data);
    }

    public function show(Request $request)
    {
        $shop       = shop::where('user_id', auth()->user()->id)->firstOrFail();
        $product    = product::where('shop_id', $shop->id)->get();

        return DataTables::of($product)
            ->addColumn('action', function ($product) {
                return '
                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                        <button type="button" class="btn btn-outline-danger" onclick="setDraft(' . $product->id . ')"><i class="fa-solid fa-x"></i></button>
                        <button type="button" class="btn btn-outline-success" onclick="setActive(' . $product->id . ')"><i class="fa-solid fa-check"></i></button>
                        <a href="" class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                    </div>
                ';
            })
            ->addColumn('image', function ($product) {
                return '
                    <div class="table-image">
                        <img src="' . asset($product->image_url) . '" alt="' . $product->product_name . '">
                    </div>
                ';
            })
            ->editColumn('discount', function ($product) {
                if ($product->discount)
                    return $product->discount . '%';
                else
                    return '0%';
            })
            ->rawColumns(['action', 'image'])
            ->removeColumn('id')
            ->make(true);
    }
}
