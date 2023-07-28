<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AdminList extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title']        = "Daftar Admin Web UMKM Palangka Raya";
        $this->data['script']       = "admin.script.admin";

        return view('admin.admin', $this->data);
    }


    /**
     * Display add view
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $this->data['title']        = "Tambah Admin";

        $tipe_admin = [
            (object) array('id' => 1, 'text' => 'Admin'),
            (object) array('id' => 3, 'text' => 'Perpajakan'),
        ];
        $this->data['action']       = route('store-admin-list');
        $this->data['back']         = route('admin-list');
        $this->data['forms'] = [
            array('name', 'text', 'Username Admin'),
            array('roles', 'select', 'Role Admin', $tipe_admin),
            array('email', 'text', 'Email Admin'),
            array('password', 'password', 'Password'),
            array('konfirmasi_password', 'password', 'Konfirmasi Password'),
        ];
        return view('layout.admin.add', $this->data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'email'                 => 'required|email:dns|max:100|unique:users,email',
            'name'                  => 'required|alpha_dash|min:5|max:100|unique:users,name',
            'roles'                 => 'required',
            'password'              => 'required|min:5',
            'konfirmasi_password'   => 'required|same:password'
        ]);

        $admin = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => bcrypt($validate['password'])
        ]);

        if ($request->roles == "1")
            $admin->assignRole('admin');
        else
            $admin->assignRole('tax');

        return redirect()->route('admin-list')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $query      = User::select("users.*", "model_has_roles.role_id")
            ->join("model_has_roles", "model_has_roles.model_id", "=", "users.id")
            ->whereIn("model_has_roles.role_id", [1, 3]);

        return DataTables::of($query)
            ->addColumn('action', function ($query) {
                return '
                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                        <button onclick="resetPassword(' . $query->id . ')" class="btn btn-outline-danger"><i class="fa-solid fa-repeat"></i></button>
                    </div>
                ';
            })
            ->addColumn('tipe_admin', function ($query) {
                if ($query->role_id === 3)
                    return '<span class="badge bg-secondary">PERPAJAKAN</span>';
                return '<span class="badge bg-primary">ADMIN</span>';
            })
            ->filter(function ($query) use ($request) {
                $this->YajraColumnSearch(
                    $query,
                    ['email', 'name'],
                    $request->search
                );
            })
            ->rawColumns(['action', 'tipe_admin'])
            ->removeColumn(['id'])
            ->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reset_password(Request $request)
    {
        $admin_id = $request->id;

        if (auth()->user()->id !== 1)
            return response()->json([
                'status' => 'Failed',
                'message'   => 'Anda tidak memiliki ototorisasi untuk melakukan ini'
            ], 401);

        User::where('id', $admin_id)->update([
            'password' => bcrypt("12345678"),
        ]);

        return response()->json([
            'status' => 'Success',
            'message'   => 'Berhasil mereset password admin yang dipilih'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
