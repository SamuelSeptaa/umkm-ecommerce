@extends('layout.index')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('ogani') }}/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Blog</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('index') }}">Home</a>
                            <span>Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                @foreach ($blog as $b)
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="{{ asset($b->image_url) }}" alt="">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i> {{ parseTanggal($b->created_at) }}</li>
                                </ul>
                                <h5><a href="{{ route('blog-detail', ['slug' => $b->slug]) }}">{{ $b->title }}</a></h5>
                                <p>{{ $b->info }}</p>
                                <a href="{{ route('blog-detail', ['slug' => $b->slug]) }}" class="blog__btn">READ MORE <span
                                        class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-lg-12">
                    <div class="product__pagination blog__pagination">
                        @php
                            $maxPageShow = 6;
                            $showedPage = 0;
                        @endphp
                        @if ($blog->lastPage() > 1)
                            @if ($blog->currentPage() != 1)
                                @php
                                    $query['page'] = $blog->currentPage() - 1;
                                @endphp
                                <a href="{{ route('blog', $query) }}"><i class="fa fa-long-arrow-left"></i></a>
                            @endif

                            @for ($i = $blog->currentPage() - 2; $i <= $blog->lastPage(); $i++)
                                @php
                                    $showedPage++;
                                    if ($showedPage == $maxPageShow) {
                                        break;
                                    }
                                    $query['page'] = $i;
                                @endphp
                                @if ($i >= 1)
                                    <a class="{{ $blog->currentPage() == $i ? 'active' : '' }}"
                                        href="{{ route('blog', $query) }}">{{ $i }}</a>
                                @endif
                            @endfor

                            @if ($blog->currentPage() != $blog->lastPage())
                                @php
                                    $query['page'] = $blog->currentPage() + 1;
                                @endphp
                                <a href="{{ route('blog', $query) }}"><i class="fa fa-long-arrow-right"></i></a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
