<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use App\Models\product as productModel;
use App\Models\shop;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
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
                        <a href="' . route('detail-product', ['product_id' => $query->id]) . '" class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                    </div>
                ';
            })
            ->addColumn('image', function ($query) {
                return '
                    <div class="table-image">
                        <img src="' . asset("storage/$query->image_url") . '" alt="' . $query->product_name . '">
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

    public function add()
    {
        $this->data['title']        = "Daftar Produk - Tambah";

        $category = category::all();

        $category = $category->map(function ($item) {
            return (object) [
                'id'    => $item->id,
                'text'  => $item->category,
            ];
        });

        $this->data['action']       = route('store-product');
        $this->data['back']         = route('product');
        $forms = [
            array('product_name', 'text', 'Nama Produk'),
            array('category_id', 'select', 'Kategori', $category),
            array('image_url', 'image', 'Gambar Produk'),
            array('description', 'description', 'Deskripsi Produk'),
            array('price', 'number', 'Harga Produk'),
            array('discount', 'number', 'Diskon (%)'),
            array('stock', 'number', 'Stok Produk'),
        ];
        $this->data['forms']        = $forms;

        return view('layout.admin.add', $this->data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name'      => ['required', 'unique:products', 'max:100', 'min:5', 'regex:/^[a-zA-Z\s0-9]+$/'],
            'category_id'       => ['required'],
            'description'       => ['required'],
            'price'             => ['required', 'gte:5000'],
            'stock'             => ['required', 'gte:1'],
            'image_url' => ['required', 'max:2048'],
        ]);
        $file       = $request->file('image_url');
        $filename   = createSlug($request->product_name);
        $ext        = $file->getClientOriginalExtension();
        $path       = Storage::disk('public')->putFileAs(
            'img/product',
            $file,
            $filename . ".$ext"
        );

        $shop       = shop::where('user_id', auth()->user()->id)->firstOrFail();
        productModel::create([
            'category_id'       => $request->category_id,
            'shop_id'           => $shop->id,
            'product_name'      => $request->product_name,
            'image_url'         => $path,
            'slug'              => createSlug($request->product_name),
            'description'       => $request->description,
            'price'             => $request->price,
            'stock'             => $request->stock,
            'discount'          => $request->discount
        ]);
        return redirect()->route('add-product')->with('success', 'Berhasil menambahkan data');
    }

    public function detail($product_id)
    {
        $this->data['title']        = "Daftar Produk - Detail";
        $shop       = shop::where('user_id', auth()->user()->id)->firstOrFail();

        $this->data['detail']       = productModel::where('shop_id', $shop->id)
            ->where('id', $product_id)->firstOrFail();


        $category = category::all();

        $category = $category->map(function ($item) {
            return (object) [
                'id'    => $item->id,
                'text'  => $item->category,
            ];
        });

        $this->data['action']       = route('update-product');
        $this->data['back']         = route('product');
        $forms = [
            array('product_name', 'text', 'Nama Produk'),
            array('category_id', 'select', 'Kategori', $category),
            array('image_url', 'image', 'Gambar Produk'),
            array('description', 'description', 'Deskripsi Produk'),
            array('price', 'number', 'Harga Produk'),
            array('discount', 'number', 'Diskon (%)'),
            array('stock', 'number', 'Stok Produk'),
        ];
        $this->data['forms']        = $forms;

        return view('layout.admin.detail', $this->data);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'product_name'      => ['required', Rule::unique('products', 'product_name')->ignore($request->id), 'max:100', 'min:5', 'regex:/^[a-zA-Z\s0-9]+$/'],
            'category_id'       => ['required'],
            'description'       => ['required'],
            'price'             => ['required', 'gte:5000'],
            'stock'             => ['required', 'gte:1'],
            'image_url'         => ['nullable', 'max:2048'],
        ]);

        $product        = productModel::where('id', $request->id)->firstOrFail();
        $file           = $request->file('image_url');
        if ($file) {
            Storage::disk('public')->delete($product->image_url);

            $filename   = createSlug($request->product_name);
            $ext        = $file->getClientOriginalExtension();
            $path       = Storage::disk('public')->putFileAs(
                'img/product',
                $file,
                $filename . ".$ext"
            );
        }

        $shop       = shop::where('user_id', auth()->user()->id)->firstOrFail();
        productModel::where('id', $request->id)
            ->update([
                'category_id'       => $request->category_id,
                'shop_id'           => $shop->id,
                'product_name'      => $request->product_name,
                'image_url'         => ($file) ? $path : $product->image_url,
                'slug'              => createSlug($request->product_name),
                'description'       => $request->description,
                'price'             => $request->price,
                'stock'             => $request->stock,
                'discount'          => $request->discount
            ]);
        return redirect()->route('detail-product', ['product_id' => $request->id])->with('success', 'Berhasil mengubah data');
    }
}
