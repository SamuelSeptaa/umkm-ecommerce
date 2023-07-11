<?php

namespace App\Http\Controllers;

use App\Models\member as ModelsMember;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Member extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title']        = "Daftar Member/Anggota";
        $this->data['script']       = "admin.script.member";
        return view('admin.member', $this->data);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $query      = ModelsMember::select('members.*', 'users.email', 'users.name as username')
            ->join('users', 'users.id', '=', 'members.user_id');
        return DataTables::of($query)
            ->editColumn('email', function ($query) {
                $email = $query->email;
                return '<a href="mailto:' . $email . '">' . $email . '</a>';
            })
            ->editColumn('phone', function ($query) {
                if ($query->phone)
                    return '<a href="tel:' . $query->phone . '">' . $query->phone . '</a>';
                return $query->phone;
            })
            ->editColumn('created_at', function ($query) {
                return parseTanggal($query->created_at);
            })
            ->filter(function ($query) use ($request) {
                $this->YajraColumnSearch(
                    $query,
                    ['users.name', 'phone', 'users.email'],
                    $request->search
                );
            })
            ->rawColumns(['action', 'email', 'phone'])
            ->removeColumn(['id', 'latitude', 'longitude', 'address'])
            ->make(true);
    }
}
