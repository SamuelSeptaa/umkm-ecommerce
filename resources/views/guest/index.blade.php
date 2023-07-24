@extends('layout.index')
@section('content')
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Semua Toko</span>
                        </div>
                        <ul>
                            @foreach ($shops as $s)
                                <li><a href="{{ route('shop', ['shop' => $s->slug]) }}">{{ $s->shop_name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="{{ route('shop') }}">
                                <input type="text" name="search" placeholder="Mau nyari apa?">
                                <button type="submit" class="site-btn">CARI</button>
                            </form>

                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+62 831-5044-7278</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="{{ asset('ogani/img/hero/banner.jpg') }}">
                        <div class="hero__text">
                            <span>PALANGKA RAYA FOOD</span>
                            <h2>100% ENAK</h2>
                            <a href="#" class="primary-btn">BELANJA SEKARANG</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach ($categories as $c)
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{ asset('storage/' . $c->thumbnail) }}">
                                <h5><a href="{{ route('shop', ['category' => $c->slug]) }}">{{ $c->category }}</a></h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Produk Teratas</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach ($categories as $c)
                                <li data-filter=".{{ $c->slug }}">{{ $c->category }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter" id="product-featured-list">
                @foreach ($featured as $f)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $f->product->category->slug }}">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg"
                                data-setbg="{{ asset('storage/' . $f->product->image_url) }}">
                                <ul class="featured__item__pic__hover">
                                    <li><button v-on:click="addFavorit({{ $f->product->id }})"
                                            class="{{ in_array($f->product->id, $favorit) ? 'active' : '' }}"><i
                                                class="fa fa-heart"></i></button></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="#">{{ $f->product->product_name }}</a></h6>
                                <h5>{{ currencyIDR($f->product->price) }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="latest-product__text">
                        <h4>Produk Terbaru</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($latest_product_1 as $l)
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <div class="product-image-slider"
                                                style="background-image: url({{ asset('storage/' . $l->image_url) }});">
                                            </div>
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $l->product_name }}</h6>
                                            <span>{{ currencyIDR($l->price) }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach ($latest_product_2 as $l)
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <div class="product-image-slider"
                                                style="background-image: url({{ asset('storage/' . $l->image_url) }});">
                                            </div>
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $l->product_name }}</h6>
                                            <span>{{ currencyIDR($l->price) }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="latest-product__text">
                        <h4>Produk Terlaris</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($best_selling_1 as $l)
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <div class="product-image-slider"
                                                style="background-image: url({{ asset('storage/' . $l->image_url) }});">
                                            </div>
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $l->product_name }}</h6>
                                            <span>{{ currencyIDR($l->price) }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach ($best_selling_2 as $l)
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <div class="product-image-slider"
                                                style="background-image: url({{ asset('storage/' . $l->image_url) }});">
                                            </div>
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $l->product_name }}</h6>
                                            <span>{{ currencyIDR($l->price) }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($latest_blog as $b)
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="{{ asset('storage/' . $b->image_url) }}" alt="">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i> {{ parseTanggal($b->created_at) }}</li>
                                </ul>
                                <h5><a href="{{ $b->slug }}">{{ $b->title }}</a></h5>
                                <p>{{ $b->info }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
