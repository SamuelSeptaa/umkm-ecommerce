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
}
