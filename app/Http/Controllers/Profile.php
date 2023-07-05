<?php

namespace App\Http\Controllers;

use App\Models\member;
use App\Models\payment_method;
use App\Models\transaction;
use App\Models\transaction_detail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class Profile extends Controller
{
    public function index()
    {
        $this->data['active']  = $this->data['sub_title'] = 'Profil';
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

    public function transaction_history()
    {
        $this->data['sub_title']        = $this->data['active'] = "Riwayat Transaksi";

        $member                         = member::where('user_id', auth()->user()->id)->firstOrFail();
        $this->data['transactions']     = transaction::where('member_id', $member->id)->get();

        return view('guest.profile', $this->data);
    }

    public function transaction_history_detail($receipt_number)
    {
        $member                             = member::where('user_id', auth()->user()->id)->firstOrFail();
        $transaction                        = transaction::where('member_id', $member->id)->where('receipt_number', $receipt_number)->firstOrFail();
        $this->data['transaction']          = $transaction;
        $this->data['transaction_details']  = transaction_detail::where('transaction_id', $transaction->id)->get();

        $this->data['receipt_number']       = $transaction->receipt_number;
        $this->data['sub_title']            = $receipt_number;
        $this->data['active']               = "Detail Riwayat Transaksi";

        $this->data['payment_method']      = payment_method::where('code', $transaction->payment_channel)->first();

        return view('guest.profile', $this->data);
    }
}
