<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="{{ asset('ogani/') }}/img/logo.png" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul id="mobile-fav-and-cart">
            <li><a href="#"><i class="fa fa-heart"></i> <span v-text="counterFav"></span></a></li>
            <li><a href="{{ route('cart') }}"><i class="fa fa-shopping-bag"></i> <span v-text="counterCart"></span></a>
            </li>
        </ul>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__auth">
            @role('member')
                <div class="header__top__right__auth">
                    <a href="{{ route('profile') }}"><i class="fa fa-user"></i> {{ auth()->user()->name }}</a>
                </div>
            @else
                <div class="header__top__right__auth">
                    <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                </div>
            @endrole
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="{{ $active == 'Home' ? 'active' : '' }}"><a href="{{ route('index') }}">Home</a></li>
            <li class="{{ $active == 'Shop' ? 'active' : '' }}"><a href="{{ route('shop') }}">Shop</a></li>
            <li class="{{ $active == 'Blog' ? 'active' : '' }}"><a href="{{ route('blog') }}">Blog</a></li>
            <li><a href="./contact.html">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="header__top__right">
                        @role('member')
                            <div class="header__top__right__auth">
                                <a href="{{ route('profile') }}"><i class="fa fa-user"></i> {{ auth()->user()->name }}</a>
                            </div>
                        @else
                            <div class="header__top__right__auth">
                                <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                            </div>
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="./index.html"><img src="{{ asset('ogani/img/logo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="{{ $active == 'Home' ? 'active' : '' }}"><a href="{{ route('index') }}">Home</a>
                        </li>
                        <li class="{{ $active == 'Shop' ? 'active' : '' }}"><a href="{{ route('shop') }}">Shop</a>
                        </li>
                        <li class="{{ $active == 'Blog' ? 'active' : '' }}"><a href="{{ route('blog') }}">Blog</a>
                        </li>
                        <li><a href="./contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    @role('member')
                        <ul id="fav-and-cart">
                            <li><a href="#"><i class="fa fa-heart"></i> <span v-text="counterFav"></span></a></li>
                            <li><a href="{{ route('cart') }}"><i class="fa fa-shopping-bag"></i> <span
                                        v-text="counterCart"></span></a>
                            </li>
                        </ul>
                    @endrole
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
