@extends('layout.admin.index')
@section('content')
    <div class="card mb-4">
        <form action="{{ $action }}" id="form-manipulation" method="POST" enctype="multipart/form-data">
            <div class="card-header d-flex align-items-center"><strong>{{ $title }}</strong></strong>

                <button type="submit" class="btn btn-sm btn-info ms-auto me-1 ">
                    <i class="fa-solid fa-floppy-disk"></i> Save
                </button>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                        {{ session('success') }}
                        <button class="btn-close" type="button" data-coreui-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="email">Email Toko</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="email" disabled value="{{ $shop->user->email }}" type="text">
                        <div class="text-sm text-info" for="email">Email Hanya dapat diubah oleh Admin, silahkan hubungi
                            Admin</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="shop-name">Nama Toko</label>
                    <div class="col-sm-10">
                        <input class="form-control @error('shop-name') is-invalid @enderror" id="shop-name" name="shop-name"
                            value="{{ $shop->shop_name }}" type="text">
                        @error('shop-name')
                            <div class="invalid-feedback" for="shop-name">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="address">Alamat Toko</label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address">{{ $shop->address }}</textarea>
                        @error('address')
                            <div class="invalid-feedback" for="address">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        @error('latitude')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <input type="hidden" name="lat" id="lat" value="{{ $shop->lat }}">
                        <input type="hidden" name="long" id="long" value="{{ $shop->long }}">
                        <div class="map" id="map"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="new-password">Password Baru</label>
                    <div class="col-sm-10">
                        <input class="form-control @error('new-password') is-invalid @enderror" id="new-password"
                            name="new-password" value="" type="password" autocomplete="new-password">
                        @error('new-password')
                            <div class="invalid-feedback" for="new-password">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="confirm-password">Konfirmasi Pasword</label>
                    <div class="col-sm-10">
                        <input class="form-control @error('confirm-password') is-invalid @enderror" id="confirm-password"
                            name="confirm-password" value="" type="password" autocomplete="new-password">
                        @error('confirm-password')
                            <div class="invalid-feedback" for="confirm-password">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
