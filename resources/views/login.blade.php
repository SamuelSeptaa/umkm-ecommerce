@extends('layout.index')
@section('content')
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Masuk</h2>
                    </div>
                </div>
            </div>
            <form action="{{ route('sign-in') }}" method="post">
                @if (Session::has('failed'))
                    <div class="row justify-content-center">
                        <div class="form-group col-lg-6">
                            <div class="alert alert-danger" role="alert">
                                {{ session('failed') }}
                            </div>
                        </div>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="row justify-content-center">
                        <div class="form-group col-lg-6">
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        </div>
                    </div>
                @endif
                @csrf
                <div class="row justify-content-center">
                    <div class="form-group col-lg-6">
                        <input type="text" name="email" class="form-control mb-0 @error('email') is-invalid @enderror"
                            placeholder="Email" value="">
                        @error('email')
                            <div class="invalid-feedback" for="email">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-lg-6">
                        <input type="password" name="password" class="form-control mb-0" placeholder="Password">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <button type="submit" class="site-btn">LOGIN</button>
                </div>
                <div class="row mt-3 justify-content-center">
                    <span>Belum punya akun? <a href="{{ route('sign-up') }}">Daftar</a></span>
                </div>
            </form>
        </div>
    </div>
@endsection
