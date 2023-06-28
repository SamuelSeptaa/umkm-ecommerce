@extends('layout.index')
@section('content')
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="form-group">
                                <p>Nama<span>*</span></p>
                                <input type="text" name="nama"
                                    class="form-control mb-0 @error('nama') is-invalid @enderror" placeholder="Nama Lengkap"
                                    value="{{ $profile->member->name }}" autocomplete="off">
                                @error('nama')
                                    <div class="invalid-feedback" for="nama">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone"
                                            class="form-control mb-0 @error('phone') is-invalid @enderror"
                                            placeholder="Nomor Handphone" value="{{ $profile->member->phone }}"
                                            autocomplete="off">
                                        @error('phone')
                                            <div class="invalid-feedback" for="phone">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email"
                                            class="form-control mb-0 @error('email') is-invalid @enderror"
                                            placeholder="Email" value="{{ $profile->email }}" autocomplete="off">
                                        @error('email')
                                            <div class="invalid-feedback" for="email">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <p>Alamat<span>*</span></p>
                                <textarea class="form-control mb-0 @error('address') is-invalid @enderror" name="address" id="address" rows="3"
                                    placeholder="Alamat Lengkap">{{ $profile->member->address }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback" for="address">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                @error('latitude')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <input type="hidden" name="latitude" id="latitude"
                                    value="{{ $profile->member->latitude }}">
                                <input type="hidden" name="longitude" id="longitude"
                                    value="{{ $profile->member->longitude }}">
                                <div class="map" id="map"></div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    <li>Vegetable’s Package <span>$75.99</span></li>
                                    <li>Fresh Vegetable <span>$151.99</span></li>
                                    <li>Organic Bananas <span>$53.99</span></li>
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>$750.99</span></div>
                                <div class="checkout__order__total">Total <span>$750.99</span></div>
                                <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Check Payment
                                        <input type="checkbox" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
