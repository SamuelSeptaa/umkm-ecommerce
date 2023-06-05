<?php

namespace App\Http\Controllers;

use App\Models\member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class Profile extends Controller
{
    public function index()
    {
        $this->data['profile']  = User::with('member')->find(auth()->user()->id);
        $this->data['script']   = "guest.script.profile";

        // dd($this->data['profile']);
        return view('guest.profile', $this->data);
    }

    public function save_profile(Request $request)
    {
        $data       = $request->validate([
            'email'                 => ['required', 'email:dns', 'max:100', Rule::unique('users', 'email')->ignore(auth()->user()->id)],
            'name'                  => ['required', 'alpha_dash', 'min:5', 'max:100', Rule::unique('users', 'name')->ignore(auth()->user()->id)],
            'nama'                  => ['required', 'min:5', 'max:100', 'regex:/^[a-zA-Z\s]+$/'],
            'phone'                 => ['required', 'numeric', 'digits_between:10,13'],
            'address'               => ['required'],
            'latitude'              => ['required'],
            'longitude'             => ['required'],
            'password'              => ['nullable', 'min:5'],
            'password_confirmation' => ['same:password']
        ], [
            'latitude.required' => 'Titik lokasi Anda wajib diisi'
        ]);

        if ($data['password']) {
            User::where('id', auth()->user()->id)
                ->update([
                    'email'     => $data['email'],
                    'name'      => $data['name'],
                    'password'  => bcrypt($data['password'])
                ]);
        } else {
            User::where('id', auth()->user()->id)
                ->update([
                    'email'     => $data['email'],
                    'name'      => $data['name'],
                ]);
        }

        member::where('user_id', auth()->user()->id)
            ->update([
                'name'          => $data['nama'],
                'phone'         => $data['phone'],
                'address'       => $data['address'],
                'latitude'      => $data['latitude'],
                'longitude'     => $data['longitude']
            ]);

        return redirect()->route('profile')->with('success', 'Berhasil mengubah data');
    }
}
