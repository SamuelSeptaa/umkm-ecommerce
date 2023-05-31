@extends('layout.index')
@section('content')
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Daftar</h2>
                    </div>
                </div>
            </div>
            <form action="{{ route('sign') }}" method="post" id="sign-form">
                @if (Session::has('failed'))
                    <div class="row justify-content-center">
                        <div class="form-group col-lg-6">
                            <div class="alert alert-danger" role="alert">
                                {{ session('failed') }}
                            </div>
                        </div>
                    </div>
                @endif
                @csrf
                <div class="row justify-content-center">
                    <div class="form-group col-lg-6">
                        <input type="text" name="email" class="form-control mb-0 @error('email') is-invalid @enderror"
                            placeholder="Email" value="{{ old('email') }}" autocomplete="off">
                        @error('email')
                            <div class="invalid-feedback" for="email">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-lg-6">
                        <input type="text" name="name" class="form-control mb-0 @error('name') is-invalid @enderror"
                            placeholder="Username" value="{{ old('name') }}" autocomplete="off">
                        @error('name')
                            <div class="invalid-feedback" for="name">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-lg-6">
                        <input type="password" name="password"
                            class="form-control mb-0 @error('password') is-invalid @enderror" placeholder="Password">
                    </div>
                    @error('password')
                        <div class="invalid-feedback" for="password">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-lg-6">
                        <input type="password" name="password_confirmation"
                            class="form-control mb-0 @error('password_confirmation') is-invalid @enderror"
                            placeholder="Konfirmasi Password">
                        @error('password_confirmation')
                            <div class="invalid-feedback" for="password_confirmation">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="row justify-content-center">
                    <button type="submit" class="site-btn">DAFTAR</button>
                </div>
                <div class="row mt-3 justify-content-center">
                    <span>Sudah punya akun? <a href="{{ route('login') }}">Login</a></span>
                </div>
            </form>
        </div>
    </div>
@endsection
