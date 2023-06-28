<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Checkout extends Controller
{
    public function index()
    {
        $this->data['title']        = "Checkout";
        $this->data['profile']      = User::with('member')->find(auth()->user()->id);
        $this->data['script']   = "guest.script.checkout";

        return view('guest.checkout', $this->data);
    }
}
