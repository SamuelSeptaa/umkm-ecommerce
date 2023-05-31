<?php

namespace App\Http\Controllers;

use App\Models\member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function index()
    {
        return view('login', $this->data);
    }

    public function sign_in(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns|max:100',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->hasRole('admin')) {
                return redirect('dashboard');
            }
            if (Auth::user()->hasRole('user')) {
                return redirect('/');
            }
        }
        return redirect()->route('login')->with('failed', 'Invalid login credentials (informasi login tidak valid)');
    }

    public function sign_up()
    {
        return view('sign_up', $this->data);
    }

    public function sign(Request $request)
    {
        $validate = $request->validate([
            'email'                 => 'required|email:dns|max:100|unique:users,email',
            'name'                  => 'required|alpha_dash|min:5|max:100|unique:users,name',
            'password'              => 'required|min:5',
            'password_confirmation' => 'required|same:password'
        ]);
        $member = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => bcrypt($validate['password'])
        ]);
        $member->assignRole('member');
        member::create([
            'user_id'       => $member->id,
        ]);
        return redirect()->route('login')->with('success', 'Berhasil membuat akun, Anda dapat login sekarang');
    }
}
