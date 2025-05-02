@extends('frontend.layouts.app')

@section('title')
    {{ $title ?? $setting->site_title }}
@endsection

@section('meta')
    <meta property="og:title" content="{{ $seo->title ?? $og_title }}" />
    <meta property="og:description" content="{{ $seo->description ?? $og_description }}" />
    <meta property="og:image" content="{{ asset($seo->image ?? $og_image) }}" />
    <meta name="description" content="{{ $seo->meta_description ?? $og_description }}">
    <meta name="keywords" content="{{ $seo->keywords ?? $meta_keywords }}">
@endsection

@push('style')
    <style>

    </style>
@endpush
@php
    $originalPrice = $row->price ?? 0;
    $discount = $row->discount ?? 0;
    if ($discount > 0 && $discount <= 100) {
        $discountedPrice = $originalPrice - $originalPrice * ($discount / 100);
    } else {
        $discountedPrice = max(0, $originalPrice - $discount);
    }
@endphp
@section('content')
    <main id="main-content">
        <!-- slider-area start-->
        <section class="slider-content">
            <div class="home-slider owl-carousel owl-theme" id="home-slider">
                @foreach ($sliders as $slider)
                    <div class="item">
                        <div class="slider-image-info">
                            <!-- slider-text start -->
                            <div class="slider-image">
                                <img src="{{ asset($slider->image) }}" class="img-fluid desk-img" alt="slider1">
                            </div>
                            <!-- slider-img end -->
                            <div class="container slider-info-content">
                                <div class="row">
                                    <div class="col">
                                        <div class="slider-info-wrap slider-content-left slider-text-left">
                                            <!-- slider-text start -->
                                            <div class="slider-info-text">
                                                @if ($slider->title || $slider->subtitle || $slider->button_text)
                                                    <div class="slider-text-info">
                                                        <span class="sub-title">{{ $slider->subtitle }}</span>
                                                        <h2><span>{{ $slider->title }}</span></h2>
                                                        @if ($slider->button_text)
                                                            <a href="{{ $slider->button_link }}"
                                                                class="btn btn-style">{{ $slider->button_text }}</a>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- slider-text end -->
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <!-- slider-area end -->
        <!-- category start -->
        <section class="category-shop section-pt">
            <div class="shop-category">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="section-capture">
                                <div class="section-title">
                                    <h2 data-animate="animate__fadeInUp"><span>Top categories</span></h2>
                                </div>
                            </div>
                            <div class="category-wrap">
                                <div class="cat-slider swiper" id="cat-slider8">
                                    <div class="swiper-wrapper">
                                        @foreach ($is_home_categories as $row)
                                            <div class="swiper-slide" data-animate="animate__fadeInUp">
                                                <div class="cat-info">
                                                    <div class="cat-img">
                                                        <a href="{{ route('shop', $row->slug) }}">
                                                            <img src="{{ $row->category_image }}" class="img-fluid"
                                                                alt="mobile">
                                                            <span class="cat-title">{{ $row->name }}</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="swiper-buttons">
                                    <div class="swiper-buttons-wrap">
                                        <button class="swiper-prev swiper-prev-cat8"><span><i
                                                    class="fa-solid fa-arrow-left"></i></span></button>
                                        <button class="swiper-next swiper-next-cat8"><span><i
                                                    class="fa-solid fa-arrow-right"></i></span></button>
                                    </div>
                                </div>
                                <div class="swiper-dots" data-animate="animate__fadeInUp">
                                    <div class="swiper-pagination swiper-pagination-cat8"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- category end -->
        <!-- banner-grid start -->
        @if ($is_highlighted_categories->count() > 0)
            <section class="home-banner-grid section-pt">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="banner-grid-block">
                                <ul class="banner-grid-ul">
                                    @foreach ($is_highlighted_categories as $category)
                                        <li class="banner-grid-li big-banner">
                                            <div class="banner-block">
                                                <a href="{{ route('shop', $category->slug) }}">
                                                    <span class="image-block">
                                                        <img src="{{ asset($category->category_image) }}" class="img-fluid"
                                                            alt="{{ $category->name }}">
                                                    </span>
                                                    <div class="banner-content banner-text-left banner-content-right">
                                                        {{-- <span class="subtitle" data-animate="animate__fadeInUp">60% Off</span> --}}
                                                        <h2 class="title" data-animate="animate__fadeInUp">
                                                            {{ $category->name }}</h2>
                                                        <span class="banner-button btn-style"
                                                            data-animate="animate__fadeInUp">
                                                            Shop now
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!-- banner-grid end -->
        <!-- our-service start -->
        <section class="our-service-area section-ptb">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <ul class="grid-wrap">
                            <li class="grid-wrapper" data-animate="animate__fadeInUp">
                                <div class="ser-block">
                                    <a href="javascript:void(0)">
                                        <span class="ser-icon">
                                            <img src="{{ asset('frontend/asset/img/service/home-ser1.png') }}"
                                                class="img-fluid" alt="service-1">
                                            <span></span>
                                        </span>
                                        <div class="service-text">
                                            <h6>Worldwide shipping</h6>
                                            <p>The generated is there was !</p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="grid-wrapper" data-animate="animate__fadeInUp">
                                <div class="ser-block">
                                    <a href="javascript:void(0)">
                                        <span class="ser-icon">
                                            <img src="{{ asset('frontend/asset/img/service/home-ser2.png') }}"
                                                class="img-fluid" alt="service-2">
                                            <span></span>
                                        </span>
                                        <div class="service-text">
                                            <h6>Secure payment</h6>
                                            <p>The generated is there was !</p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="grid-wrapper" data-animate="animate__fadeInUp">
                                <div class="ser-block">
                                    <a href="javascript:void(0)">
                                        <span class="ser-icon">
                                            <img src="{{ asset('frontend/asset/img/service/home-ser3.png') }}"
                                                class="img-fluid" alt="service-3">
                                            <span></span>
                                        </span>
                                        <div class="service-text">
                                            <h6>Return method</h6>
                                            <p>The generated is there was !</p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="grid-wrapper" data-animate="animate__fadeInUp">
                                <div class="ser-block">
                                    <a href="javascript:void(0)">
                                        <span class="ser-icon">
                                            <img src="{{ asset('frontend/asset/img/service/home-ser4.png') }}"
                                                class="img-fluid" alt="service-4">
                                            <span></span>
                                        </span>
                                        <div class="service-text">
                                            <h6>Best gift voucher</h6>
                                            <p>The generated is there was !</p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- our-service end -->
        <!-- product-tranding start -->
        @if ($new_arraivals->count() > 0)
            <section class="Trending-product bg-color section-ptb">
                <div class="collection-category">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="section-capture">
                                    <div class="section-title">
                                        <span class="sub-title" data-animate="animate__fadeInUp">Browse collection</span>
                                        <h2><span data-animate="animate__fadeInUp">Trending product</span></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            @foreach ($new_arraivals as $row)
                                <div class="col-md-3">
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="product-template.html" class="pro-img">
                                                <img src="{{ $row->thumbnail }}"
                                                    class="img-fluid img1 mobile-img1" alt="p1">
                                                <img src="{{ $row->thumbnail }}"
                                                    class="img-fluid img2 mobile-img2" alt="p2">
                                            </a>
                                            <div class="product-action">
                                                <a href="#quickview" class="quickview" data-bs-toggle="modal"
                                                    data-bs-target="#quickview">
                                                    <span class="tooltip-text">Quickview</span>
                                                    <span class="pro-action-icon"><i class="feather-eye"></i></span>
                                                </a>
                                                <a href="javascript:void(0)" data-id="{{ $row->id }}" class="add-to-cart addToCart">
                                                    <span class="tooltip-text">Add to cart</span>
                                                    <span class="pro-action-icon"><i class="feather-shopping-bag"></i></span>
                                                </a>
                                                @php
                                                    $isInWishlist =
                                                        auth()->check() &&
                                                        auth()->user()->wishlist->contains('product_id', $row->id);
                                                @endphp
                                                <a href="javascript:void(0)" data-id="{{ $row->id }}" class="wishlist addToWishlist">
                                                    <span class="tooltip-text">{{ $isInWishlist ? 'Added to Wishlist' : 'Add to Wishlist' }}</span>
                                                    <span class="pro-action-icon">
                                                        <i class="{{ $isInWishlist ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <div class="product-sub-title">
                                                <span>{{ $row->category->name ?? '' }}</span>
                                            </div>
                                            <div class="product-title">
                                                <h6><a href="product-template.html">{{ $row->title }}</a></h6>
                                            </div>
                                            <div class="product-price">
                                                <div class="pro-price-box">
                                                    @if ($row->discount && $row->discount > 0)
                                                    @php
                                                        $discountPrice = $row->price - ($row->price * $row->discount) / 100;
                                                    @endphp
                                                    <span class="new-price">
                                                        ${{ number_format($discountPrice, 2) }}
                                                    </span>
                                                    <span class="old-price">${{ number_format($row->price, 2) }}</span>
                                                @else
                                                    <span class="new-price">${{ number_format($row->price, 2) }}</span>
                                                @endif

                                                </div>
                                            </div>
                                            <div class="product-action">
                                                <a href="#quickview" class="quickview" data-bs-toggle="modal"
                                                    data-bs-target="#quickview">
                                                    <span class="tooltip-text">Quickview</span>
                                                    <span class="pro-action-icon"><i class="feather-eye"></i></span>
                                                </a>
                                                <a href="javascript:void(0)" data-id="{{ $row->id }}" class="add-to-cart addToCart">
                                                    <span class="tooltip-text">Add to cart</span>
                                                    <span class="pro-action-icon"><i class="feather-shopping-bag"></i></span>
                                                </a>
                                                @php
                                                    $isInWishlist =
                                                        auth()->check() &&
                                                        auth()->user()->wishlist->contains('product_id', $row->id);
                                                @endphp
                                                <a href="javascript:void(0)" data-id="{{ $row->id }}" class="wishlist addToWishlist">
                                                    <span class="tooltip-text">{{ $isInWishlist ? 'Added to Wishlist' : 'Add to Wishlist' }}</span>
                                                    <span class="pro-action-icon">
                                                        <i class="{{ $isInWishlist ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="pro-label-retting">
                                            <div class="product-ratting">
                                                <span class="pro-ratting">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </span>
                                            </div>
                                            @if ($row->discount && $row->discount > 0)
                                                <div class="product-label pro-new-sale">
                                                    <span class="product-label-title">Sale<span>{{ $row->discount }}%</span></span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="collection-button text-center pt-3" data-animate="animate__fadeInUp">
                            <a href="{{ route('shop') }}" class="btn btn-style2" data-animate="animate__fadeInUp">View all</a>
                        </div>
                    </div>
                </div>
                </div>
            </section>
        @endif
        <!-- product-tranding end -->
        <!-- deal-day start -->
        <section class="deal-day section-pt">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="deal-day-wrap">
                            <div class="deal-day-block deal-wrap">
                                <div class="deal-block" style="background-image: url('{{ asset('frontend/asset/img/deal/deal-bg.jpg') }}');">
                                    <div class="section-capture">
                                        <div class="section-title">
                                            <span data-animate="animate__fadeInUp" class="sub-title">Every day
                                                shopping</span>
                                            <h2 data-animate="animate__fadeInUp"><span>Deal of the days</span></h2>
                                        </div>
                                    </div>
                                    <div class="timer-section1" id="the-24h-countdown" data-animate="animate__fadeInUp">
                                        <ul class="clock"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- deal-day end -->
        <!-- test-area start -->
        <section class="testimonial section-ptb">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="testimonial-block">
                            <div class="section-capture">
                                <div class="section-title">
                                    <span class="sub-title" data-animate="animate__fadeInUp">1300+ Customer reviews</span>
                                    <h2 data-animate="animate__fadeInUp"><span>Our customer love</span></h2>
                                </div>
                            </div>
                            <div class="testi-wrap">
                                <div class="test-slider swiper" id="test-slider">
                                    <div class="swiper-wrapper">
                                        @foreach ($testimonials as $item)
                                            <div class="swiper-slide">
                                                <div class="testi-info">
                                                    <span class="auth-img">
                                                        <img src="{{ asset($item->image) }}" class="img-fluid" alt="test-1">
                                                    </span>
                                                    {{-- <div class="testi-review-block" data-animate="animate__fadeInUp">
                                                        <span class="testi-review">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa-regular fa-star"></i>
                                                        </span>
                                                        <span class="testi-comment">01 Comment</span>
                                                    </div> --}}
                                                    <p data-animate="animate__fadeInUp">{{ $item->details }}</p>
                                                    <div class="bottom-text">
                                                        <span class="icon" data-animate="animate__fadeInUp"><i
                                                                class="fa-solid fa-quote-left"></i></span>
                                                        <div class="title">
                                                            <h6 data-animate="animate__fadeInUp">{{ $item->name }}</h6>
                                                            {{-- <span data-animate="animate__fadeInUp">Store customer</span> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="swiper-buttons-wrap">
                                    <div class="swiper-buttons">
                                        <div class="swiper-buttons-wrap">
                                            <button class="swiper-prev swiper-prev-test"><span><i
                                                        class="fa-solid fa-arrow-left"></i></span></button>
                                            <button class="swiper-next swiper-next-test"><span><i
                                                        class="fa-solid fa-arrow-right"></i></span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- test-area end -->
        <!-- product-Featured  start -->
        <section class="Featured -product bg-color section-ptb">
            <div class="collection-category">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="section-capture">
                                <div class="section-title">
                                    <span class="sub-title" data-animate="animate__fadeInUp">Featured collection</span>
                                    <h2 data-animate="animate__fadeInUp"><span>Weekly bestseller</span></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="collection-wrap">
                                <div class="collection-slider swiper" id="Featured-product">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide" data-animate="animate__fadeInUp">
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="product-template.html" class="pro-img">
                                                        <img src="img/product/home1-pro-1.jpg"
                                                            class="img-fluid img1 mobile-img1" alt="p1">
                                                        <img src="img/product/home1-pro-2.jpg"
                                                            class="img-fluid img2 mobile-img2" alt="p2">
                                                    </a>
                                                    <div class="product-action">
                                                        <a href="#quickview" class="quickview" data-bs-toggle="modal"
                                                            data-bs-target="#quickview">
                                                            <span class="tooltip-text">Quickview</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-eye"></i></span>
                                                        </a>
                                                        <a href="#add-to-cart" class="add-to-cart" data-bs-toggle="modal"
                                                            data-bs-target="#add-to-cart">
                                                            <span class="tooltip-text">Add to cart</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-shopping-bag"></i></span>
                                                        </a>
                                                        <a href="wishlist-product.html" class="wishlist">
                                                            <span class="tooltip-text">Wishlist</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-heart"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <div class="product-sub-title">
                                                        <span>Wireless device</span>
                                                    </div>
                                                    <div class="product-title">
                                                        <h6><a href="product-template.html">Wireless headphones</a></h6>
                                                    </div>
                                                    <div class="product-price">
                                                        <div class="pro-price-box">
                                                            <span class="new-price">$21.00</span>
                                                            <span class="old-price">$25.00</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-description">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                            industry. Lorem Ipsum has been the industry's standard dummy
                                                            text ever since the 1500s.</p>
                                                    </div>
                                                    <div class="product-action">
                                                        <a href="#quickview" class="quickview" data-bs-toggle="modal"
                                                            data-bs-target="#quickview">
                                                            <span class="tooltip-text">Quickview</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-eye"></i></span>
                                                        </a>
                                                        <a href="#add-to-cart" class="add-to-cart" data-bs-toggle="modal"
                                                            data-bs-target="#add-to-cart">
                                                            <span class="tooltip-text">Add to cart</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-shopping-bag"></i></span>
                                                        </a>
                                                        <a href="wishlist-product.html" class="wishlist">
                                                            <span class="tooltip-text">Wishlist</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-heart"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="pro-label-retting">
                                                    <div class="product-ratting">
                                                        <span class="pro-ratting">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                        </span>
                                                    </div>
                                                    <div class="product-label pro-new-sale">
                                                        <span class="product-label-title">Sale<span>20%</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-animate="animate__fadeInUp">
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="product-template.html" class="pro-img">
                                                        <img src="img/product/home1-pro-3.jpg"
                                                            class="img-fluid img1 mobile-img1" alt="p1">
                                                        <img src="img/product/home1-pro-4.jpg"
                                                            class="img-fluid img2 mobile-img2" alt="p2">
                                                    </a>
                                                    <div class="product-action">
                                                        <a href="#quickview" class="quickview" data-bs-toggle="modal"
                                                            data-bs-target="#quickview">
                                                            <span class="tooltip-text">Quickview</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-eye"></i></span>
                                                        </a>
                                                        <a href="#add-to-cart" class="add-to-cart" data-bs-toggle="modal"
                                                            data-bs-target="#add-to-cart">
                                                            <span class="tooltip-text">Add to cart</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-shopping-bag"></i></span>
                                                        </a>
                                                        <a href="wishlist-product.html" class="wishlist">
                                                            <span class="tooltip-text">Wishlist</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-heart"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <div class="product-sub-title">
                                                        <span>Waterproof</span>
                                                    </div>
                                                    <div class="product-title">
                                                        <h6><a href="product-template.html">Wireless mouse</a></h6>
                                                    </div>
                                                    <div class="product-price">
                                                        <div class="pro-price-box">
                                                            <span class="new-price">$18.00</span>
                                                            <span class="old-price">$24.00</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-description">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                            industry. Lorem Ipsum has been the industry's standard dummy
                                                            text ever since the 1500s.</p>
                                                    </div>
                                                    <div class="product-action">
                                                        <a href="#quickview" class="quickview" data-bs-toggle="modal"
                                                            data-bs-target="#quickview">
                                                            <span class="tooltip-text">Quickview</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-eye"></i></span>
                                                        </a>
                                                        <a href="#add-to-cart" class="add-to-cart" data-bs-toggle="modal"
                                                            data-bs-target="#add-to-cart">
                                                            <span class="tooltip-text">Add to cart</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-shopping-bag"></i></span>
                                                        </a>
                                                        <a href="wishlist-product.html" class="wishlist">
                                                            <span class="tooltip-text">Wishlist</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-heart"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="pro-label-retting">
                                                    <div class="product-ratting">
                                                        <span class="pro-ratting">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                        </span>
                                                    </div>
                                                    <div class="product-label pro-new-sale">
                                                        <span class="product-label-title">Sale<span>14%</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-animate="animate__fadeInUp">
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="product-template.html" class="pro-img">
                                                        <img src="img/product/home1-pro-5.jpg"
                                                            class="img-fluid img1 mobile-img1" alt="p1">
                                                        <img src="img/product/home1-pro-6.jpg"
                                                            class="img-fluid img2 mobile-img2" alt="p2">
                                                    </a>
                                                    <div class="product-action">
                                                        <a href="#quickview" class="quickview" data-bs-toggle="modal"
                                                            data-bs-target="#quickview">
                                                            <span class="tooltip-text">Quickview</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-eye"></i></span>
                                                        </a>
                                                        <a href="#add-to-cart" class="add-to-cart" data-bs-toggle="modal"
                                                            data-bs-target="#add-to-cart">
                                                            <span class="tooltip-text">Add to cart</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-shopping-bag"></i></span>
                                                        </a>
                                                        <a href="wishlist-product.html" class="wishlist">
                                                            <span class="tooltip-text">Wishlist</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-heart"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <div class="product-sub-title">
                                                        <span>Live program</span>
                                                    </div>
                                                    <div class="product-title">
                                                        <h6><a href="product-template.html">Pen drivess</a></h6>
                                                    </div>
                                                    <div class="product-price">
                                                        <div class="pro-price-box">
                                                            <span class="new-price">$10.00</span>
                                                            <span class="old-price">$15.00</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-description">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                            industry. Lorem Ipsum has been the industry's standard dummy
                                                            text ever since the 1500s.</p>
                                                    </div>
                                                    <div class="product-action">
                                                        <a href="#quickview" class="quickview" data-bs-toggle="modal"
                                                            data-bs-target="#quickview">
                                                            <span class="tooltip-text">Quickview</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-eye"></i></span>
                                                        </a>
                                                        <a href="#add-to-cart" class="add-to-cart" data-bs-toggle="modal"
                                                            data-bs-target="#add-to-cart">
                                                            <span class="tooltip-text">Add to cart</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-shopping-bag"></i></span>
                                                        </a>
                                                        <a href="wishlist-product.html" class="wishlist">
                                                            <span class="tooltip-text">Wishlist</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-heart"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="pro-label-retting">
                                                    <div class="product-ratting">
                                                        <span class="pro-ratting">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                        </span>
                                                    </div>
                                                    <div class="product-label pro-new-sale">
                                                        <span class="product-label-title">Sale<span>22%</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-animate="animate__fadeInUp">
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="product-template.html" class="pro-img">
                                                        <img src="img/product/home1-pro-7.jpg"
                                                            class="img-fluid img1 mobile-img1" alt="p1">
                                                        <img src="img/product/home1-pro-8.jpg"
                                                            class="img-fluid img2 mobile-img2" alt="p2">
                                                    </a>
                                                    <div class="product-action">
                                                        <a href="#quickview" class="quickview" data-bs-toggle="modal"
                                                            data-bs-target="#quickview">
                                                            <span class="tooltip-text">Quickview</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-eye"></i></span>
                                                        </a>
                                                        <a href="#add-to-cart" class="add-to-cart" data-bs-toggle="modal"
                                                            data-bs-target="#add-to-cart">
                                                            <span class="tooltip-text">Add to cart</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-shopping-bag"></i></span>
                                                        </a>
                                                        <a href="wishlist-product.html" class="wishlist">
                                                            <span class="tooltip-text">Wishlist</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-heart"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <div class="product-sub-title">
                                                        <span>Waterproof watch</span>
                                                    </div>
                                                    <div class="product-title">
                                                        <h6><a href="product-template.html">Smart watch</a></h6>
                                                    </div>
                                                    <div class="product-price">
                                                        <div class="pro-price-box">
                                                            <span class="new-price">$32.00</span>
                                                            <span class="old-price">$38.00</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-description">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                            industry. Lorem Ipsum has been the industry's standard dummy
                                                            text ever since the 1500s.</p>
                                                    </div>
                                                    <div class="product-action">
                                                        <a href="#quickview" class="quickview" data-bs-toggle="modal"
                                                            data-bs-target="#quickview">
                                                            <span class="tooltip-text">Quickview</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-eye"></i></span>
                                                        </a>
                                                        <a href="#add-to-cart" class="add-to-cart" data-bs-toggle="modal"
                                                            data-bs-target="#add-to-cart">
                                                            <span class="tooltip-text">Add to cart</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-shopping-bag"></i></span>
                                                        </a>
                                                        <a href="wishlist-product.html" class="wishlist">
                                                            <span class="tooltip-text">Wishlist</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-heart"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="pro-label-retting">
                                                    <div class="product-ratting">
                                                        <span class="pro-ratting">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                        </span>
                                                    </div>
                                                    <div class="product-label pro-new-sale">
                                                        <span class="product-label-title">Sale<span>30%</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-animate="animate__fadeInUp">
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="product-template.html" class="pro-img">
                                                        <img src="img/product/home1-pro-9.jpg"
                                                            class="img-fluid img1 mobile-img1" alt="p1">
                                                        <img src="img/product/home1-pro-10.jpg"
                                                            class="img-fluid img2 mobile-img2" alt="p2">
                                                    </a>
                                                    <div class="product-action">
                                                        <a href="#quickview" class="quickview" data-bs-toggle="modal"
                                                            data-bs-target="#quickview">
                                                            <span class="tooltip-text">Quickview</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-eye"></i></span>
                                                        </a>
                                                        <a href="#add-to-cart" class="add-to-cart" data-bs-toggle="modal"
                                                            data-bs-target="#add-to-cart">
                                                            <span class="tooltip-text">Add to cart</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-shopping-bag"></i></span>
                                                        </a>
                                                        <a href="wishlist-product.html" class="wishlist">
                                                            <span class="tooltip-text">Wishlist</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-heart"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <div class="product-sub-title">
                                                        <span>Softness music</span>
                                                    </div>
                                                    <div class="product-title">
                                                        <h6><a href="product-template.html">Verse earphones</a></h6>
                                                    </div>
                                                    <div class="product-price">
                                                        <div class="pro-price-box">
                                                            <span class="new-price">$08.00</span>
                                                            <span class="old-price">$10.00</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-description">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                            industry. Lorem Ipsum has been the industry's standard dummy
                                                            text ever since the 1500s.</p>
                                                    </div>
                                                    <div class="product-action">
                                                        <a href="#quickview" class="quickview" data-bs-toggle="modal"
                                                            data-bs-target="#quickview">
                                                            <span class="tooltip-text">Quickview</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-eye"></i></span>
                                                        </a>
                                                        <a href="#add-to-cart" class="add-to-cart" data-bs-toggle="modal"
                                                            data-bs-target="#add-to-cart">
                                                            <span class="tooltip-text">Add to cart</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-shopping-bag"></i></span>
                                                        </a>
                                                        <a href="wishlist-product.html" class="wishlist">
                                                            <span class="tooltip-text">Wishlist</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-heart"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="pro-label-retting">
                                                    <div class="product-ratting">
                                                        <span class="pro-ratting">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                        </span>
                                                    </div>
                                                    <div class="product-label pro-new-sale">
                                                        <span class="product-label-title">Sale<span>20%</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-animate="animate__fadeInUp">
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="product-template.html" class="pro-img">
                                                        <img src="img/product/home1-pro-11.jpg"
                                                            class="img-fluid img1 mobile-img1" alt="p1">
                                                        <img src="img/product/home1-pro-12.jpg"
                                                            class="img-fluid img2 mobile-img2" alt="p2">
                                                    </a>
                                                    <div class="product-action">
                                                        <a href="#quickview" class="quickview" data-bs-toggle="modal"
                                                            data-bs-target="#quickview">
                                                            <span class="tooltip-text">Quickview</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-eye"></i></span>
                                                        </a>
                                                        <a href="#add-to-cart" class="add-to-cart" data-bs-toggle="modal"
                                                            data-bs-target="#add-to-cart">
                                                            <span class="tooltip-text">Add to cart</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-shopping-bag"></i></span>
                                                        </a>
                                                        <a href="wishlist-product.html" class="wishlist">
                                                            <span class="tooltip-text">Wishlist</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-heart"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <div class="product-sub-title">
                                                        <span>Rotation camera</span>
                                                    </div>
                                                    <div class="product-title">
                                                        <h6><a href="product-template.html">Wifro camera</a></h6>
                                                    </div>
                                                    <div class="product-price">
                                                        <div class="pro-price-box">
                                                            <span class="new-price">$32.00</span>
                                                            <span class="old-price">$39.00</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-description">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                            industry. Lorem Ipsum has been the industry's standard dummy
                                                            text ever since the 1500s.</p>
                                                    </div>
                                                    <div class="product-action">
                                                        <a href="#quickview" class="quickview" data-bs-toggle="modal"
                                                            data-bs-target="#quickview">
                                                            <span class="tooltip-text">Quickview</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-eye"></i></span>
                                                        </a>
                                                        <a href="#add-to-cart" class="add-to-cart" data-bs-toggle="modal"
                                                            data-bs-target="#add-to-cart">
                                                            <span class="tooltip-text">Add to cart</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-shopping-bag"></i></span>
                                                        </a>
                                                        <a href="wishlist-product.html" class="wishlist">
                                                            <span class="tooltip-text">Wishlist</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-heart"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="pro-label-retting">
                                                    <div class="product-ratting">
                                                        <span class="pro-ratting">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                        </span>
                                                    </div>
                                                    <div class="product-label pro-new-sale">
                                                        <span class="product-label-title">Sale<span>14%</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-animate="animate__fadeInUp">
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="product-template.html" class="pro-img">
                                                        <img src="img/product/home1-pro-13.jpg"
                                                            class="img-fluid img1 mobile-img1" alt="p1">
                                                        <img src="img/product/home1-pro-14.jpg"
                                                            class="img-fluid img2 mobile-img2" alt="p2">
                                                    </a>
                                                    <div class="product-action">
                                                        <a href="#quickview" class="quickview" data-bs-toggle="modal"
                                                            data-bs-target="#quickview">
                                                            <span class="tooltip-text">Quickview</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-eye"></i></span>
                                                        </a>
                                                        <a href="#add-to-cart" class="add-to-cart"
                                                            data-bs-toggle="modal" data-bs-target="#add-to-cart">
                                                            <span class="tooltip-text">Add to cart</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-shopping-bag"></i></span>
                                                        </a>
                                                        <a href="wishlist-product.html" class="wishlist">
                                                            <span class="tooltip-text">Wishlist</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-heart"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <div class="product-sub-title">
                                                        <span>Wireless device</span>
                                                    </div>
                                                    <div class="product-title">
                                                        <h6><a href="product-template.html">Bluetooth earbuds</a></h6>
                                                    </div>
                                                    <div class="product-price">
                                                        <div class="pro-price-box">
                                                            <span class="new-price">$44.00</span>
                                                            <span class="old-price">$48.00</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-description">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                            industry. Lorem Ipsum has been the industry's standard dummy
                                                            text ever since the 1500s.</p>
                                                    </div>
                                                    <div class="product-action">
                                                        <a href="#quickview" class="quickview" data-bs-toggle="modal"
                                                            data-bs-target="#quickview">
                                                            <span class="tooltip-text">Quickview</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-eye"></i></span>
                                                        </a>
                                                        <a href="#add-to-cart" class="add-to-cart"
                                                            data-bs-toggle="modal" data-bs-target="#add-to-cart">
                                                            <span class="tooltip-text">Add to cart</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-shopping-bag"></i></span>
                                                        </a>
                                                        <a href="wishlist-product.html" class="wishlist">
                                                            <span class="tooltip-text">Wishlist</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-heart"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="pro-label-retting">
                                                    <div class="product-ratting">
                                                        <span class="pro-ratting">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                        </span>
                                                    </div>
                                                    <div class="product-label pro-new-sale">
                                                        <span class="product-label-title">Sale<span>22%</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-animate="animate__fadeInUp">
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="product-template.html" class="pro-img">
                                                        <img src="img/product/home1-pro-15.jpg"
                                                            class="img-fluid img1 mobile-img1" alt="p1">
                                                        <img src="img/product/home1-pro-16.jpg"
                                                            class="img-fluid img2 mobile-img2" alt="p2">
                                                    </a>
                                                    <div class="product-action">
                                                        <a href="#quickview" class="quickview" data-bs-toggle="modal"
                                                            data-bs-target="#quickview">
                                                            <span class="tooltip-text">Quickview</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-eye"></i></span>
                                                        </a>
                                                        <a href="#add-to-cart" class="add-to-cart"
                                                            data-bs-toggle="modal" data-bs-target="#add-to-cart">
                                                            <span class="tooltip-text">Add to cart</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-shopping-bag"></i></span>
                                                        </a>
                                                        <a href="wishlist-product.html" class="wishlist">
                                                            <span class="tooltip-text">Wishlist</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-heart"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <div class="product-sub-title">
                                                        <span>Live program</span>
                                                    </div>
                                                    <div class="product-title">
                                                        <h6><a href="product-template.html">Projector leptop</a></h6>
                                                    </div>
                                                    <div class="product-price">
                                                        <div class="pro-price-box">
                                                            <span class="new-price">$55.00</span>
                                                            <span class="old-price">$58.00</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-description">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                            industry. Lorem Ipsum has been the industry's standard dummy
                                                            text ever since the 1500s</p>
                                                    </div>
                                                    <div class="product-action">
                                                        <a href="#quickview" class="quickview" data-bs-toggle="modal"
                                                            data-bs-target="#quickview">
                                                            <span class="tooltip-text">Quickview</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-eye"></i></span>
                                                        </a>
                                                        <a href="#add-to-cart" class="add-to-cart"
                                                            data-bs-toggle="modal" data-bs-target="#add-to-cart">
                                                            <span class="tooltip-text">Add to cart</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-shopping-bag"></i></span>
                                                        </a>
                                                        <a href="wishlist-product.html" class="wishlist">
                                                            <span class="tooltip-text">Wishlist</span>
                                                            <span class="pro-action-icon"><i
                                                                    class="feather-heart"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="pro-label-retting">
                                                    <div class="product-ratting">
                                                        <span class="pro-ratting">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                        </span>
                                                    </div>
                                                    <div class="product-label pro-new-sale">
                                                        <span class="product-label-title">Sale<span>30%</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="collection-button" data-animate="animate__fadeInUp">
                                        <a href="collection.html" class="btn btn-style2">View all item</a>
                                    </div>
                                </div>
                                <div class="swiper-buttons">
                                    <div class="swiper-buttons-wrap">
                                        <button class="swiper-prev swiper-prev-Featured"><span><i
                                                    class="feather-arrow-left"></i></span></button>
                                        <button class="swiper-next swiper-next-Featured"><span><i
                                                    class="feather-arrow-right"></i></span></button>
                                    </div>
                                </div>
                                <div class="swiper-dots">
                                    <div class="swiper-pagination swiper-pagination-Featured"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- product-Featured end -->
    </main>
@endsection

@push('script')
@endpush
