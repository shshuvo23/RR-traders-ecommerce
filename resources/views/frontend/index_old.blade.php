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
    <div class="intro-slider-container section_heading mb-0">
        <div class="owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl" data-owl-options='{"nav": false}'>
            @foreach ($sliders as $slider)
                <div class="intro-slide" style="background-image: url({{ asset($slider->image) }});">
                    @if ($slider->title || $slider->subtitle || $slider->button_text)
                        <div class="container intro-content">
                            <h3 class="intro-subtitle">{{ $slider->title }}</h3>
                            <h1 class="intro-title">{{ $slider->subtitle }}</h1>

                            @if ($slider->button_text)
                                <a href="{{ $slider->button_link }}" class="btn btn-primary">
                                    <span>{{ $slider->button_text }}</span>
                                    <i class="icon-long-arrow-right"></i>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
            {{-- <div class="intro-slide" style="background-image: url({{asset('frontend/assets/images/slider/slide-1.jpg')}});">
                <!-- <div class="container intro-content">
                    <h3 class="intro-subtitle">Bedroom Furniture</h3>
                    <h1 class="intro-title">Find Comfort <br>That Suits You.</h1>

                    <a href="#" class="btn btn-primary">
                        <span>Shop Now</span>
                        <i class="icon-long-arrow-right"></i>
                    </a>
                </div> -->
            </div>

            <div class="intro-slide" style="background-image: url({{asset('frontend/assets/images/slider/slide-2.jpg')}});">
                <!-- <div class="container intro-content">
                    <h3 class="intro-subtitle">Deals and Promotions</h3>
                    <h1 class="intro-title">Ypperlig <br>Coffee Table <br><span
                            class="text-primary"><sup>$</sup>49,99</span></h1>

                    <a href="#" class="btn btn-primary">
                        <span>Shop Now</span>
                        <i class="icon-long-arrow-right"></i>
                    </a>
                </div> -->
            </div>
            <div class="intro-slide" style="background-image: url({{asset('frontend/assets/images/slider/slide-3.jpg')}});">
            </div>
            <div class="intro-slide" style="background-image: url({{asset('frontend/assets/images/slider/slide-4.jpg')}});">
            </div> --}}
        </div>

        <span class="slider-loader text-white"></span>
    </div>

    <!-- Static Box Section -->
    <div class="icon-boxes-container d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side justify-content-lg-center">
                        <span class="icon-box-icon text-dark">
                            <i class="fas fa-shopping-basket"></i>
                        </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Exclusive Deals</h3>
                            <p>Price Beat Guarantee</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side justify-content-lg-center">
                        <span class="icon-box-icon text-dark">
                            <i class="fas fa-truck"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Fast Delivery</h3>
                            <p>Get your products within 3-5 days</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side justify-content-lg-center">
                        <span class="icon-box-icon text-dark">
                            <i class="fas fa-gift"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Quality Assurance</h3>
                            <p>Guaranteed top-quality products</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side justify-content-lg-center">
                        <span class="icon-box-icon text-dark">
                            <i class="fas fa-credit-card"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Secure Payments</h3>
                            <p>100% secure checkout process</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="categories_sec section_gap">
        <div class="container">
            <h2 class="title section_heading text-center" style="font-size: 0">Explore Popular Categories</h2>
            <div class="cat-blocks-container">
                <div class="row">
                    @foreach ($is_home_categories as $row)
                        <div class="col-6 col-sm-4 col-lg-2">
                            <a href="{{ route('shop', $row->slug) }}" class="cat-block">
                                <figure>
                                    <span>
                                        <img src="{{ $row->category_image }}" alt="Category image">
                                    </span>
                                </figure>

                                <h3 class="cat-block-title">{{ $row->name }}</h3>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Category Section -->
    @if ($is_highlighted_categories->count() > 0)
        <div class="section_gap category">
            <div class="container">
                <div class="row">
                    @if ($is_highlighted_categories->isNotEmpty())
                        {{-- First Category --}}
                        <div class="col-md-5 mb-2">
                            <div class="category-box card rounded-0 border-0 bg-transparent h-100">
                                <img src="{{ asset($is_highlighted_categories[0]->category_image) }}"
                                    class="card-img-top img-fluid h-100" alt="{{ $is_highlighted_categories[0]->name }}">
                                <div class="card-body category-box-inner px-5">
                                    <div class="category-content">
                                        <h3>{{ $is_highlighted_categories[0]->name }}</h3>
                                        {{-- <p>Starting at $123*</p> --}}
                                        <a href="{{ route('shop', $is_highlighted_categories[0]->slug) }}"
                                            class="btn rounded theme-btn">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Remaining Categories --}}
                        @if ($is_highlighted_categories->count() > 1)
                            <div class="col-md-7">
                                <div class="row">
                                    @foreach ($is_highlighted_categories->skip(1) as $category)
                                        <div class="col-md-6 mb-2">
                                            <div class="category-box card rounded-0 border-0 bg-transparent h-100">
                                                <img src="{{ asset($category->category_image) }}"
                                                    class="card-img-top img-fluid" alt="{{ $category->name }}">
                                                <div class="card-body category-box-inner px-5">
                                                    <div class="category-content">
                                                        <h3>{{ $category->name }}</h3>
                                                        {{-- <p>Starting at $123*</p> --}}
                                                        <a href="{{ route('shop', $category->slug) }}"
                                                            class="btn rounded theme-btn">Shop Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endif

    @if ($tranding_product->count() > 0)
        <div class="trending_section">
            <div class="container">
                <div class="heading heading-center">
                    <h2 class="title section_heading">Flash Sale</h2>
                </div>

                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                    data-owl-options='{
                    "nav": false,
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "480": {
                            "items":2
                        },
                        "768": {
                            "items":3
                        },
                        "992": {
                            "items":4
                        }
                    }
                }'>

                    @foreach ($tranding_product as $row)
                        {{-- @dd($row->category->name) --}}

                        <div class="product product-2 position-relative">
                            <ul class="listing-items">

                                {{-- <li>14"</li>
                                <li>Intel Core i5</li>
                                <li>16GB RAM</li>
                                <li>256GB SSD</li>
                                <li>Win 11</li> --}}
                                {{-- Max 5 Items --}}

                                @foreach ($row->feature as $feature)
                                    {{-- @dd() --}}
                                    <li>{{ $feature->feature }}</li>
                                    {{-- Max 5 items, break if more than 5 --}}
                                    @if ($loop->iteration >= 5)
                                        @break
                                    @endif
                                @endforeach
                            </ul>

                            <figure class="product-media">
                                <div class="product-cat">
                                    <a href="#">{{ $row->category->name ?? '-' }}</a>
                                </div>
                                <a href="{{ route('productDetails', $row->slug) }}">
                                    <img src="{{ asset($row->thumbnail) }}" alt="Product image" class="product-image">
                                </a>
                                <!-- <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>
                                    </div> -->
                            </figure>

                            <div class="product-body px-3 py-0">
                                <div class="product-action mb-1">
                                    <a href="javascript:void(0)" data-id="{{ $row->id }}"
                                        class="btn-product btn-cart addToCart open-offcanvas" title="Add to cart"><span>add to
                                            cart</span></a>
                                </div>
                                @php
                                    $isInWishlist =
                                        auth()->check() && auth()->user()->wishlist->contains('product_id', $row->id);
                                @endphp
                                <div class="product-action wishlist mb-2">
                                    <a href="javascript:void(0)" data-id="{{ $row->id }}"
                                        class="btn-product btn-wishlist addToWishlist" title="Add to Wishlist"><span>
                                            {{-- <i class="fa-regular fa-heart"></i> add to wishlist</span> --}}
                                            <i
                                                class="{{ $isInWishlist ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}"></i>
                                            <span>
                                                {{ $isInWishlist ? 'Added to Wishlist' : 'Add to Wishlist' }}
                                            </span>
                                    </a>
                                </div>
                                <div class="product-price">
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
                                    {{-- <span class="new-price">${{ $row->price ?? '' }}</span>
                                    @if ($row->discount != 0)
                                            <sup> <span class="old-price">${{ $row->discount }}</span> </sup>
                                    @endif --}}
                                </div>

                                <h3 class="product-title"><a
                                        href="{{ route('productDetails', $row->slug) }}">{{ $row->title ?? '' }}</a></h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if ($new_arraivals->count() > 0)
        <div class="new_arrivals">
            <div class="container mb-5">
                <div class="heading heading-center mb-3">
                    <h2 class="title section_heading">New Arrivals</h2>
                </div>
                <div class="products">
                    <div class="row justify-content-center">
                        @foreach ($new_arraivals as $row)
                            <div class="col-sm-6 col-md-4 col-lg-3 mb-1">
                                <div class="product product-2 position-relative">
                                    <ul class="listing-items">

                                        {{-- <li>14"</li>
                                        <li>Intel Core i5</li>
                                        <li>16GB RAM</li>
                                        <li>256GB SSD</li>
                                        <li>Win 11</li> --}}
                                        {{-- Max 5 Items --}}

                                        @foreach ($row->feature as $feature)
                                            {{-- @dd() --}}
                                            <li>{{ $feature->feature }}</li>
                                            {{-- Max 5 items, break if more than 5 --}}
                                            @if ($loop->iteration >= 5)
                                                @break
                                            @endif
                                        @endforeach
                                    </ul>


                                    <figure class="product-media">
                                        <div class="product-cat">
                                            <a href="#">{{ $row->category->name ?? '' }}</a>
                                        </div>
                                        <a href="{{ route('productDetails', $row->slug) }}">
                                            <img src="{{ $row->thumbnail }}" alt="Product image" class="product-image">
                                        </a>
                                        <!-- <div class="product-action-vertical">
                                                        <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>
                                                    </div> -->
                                    </figure>

                                    <div class="product-body px-3 py-0">
                                        <div class="product-action mb-1">
                                            <a href="javascript:void(0)" data-id="{{ $row->id }}"
                                                class="btn-product btn-cart addToCart open-offcanvas" title="Add to cart">
                                                <span>Add to Cart</span></a>
                                        </div>
                                        @php
                                            $isInWishlist =
                                                auth()->check() &&
                                                auth()->user()->wishlist->contains('product_id', $row->id);
                                        @endphp
                                        <div class="product-action wishlist mb-2">
                                            <a href="javascript:void(0)" data-id="{{ $row->id }}"
                                                class="btn-product btn-wishlist addToWishlist"
                                                title="Add to Wishlist"><span>
                                                    {{-- <i class="fa-regular fa-heart"></i> add to wishlist</span> --}}
                                                    <i
                                                        class="{{ $isInWishlist ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}"></i>
                                                    <span>
                                                        {{ $isInWishlist ? 'Added to Wishlist' : 'Add to Wishlist' }}
                                                    </span>
                                            </a>
                                        </div>
                                        <div class="product-price">
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
                                            {{-- <span class="new-price">${{ $row->price }}</span>
                                            @if ($row->discount != 0)
                                                <sup> <span class="old-price">${{ $row->discount }}</span> </sup>
                                            @endif --}}
                                        </div>

                                        <h3 class="product-title"><a
                                                href="{{ route('productDetails', $row->slug) }}">{{ $row->title }}</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="more-container text-center mt-5">
                    <a href="{{ route('shop') }}" class="btn btn-outline-darker btn-more">
                        <span>View more products</span>
                        <i class="icon-long-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('script')
@endpush
