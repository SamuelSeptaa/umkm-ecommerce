@extends('layout.index')
@section('content')
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Billing Details</h4>

                <form action="#" id="form-checkout" v-on:submit.prevent="onSubmit">
                    <div class="row">
                        <div class="col-lg-7 col-md-6">
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
                                <input type="hidden" name="latitude" id="latitude" v-model="lat" v-on:change="resetRate">
                                <input type="hidden" name="longitude" id="longitude" v-model="long">
                                <div class="map" id="map"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <p>Metode Pengiriman<span>*</span></p>
                                    <select class="form-control w-100" name="shipping_method" id="shipping_method"
                                        v-model="selectedCourier" v-on:change="checkRates">
                                        <option selected disabled value="">Pilih Kurir</option>
                                        @foreach ($courier as $c)
                                            <option value="{{ $c->code }}">{{ $c->courier_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('shipping_method')
                                        <div class="invalid-feedback" for="shipping_method">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <p>Tipe<span>*</span></p>
                                    <select class="form-control w-100" name="type" id="type" v-model="type"
                                        v-on:change="applyRate">
                                        <option selected disabled value="" data-price="0">Pilih Tipe Pengiriman
                                        </option>
                                        <option v-for="rate in rates" :value="rate.courier_service_code"
                                            :key="rate.courier_service_code" v-html="rate.courier_service_name"
                                            v-bind:data-price="rate.price"></option>
                                    </select>
                                    @error('tipe_pengiriman')
                                        <div class="invalid-feedback" for="shipping_method">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="checkout__order">
                                <h4>Pesanan Kamu</h4>
                                <div class="checkout__order__products">Produk <span>Total</span></div>
                                <ul>
                                    @foreach ($shopping_carts as $s)
                                        <li>{{ $s->product->product_name . ' x ' . $s->qty }} <span>
                                                {{ $s->product->discount > 0
                                                    ? currencyIDR($s->product->price - ($s->product->price * $s->product->discount) / 100) * $s->qty
                                                    : currencyIDR($s->product->price * $s->qty) }}</span>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="checkout__order__subtotal">Subtotal <span>{{ currencyIDR($cart_total) }}</span>
                                </div>
                                <div class="checkout__order__shipping">Ongkir <span v-text="rateIDR"></span></div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-8">
                                        <input class="form-control" v-model="coupon" type="text"
                                            placeholder="Pakai kode kupon kamu">
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-secondary mt-0 btn-apply-coupon" v-on:click="applyCoupon"
                                            type="button">PAKAI</button>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <span class="text-success" v-text="successMessage"></span>
                                        <span class="text-danger" v-text="errorMessage"></span>
                                    </div>
                                </div>
                                <div class="checkout__order__shipping">Diskon Kupon <span v-text="disountIDR"></span>
                                </div>
                                <div class="checkout__order__total">Total <span v-text="totalIDR"></span></div>
                                <div class="checkout__order__total payment-method">
                                    <div class="mb-2">Metode Pembayaran</div>
                                    <div class="row align-items-center">
                                        @foreach ($payment_methods as $pm)
                                            <div class="col-3">
                                                <div class="px-3 icon-payment-container row align-items-center"
                                                    v-on:click="selectPaymentMethod('{{ $pm->code }}')">
                                                    <img src="{{ asset('storage/' . $pm->icon_url) }}" alt="">
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                <button type="submit" class="site-btn">BUAT PESANAN</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
