<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product as productModel;
use App\Models\shop;
use Yajra\DataTables\Facades\DataTables;

class Product extends Controller
{
    public function index()
    {
        $this->data['title']        = 'Daftar Produk';
        $this->data['status']       = get_enum_values('products', 'status');
        $this->data['script']       = 'merchant.script.products';
        return view('merchant.products', $this->data);
    }

    public function show(Request $request)
    {
        $shop       = shop::where('user_id', auth()->user()->id)->firstOrFail();
        $query      = productModel::where('shop_id', $shop->id);

        return DataTables::of($query)

            ->addColumn('action', function ($query) {
                $draftDisabled = "";
                $publishDisabled = "";
                if ($query->status == 'PUBLISH') {
                    $draftDisabled = "";
                    $publishDisabled = "disabled";
                } else {
                    $draftDisabled = "disabled";
                    $publishDisabled = "";
                }
                return '
                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                        <button type="button" class="btn btn-outline-danger" ' . $draftDisabled . ' onclick="togleStatus(' . $query->id . ', `' . $query->status . '`)"><i class="fa-solid fa-x"></i></button>
                        <button type="button" class="btn btn-outline-success" ' . $publishDisabled . ' onclick="togleStatus(' . $query->id . ', `' . $query->status . '`)"><i class="fa-solid fa-check"></i></button>
                        <a href="" class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                    </div>
                ';
            })
            ->addColumn('image', function ($query) {
                return '
                    <div class="table-image">
                        <img src="' . asset($query->image_url) . '" alt="' . $query->product_name . '">
                    </div>
                ';
            })
            ->addColumn('statusbadge', function ($kavlings) {
                if ($kavlings->status == 'PUBLISH')
                    return '<span class="badge bg-success">' . $kavlings->status . '</span>';
                return '<span class="badge bg-danger">' . $kavlings->status . '</span>';
            })
            ->editColumn('discount', function ($query) {
                if ($query->discount)
                    return $query->discount . '%';
                else
                    return '0%';
            })
            ->editColumn('price', function ($query) {
                return currencyIDR($query->price);
            })
            ->filter(function ($query) use ($request) {
                $this->YajraFilterValue($request->filterValue, $query, "status");
                $this->YajraColumnSearch(
                    $query,
                    ['product_name'],
                    $request->search
                );
            })
            ->rawColumns(['action', 'image', 'statusbadge'])
            ->removeColumn('id')
            ->make(true);
    }

    public function toggle_status(Request $request)
    {
        $product = productModel::findOrFail($request->id);
        if ($product->status == "PUBLISH") {
            productModel::where('id', $request->id)->update([
                'status'    => 'DRAFT'
            ]);
        } else {
            productModel::where('id', $request->id)->update([
                'status'    => 'PUBLISH'
            ]);
        }

        return response()->json(
            ['message' => 'Berhasil mengubah status'],
            200
        );
    }
}
