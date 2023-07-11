<?php

namespace App\Http\Controllers;

use App\Models\shop as ModelsShop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class Shop extends Controller
{
    public function index()
    {
        $this->data['title']        = "Daftar Toko/Merchant";
        $this->data['script']       = "admin.script.shop_list";
        return view('admin.shop_list', $this->data);
    }

    public function show(Request $request)
    {
        $query      = ModelsShop::select(DB::raw("shops.*, users.email"))->join('users', 'users.id', '=', 'shops.user_id');
        return DataTables::of($query)

            ->addColumn('action', function ($query) {
                return '
                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                    <a href="' . route('detail-shop', ['id' => $query->id]) . '" class="btn btn-outline-primary"><i class="fa-solid fa-eye"></i></a>
                </div>';
            })
            ->editColumn('email', function ($query) {
                $email = $query->email;
                return '<a href="mailto:' . $email . '">' . $email . '</a>';
            })
            ->editColumn('phone', function ($query) {
                if ($query->phone)
                    return '<a href="tel:' . $query->phone . '">' . $query->phone . '</a>';
                return $query->phone;
            })
            ->filter(function ($query) use ($request) {
                $this->YajraColumnSearch(
                    $query,
                    ['shop_name', 'users.email'],
                    $request->search
                );
            })
            ->rawColumns(['action', 'email', 'phone'])
            ->removeColumn('id')
            ->make(true);
    }

    public function detail($shop_id)
    {
        $shop                       = ModelsShop::select(DB::raw("shops.*, users.email"))
            ->join('users', 'users.id', '=', 'shops.user_id')
            ->findOrFail($shop_id);
        $this->data['title']        = "Detail Toko $shop->shop_name";

        $forms = [
            array('shop_name', 'text', 'Nama Merchant/Toko'),
            array('email', 'text', 'Email'),
        ];

        $this->data['forms']        = $forms;
        $this->data['detail']       = $shop;
        $this->data['action']       = route('update-shop');
        $this->data['back']         = route('shop-list');

        return view('layout.admin.detail', $this->data);
    }

    public function update(Request $request)
    {

        $shop           = ModelsShop::select(DB::raw("shops.*, users.email"))
            ->join('users', 'users.id', '=', 'shops.user_id')
            ->findOrFail($request->id);
        $request->validate([
            'shop_name'         => ['required', 'regex:/^[a-zA-Z\s]+$/', 'min:5', 'max:100', Rule::unique('shops', 'shop_name')->ignore($request->id)],
            'email'             => ['required', 'email:dns', 'max:100', Rule::unique('users', 'email')->ignore($shop->user_id)]
        ]);

        ModelsShop::where('id', $request->id)
            ->update([
                'shop_name'     => $request->shop_name
            ]);

        User::where('id', $shop->user_id)
            ->update([
                'email'     => $request->email
            ]);
        return redirect()->route('detail-shop', ['id' => $request->id])->with('success', 'Berhasil mengubah data');
    }

    public function add()
    {
        $this->data['title']        = "Tambah Merchant";
        $this->data['forms']        = array(
            array('shop_name', 'text', 'Nama Toko'),
            array('username', 'text', 'Username'),
            array('email', 'text', 'Email'),
            array('phone', 'number', 'Nomor Handphone'),
            array('password', 'password', 'Password'),
            array('password_confirmation', 'password', 'Konfirmasi Password'),
        );
        $this->data['action']       = route('store-shop');
        $this->data['back']         = route('shop-list');

        return view('layout.admin.add', $this->data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'shop_name'             => ['required', 'regex:/^[a-zA-Z\s]+$/', 'min:5', 'max:100', Rule::unique('shops', 'shop_name')],
            'username'              => ['required', 'alpha_dash', 'min:5', 'max:100'],
            'email'                 => ['required', 'email:dns', 'max:100', Rule::unique('users', 'email')],
            'phone'                 => ['required', 'numeric', 'digits_between:10,13'],
            'password'              => ['required', 'min:5'],
            'password_confirmation' => ['same:password']
        ]);

        $user           = User::create([
            'name'      => $request->username,
            'email'     => $request->email,
            'password'  => bcrypt($request->password)
        ]);
        $user->assignRole('merchant');
        ModelsShop::create([
            'user_id'       => $user->id,
            'shop_name'     => $request->shop_name,
            'phone'         => $request->phone
        ]);

        return redirect()->route('add-shop')->with('success', 'Berhasil menambahkan data');
    }
}
