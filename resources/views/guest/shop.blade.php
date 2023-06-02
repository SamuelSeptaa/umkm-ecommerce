@extends('layout.index')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('ogani') }}/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>BELANJA</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('index') }}">Home</a>
                            <span>Belanja</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Semua Toko</h4>
                            <ul>
                                @foreach ($shops as $s)
                                    @php
                                        $shop = '';
                                        if (array_key_exists('shop', $query)) {
                                            $shop = $query['shop'];
                                        }
                                        $activeQueryShop = $query;
                                        $activeQueryShop['shop'] = $s->slug;
                                    @endphp
                                    <li><a class="{{ $shop == $s->slug ? 'active' : '' }}"
                                            href="{{ route('shop', $activeQueryShop) }}">{{ $s->shop_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        {{-- <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="sidebar__item">
                            <h4>Berdasarkan Kategori</h4>
                            @foreach ($categories as $c)
                                @php
                                    $category = '';
                                    if (array_key_exists('category', $query)) {
                                        $category = $query['category'];
                                    }
                                    $activeQuery = $query;
                                    $activeQuery['category'] = $c->slug;
                                @endphp
                                <div class="sidebar__item__size">
                                    <a href="{{ route('shop', $activeQuery) }}">
                                        <label class="{{ $category == $c->slug ? 'active' : '' }}">
                                            {{ $c->category }}
                                        </label>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="sidebar__item">
                            @if (count($query) > 0)
                                <div class="filter__item">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <a class="btn btn-sm btn-outline-success" href="{{ route('shop') }}">Bersihkan
                                                Filter</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    {{-- <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Sale Off</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{ asset('ogani') }}/img/product/discount/pd-1.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{ asset('ogani') }}/img/product/discount/pd-2.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Vegetables</span>
                                            <h5><a href="#">Vegetables’package</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{ asset('ogani') }}/img/product/discount/pd-3.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Mixed Fruitss</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{ asset('ogani') }}/img/product/discount/pd-4.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{ asset('ogani') }}/img/product/discount/pd-5.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{ asset('ogani') }}/img/product/discount/pd-6.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        @foreach ($products as $p)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__discount__item mb-5">
                                    <div class="product__discount__item__pic set-bg"
                                        data-setbg="{{ asset($p->image_url) }}">
                                        @if ($p->discount > 0)
                                            <div class="product__discount__percent">{{ "-$p->discount%" }}</div>
                                        @endif
                                        <ul class="product__item__pic__hover">
                                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <span>{{ $p->shop->shop_name }}</span>
                                        <h5><a href="#">{{ $p->product_name }}</a></h5>
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
                    <div class="product__pagination mt-3 text-center">
                        @php
                            $maxPageShow = 6;
                            $showedPage = 0;
                        @endphp
                        @if ($products->lastPage() > 1)
                            @if ($products->currentPage() != 1)
                                @php
                                    $query['page'] = $products->currentPage() - 1;
                                @endphp
                                <a href="{{ route('shop', $query) }}"><i class="fa fa-long-arrow-left"></i></a>
                            @endif

                            @for ($i = $products->currentPage() - 2; $i <= $products->lastPage(); $i++)
                                @php
                                    $showedPage++;
                                    if ($showedPage == $maxPageShow) {
                                        break;
                                    }
                                    $query['page'] = $i;
                                @endphp
                                @if ($i >= 1)
                                    <a class="{{ $products->currentPage() == $i ? 'active' : '' }}"
                                        href="{{ route('shop', $query) }}">{{ $i }}</a>
                                @endif
                            @endfor

                            @if ($products->currentPage() != $products->lastPage())
                                @php
                                    $query['page'] = $products->currentPage() + 1;
                                @endphp
                                <a href="{{ route('shop', $query) }}"><i class="fa fa-long-arrow-right"></i></a>
                            @endif
                        @endif
                        {{--
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection
