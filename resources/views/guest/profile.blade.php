@extends('layout.index')
@section('content')
<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>{{$sub_title}}</h2>
                </div>
            </div>
            <div class="col-lg-9">
                @if ($active=="Profil")
                @include('guest.profile.index')
                @elseif ($active == "Riwayat Transaksi")
                @include('guest.profile.transaction_history')
                @endif

            </div>
            <div class="col-lg-3">
                <div class="card w-100">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="{{route('profile')}}"
                                class="btn btn-hover-green w-100 text-left {{($active=='Profil') ? 'active' : ''}}">Profil</a>
                        </li>
                        <li class="list-group-item"><a href="{{route('transaction-history')}}"
                                class="btn btn-hover-green w-100 text-left {{($active=='Riwayat Transaksi') ? 'active' : ''}}">Riwayat
                                Transaksi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection