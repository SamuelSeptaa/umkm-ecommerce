@extends('layout.index')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('ogani') }}/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $product->product_name }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('index') }}">Home</a>
                            <a href="{{ route('shop') }}">Shop</a>
                            <span>{{ $product->product_name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="{{ asset($product->image_url) }}"
                                alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text" id="product-detail">
                        <h3>{{ $product->product_name }}</h3>
                        <div class="product__details__price">
                            @if ($product->discount > 0)
                                {{ currencyIDR($product->price - ($product->price * $product->discount) / 100) }}
                                <span class="deleted-text">{{ currencyIDR($product->price) }}</span>
                            @else
                                {{ currencyIDR($product->price) }}
                            @endif
                        </div>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <span v-on:click="decreaseQty" class="dec qtybtn">-</span>
                                    <input type="text" name="quantity" v-model="quantity" v-on:keyup="onlyNumber">
                                    <span v-on:click="increaseQty" class="inc qtybtn">+</span>
                                </div>
                            </div>
                        </div>
                        <button class="btn primary-btn" v-on:click="addToCart({{ $product->id }})">ADD TO CART</button>
                        <button class="btn heart-icon {{ in_array($product->id, $favorit) ? 'active' : '' }}"
                            v-on:click="addFavorit({{ $product->id }})"><span class="icon_heart_alt"></span></button>
                        <ul>
                            <li><b>Ketersediaan</b> <span>{{ $product->stock }} tersedia</span></li>
                            <li><b>Toko</b> <span><a
                                        href="{{ route('shop', ['shop' => $product->shop->slug]) }}">{{ $product->shop->shop_name }}</a></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Informasi Produk</h6>
                                    {{ $product->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Produk Lainnya Dari Toko Ini</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($related as $p)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__discount__item mb-5">
                            <div class="product__discount__item__pic set-bg" data-setbg="{{ asset($p->image_url) }}">
                                @if ($p->discount > 0)
                                    <div class="product__discount__percent">{{ "-$p->discount%" }}</div>
                                @endif
                                <ul class="product__item__pic__hover">
                                    <li><button class="{{ in_array($p->id, $favorit) ? 'active' : '' }}"
                                            v-on:click="addFavorit('{{ $p->id }}')"><i
                                                class="fa fa-heart"></i></button></li>
                                    <li><button class="{{ in_array($p->id, $cart) ? 'active' : '' }}"
                                            v-on:click="addToCart('{{ $p->id }}')"><i
                                                class="fa fa-shopping-cart"></i></button>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__discount__item__text">
                                <span>{{ $p->shop->shop_name }}</span>
                                <h5><a href="{{ route('shop-detail', ['slug' => $p->slug]) }}">{{ $p->product_name }}</a>
                                </h5>
                                @if ($p->discount > 0)
                                    <div class="product__item__price">
                                        {{ currencyIDR($p->price - ($p->price * $p->discount) / 100) }}
                                        <span>{{ currencyIDR($p->price) }}</span>
                                    </div>
                                @else
                                    <div class="product__item__price">
                                        {{ currencyIDR($p->price) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
@endsection
