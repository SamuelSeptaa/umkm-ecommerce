@extends('layout.index')
@section('content')
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container" id="cart-el">
            <div class="row">
                <div class="col-lg-12">
                    @if ($carts->isEmpty())
                        <h3 class="text-center">Keranjang Masih Kosong</h3>
                    @else
                        <form action="#" id="cart-form">
                            <div class="shoping__cart__table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="shoping__product">Produk</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @csrf
                                        @foreach ($carts as $c)
                                            <tr
                                                class="{{ $c->product->status == 'DRAFT' || $c->product->stock < $c->qty ? 'cart-error' : '' }}">
                                                <td class="shoping__cart__item">
                                                    <div class="ml-3">
                                                        <img src="{{ asset('storage/' . $c->product->image_url) }}"
                                                            alt="">
                                                        <h5>{{ $c->product->product_name }}</h5>
                                                        @if ($c->product->status == 'DRAFT')
                                                            <div class="text-center mt-2">
                                                                <div class="text-danger text-error">Yah, kamu belum bisa
                                                                    checkout produk ini :(</div>
                                                            </div>
                                                        @elseif($c->product->stock < $c->qty)
                                                            <div class="text-center mt-2">
                                                                <div class="text-danger text-error">Maaf, produk ini hanya
                                                                    tersisa sebanyak {{ $c->product->stock }} </div>
                                                            </div>
                                                        @endif
                                                        <input type="hidden" name="product_id[]"
                                                            value="{{ $c->product_id }}">
                                                    </div>
                                                </td>
                                                <td class="shoping__cart__price">
                                                    @if ($c->product->discount > 0)
                                                        {{ currencyIDR($c->product->price - ($c->product->price * $c->product->discount) / 100) }}
                                                        <span
                                                            class="del text-sm">{{ currencyIDR($c->product->price) }}</span>
                                                    @else
                                                        {{ currencyIDR($c->product->price) }}
                                                    @endif
                                                </td>
                                                <td class="shoping__cart__quantity">
                                                    <div class="quantity">
                                                        <div class="pro-qty">
                                                            @php
                                                                if ($c->product->discount > 0) {
                                                                    $price = $c->product->price - ($c->product->price * $c->product->discount) / 100;
                                                                } else {
                                                                    $price = $c->product->price;
                                                                }
                                                            @endphp
                                                            <span v-on:click="decreaseQty"class="dec qtybtn">-</span>
                                                            <input type="text" class="qty" name="qty[]"
                                                                value="{{ $c->qty }}"
                                                                data-maxqty="{{ $c->product->stock }}"
                                                                data-price="{{ $price }}" v-on:keyup="onlyNumber">
                                                            <span v-on:click="increaseQty"class="inc qtybtn">+</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="shoping__cart__total">
                                                    @if ($c->product->discount > 0)
                                                        {{ currencyIDR(($c->product->price - ($c->product->price * $c->product->discount) / 100) * $c->qty) }}
                                                    @else
                                                        {{ currencyIDR($c->product->price * $c->qty) }}
                                                    @endif
                                                </td>
                                                <td class="shoping__cart__item__close">
                                                    <div class="text-center">
                                                        <span v-on:click="removeItem" class="icon_close"></span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    @endif

                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{ route('shop') }}" class="primary-btn cart-btn btn-hover-green">LANJUTIN BELANJA</a>
                        @if (!$carts->isEmpty())
                            <button class="btn btn-info primary-btn cart-btn-right" id="update-cart"></span>
                                Upadate Cart</button>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end">
                        <div class="col-lg-6">
                            <div class="shoping__checkout">
                                <h5>Cart Total</h5>
                                <ul>
                                    <li>Total <span v-text="totalIdr"></span></li>
                                </ul>
                                <a href="{{ $carts->isEmpty() ? '#' : route('checkout') }}"
                                    class="primary-btn btn-info">LANJUT
                                    CHECKOUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection
