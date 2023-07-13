@extends('layout.index')
@section('content')
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container" id="cart-el">
            <div class="row">
                <div class="col-lg-12">
                    @if ($favorites->isEmpty())
                        <h3 class="text-center">Produk Favorit Anda masih kosong</h3>
                    @else
                        <form action="#" id="cart-form">
                            <div class="shoping__cart__table w-50">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="shoping__product">Produk</th>
                                            <th>Harga Kini</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @csrf
                                        @foreach ($favorites as $f)
                                            <tr>
                                                <td class="shoping__cart__item">
                                                    <div class="ml-3">
                                                        <img src="{{ asset('storage/' . $f->product->image_url) }}"
                                                            alt="">
                                                        <a href="{{ route('shop-detail', ['slug' => $f->product->slug]) }}">
                                                            <h5>{{ $f->product->product_name }}</h5>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="shoping__cart__total">
                                                    @if ($f->product->discount > 0)
                                                        {{ currencyIDR($f->product->price - ($f->product->price * $f->product->discount) / 100) }}
                                                        <span
                                                            class="del text-sm">{{ currencyIDR($f->product->price) }}</span>
                                                    @else
                                                        {{ currencyIDR($f->product->price) }}
                                                    @endif
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection
