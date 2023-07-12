<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminProfile extends Controller
{
    public function index()
    {
        $this->data['title']        = "Profil Admin";
        $this->data['detail']       = User::find(auth()->user()->id);

        $this->data['forms']        = [
            array('email', 'text', 'Email'),
            array('name', 'text', 'Username'),
            array('password', 'password', 'Password Baru'),
            array('password_confirmation', 'password', 'Konfirmasi Password Baru'),
        ];

        $this->data['action']       = route('update-admin-profil');
        $this->data['back']         = route('dashboard');

        return view('layout.admin.detail', $this->data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'email'                 => ['required', 'email:dns', 'max:100', Rule::unique('users', 'email')->ignore(auth()->user()->id)],
            'name'                  => ['required', 'alpha_dash', 'min:5', 'max:100', Rule::unique('users', 'name')->ignore(auth()->user()->id)],
            'password'              => ['nullable', 'min:5'],
            'password_confirmation' => ['same:password']
        ]);

        if ($request->password) {
            User::where('id', $request->id)->update([
                'email'     => $request->email,
                'name'      => $request->name,
                'password'  => bcrypt($request->password),
            ]);
        } else {
            User::where('id', $request->id)->update([
                'email'     => $request->email,
                'name'      => $request->name,
            ]);
        }

        return redirect()->route('admin-profil')->with('success', "Berhasil mengubah data admin");
    }
}
