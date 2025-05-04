@extends('frontend.layouts.app')

@section('title')
    {{ $title ?? '' }}
@endsection

@section('meta')
    <meta property="og:title" content="{{ $seo->title ?? $og_title }}" />
    <meta property="og:description" content="{{ $seo->description ?? $og_description }}" />
    <meta property="og:image" content="{{ asset($seo->image ?? $og_image) }}" />
    <meta name="description" content="{{ $seo->meta_description ?? $og_description }}">
    <meta name="keywords" content="{{ $seo->keywords ?? $meta_keywords }}">
@endsection
@push('style')

@endpush
@php
    $localLanguage = Session::get('languageName');
@endphp
@section('content')
    <!-- ======================= breadcrumb start  ============================ -->
@section('breadcrumb')
<li class="breadcrumb-li">
    <span class="breadcrumb-text">{{ $title }}</span>
</li>
    {{-- <li class="breadcrumb-item"> {{ $title }}</li> --}}
@endsection
<!-- ======================= breadcrumb end  ============================ -->

<section class="main-content-wrap bg-color shop-page section-ptb">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="pro-grli-wrapper left-side-wrap">
                    <div class="pro-grli-wrap product-grid">
                        <div class="collection-img-wrap">
                            <h6 class="st-title" >Product list left ({{ $all_product->total() }})</h6>
                            <!-- collection info start -->
                            <div class="collection-info">
                                <div class="collection-image" >
                                    <img src="{{ asset('frontend/asset/img/banner/sall-banner.jpg') }}" class="img-fluid" alt="sall-banner">
                                </div>
                            </div>
                            <!-- collection info end -->
                        </div>
                        <!-- shop-top-bar start -->
                        <div class="shop-top-bar wow">
                            <div class="product-filter without-sidebar">
                                <button class="filter-button" type="button"><i class="fa-solid fa-filter"></i><span>Filter</span></button>
                            </div>
                            <div class="product-view-mode">
                                <!-- shop-item-filter-list start -->
                                <a href="javascript:void(0)" class="list-change-view grid-three active" data-grid-view="3"><i class="fa-solid fa-border-all"></i></a>
                                <a href="javascript:void(0)" data-grid-view="1" class="list-change-view list-one"><i class="fa-solid fa-list"></i></a>
                                <!-- shop-item-filter-list end -->
                            </div>
                            <!-- product-short start -->
                            <div class="product-short">
                                <label for="SortBy nice-select">Sort by:</label>
                                <select name="sortby" id="sortby" class="form-control">
                                    <option value="" class="d-none">Sort By</option>
                                    <option value="az" {{ request('sortby') == 'az' ? 'selected' : '' }}>A - Z</option>
                                    <option value="za" {{ request('sortby') == 'za' ? 'selected' : '' }}>Z - A</option>
                                    <option value="price_high_low" {{ request('sortby') == 'price_high_low' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="price_low_high" {{ request('sortby') == 'price_low_high' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="date" {{ request('sortby') == 'date' ? 'selected' : '' }}>Date</option>
                                </select>

                                <a href="javascript:void(0)" class="short-title">
                                    <span class="sort-title">Best Selling</span>
                                    <span class="sort-icon"><i class="bi bi-chevron-down"></i></span>
                                </a>
                                <a href="javascript:void(0)" class="short-title short-title-lg">
                                    <span class="sort-title">Best Selling</span>
                                    <span class="sort-icon"><i class="bi bi-chevron-down"></i></span>
                                </a>
                                <ul class="pro-ul collapse">
                                    <li class="pro-li"><a href="javascript:void(0)">Featured</a></li>
                                    <li class="pro-li selected"><a href="javascript:void(0)">Best Selling</a></li>
                                    <li class="pro-li"><a href="javascript:void(0)">Alphabetically, A-Z</a></li>
                                    <li class="pro-li"><a href="javascript:void(0)">Alphabetically, Z-A</a></li>
                                    <li class="pro-li"><a href="javascript:void(0)">Price, low to high</a></li>
                                    <li class="pro-li"><a href="javascript:void(0)">Price, high to low</a></li>
                                    <li class="pro-li"><a href="javascript:void(0)">Date, new to old</a></li>
                                    <li class="pro-li"><a href="javascript:void(0)">Date, old to new</a></li>
                                </ul>
                            </div>
                            <!-- product-short end -->
                        </div>
                        <!-- shop-top-bar end -->
                        <!-- Latest-product start -->
                        <div class="special-product grid-3">
                            <div class="collection-category">
                                <div class="row">
                                    <div class="col">
                                        <div class="collection-wrap">
                                            <ul class="product-view-ul">
                                                @forelse ($all_product as $row)
                                                    <li class="pro-item-li" >
                                                        <div class="single-product-wrap">
                                                            <div class="product-image banner-hover">
                                                                <a href="{{ route('productDetails', $row->slug) }}" class="pro-img">
                                                                    <img src="{{ asset($row->thumbnail ?? '') }}" class="img-fluid img1 mobile-img1" alt="p1">
                                                                    {{-- <img src="img/product/home1-pro-2.jpg" class="img-fluid img2 mobile-img2" alt="p2"> --}}
                                                                </a>
                                                                <div class="product-action">
                                                                    <a href="#quickview" class="quickview" data-bs-toggle="modal" data-bs-target="#quickview">
                                                                        <span class="tooltip-text">Quickview</span>
                                                                        <span class="pro-action-icon"><i class="feather-eye"></i></span>
                                                                    </a>
                                                                    <a href="javascript:void(0)" data-id="{{ $row->id }}" class="addToCart add-to-cart" data-bs-toggle="modal" data-bs-target="#add-to-cart">
                                                                        <span class="tooltip-text">Add to cart</span>
                                                                        <span class="pro-action-icon"><i class="feather-shopping-bag"></i></span>
                                                                    </a>
                                                                    @php
                                                                        $isInWishlist =
                                                                            auth()->check() &&
                                                                            auth()->user()->wishlist->contains('product_id', $row->id);
                                                                    @endphp
                                                                    <a href="javascript:void(0)" data-id="{{ $row->id }}" class="wishlist addToWishlist">
                                                                        <span class="tooltip-text">Wishlist</span>
                                                                        <span class="pro-action-icon">
                                                                            <i class="{{ $isInWishlist ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}"></i>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="product-caption">
                                                                <div class="product-content">
                                                                    <div class="product-sub-title">
                                                                        <span>Wireless device</span>
                                                                    </div>
                                                                    <div class="product-title">
                                                                        <h6><a href="{{ route('productDetails', $row->slug) }}">{{ $row->title }}</a></h6>
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
                                                                            {{-- <span class="new-price">$10.00</span>
                                                                            <span class="old-price">$15.00</span> --}}
                                                                        </div>
                                                                    </div>
                                                                    {{-- <div class="product-description">
                                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                                    </div> --}}
                                                                    <div class="product-action">
                                                                        <a href="#quickview" class="quickview" data-bs-toggle="modal" data-bs-target="#quickview">
                                                                            <span class="tooltip-text">Quickview</span>
                                                                            <span class="pro-action-icon"><i class="feather-eye"></i></span>
                                                                        </a>
                                                                        <a href="javascript:void(0)" data-id="{{ $row->id }}" class="addToCart add-to-cart" data-bs-toggle="modal" data-bs-target="#add-to-cart">
                                                                            <span class="tooltip-text">Add to cart</span>
                                                                            <span class="pro-action-icon"><i class="feather-shopping-bag"></i></span>
                                                                        </a>
                                                                        <a href="javascript:void(0)" data-id="{{ $row->id }}" class="addToWishlist wishlist">
                                                                            <span class="tooltip-text">Wishlist</span>
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
                                                                    <div class="product-label pro-new-sale">
                                                                        <span class="product-label-title">Sale<span>{{ $row->discount }}%</span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <p>No Data Found</p>
                                                @endforelse
                                            </ul>
                                        </div>
                                        <div class="paginatoin-area">
                                            <ul class="pagination-page-box" >
                                                {{ $all_product->links() }}
                                                {{-- <li class="number active"><a href="javascript:void(0)" class="theme-glink">1</a></li>
                                                <li class="number"><a href="javascript:void(0)" class="gradient-text">2</a></li>
                                                <li class="page-next"><a href="javascript:void(0)" class="theme-glink"><i class="fa -solid fa-angle-right"></i></a></li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Latest-product end -->
                    </div>
                    <div class="pro-grli-wrap product-sidebar">
                        <div class="pro-grid-block">
                            <div class="shop-sidebar-inner">
                                <div class="shop-sidebar-wrap filter-sidebar">
                                    <!-- button start -->
                                    <button class="close-sidebar" type="button">
                                    <i class="fa-solid fa-xmark"></i>
                                    </button>
                                    <!-- button end -->
                                    <!-- filter-form start -->
                                    <div class="facets">
                                        <form class="facets-form">
                                            <div class="facets-wrapper">
                                                <!-- Product-Categories start -->
                                                <div class="shop-sidebar">
                                                    <h6 class="shop-title" >Categories</h6>
                                                    <a href="#collapse-5" data-bs-toggle="collapse" class="shop-title shop-title-lg" >Categories<i class="fa fa-angle-down"></i></a>
                                                    <div class="collapse show shop-element" id="collapse-5">
                                                        <ul class="brand-ul scrollbar">
                                                            @foreach ($category as $cat)
                                                                <li class="cat-checkbox" >
                                                                    <label class="checkbox-label">
                                                                        <a href="{{ route('shop', $cat->slug) }}"
                                                                            class="text-muted {{ request()->is('shop/' . $cat->slug) ? 'active' : '' }}">
                                                                            <span class="">{{ $cat->name }}</span>
                                                                        <span class="count-check">({{ $cat->products_count }})</span>
                                                                        <span class=""></span>
                                                                        </a>
                                                                        {{-- <input type="checkbox" class="cust-checkbox">
                                                                        <span class="check-name">{{ $cat->name }}</span>
                                                                        <span class="count-check">({{ $cat->products_count }})</span>
                                                                        <span class="cust-check"></span> --}}
                                                                    </label>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- Product-Categories end -->
                                                <div class="shop-sidebar sidebar-filter">
                                                    <h6 class="shop-title" >Filter</h6>
                                                    <a href="javascript:void(0)" class="shop-title shop-title-lg" >Filter</a>
                                                    <div class="filter-info" >
                                                        <span class="filter-count-text">{{ $all_product->total() }} products</span>
                                                        <span class="loading-spinner"><svg aria-hidden="true" focusable="false" role="presentation" class="spinner" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="path" fill="none" stroke-width="6" cx="33" cy="33" r="30"></circle></svg></span>
                                                    </div>
                                                </div>
                                                <div class="shop-sidebar sidebar-price">
                                                    <h6 class="shop-title" >Price</h6>
                                                    <a href="#collapse-3" data-bs-toggle="collapse" class="shop-title shop-title-lg" >Price</a>
                                                    <div class="filter-info" >
                                                        <span class="shop-price">The highest price is $89.00</span>
                                                        <facet-remove><a href="collection.html" class="reset-text">Reset</a></facet-remove>
                                                    </div>
                                                    <!-- Product-price start -->
                                                    <div class="collapse price-wrap" id="collapse-3">
                                                        <price-range class="price-range">
                                                            <div class="price-range-group group-range">
                                                                <input type="range" class="range" min="0" max="89" value="0" id="range1">
                                                                <input type="range" class="range" min="0" max="89" value="89" id="range2">
                                                            </div>
                                                            <div class="price-input-group group-input" >
                                                                <div class="price-range-input input-price">
                                                                    <label class="label-text">From</label>
                                                                    <span class="price-value">$</span>
                                                                    <span id="demo1" class="price-field">0</span>
                                                                </div>
                                                                <span class="price-range-delimeter">-</span>
                                                                <div class="price-range-input input-price">
                                                                    <label class="label-text">To</label>
                                                                    <span class="price-value">$</span>
                                                                    <span id="demo2" class="price-field">89</span>
                                                                </div>
                                                            </div>
                                                        </price-range>
                                                    </div>
                                                    <!-- Product-price end -->
                                                    <!-- More-filters start -->
                                                    {{-- <div class="shop-sidebar sidebar-open">
                                                        <h6 class="shop-title" >More filters</h6>
                                                        <a href="#collapse-6" data-bs-toggle="collapse" class="shop-title shop-title-lg" >More filters<i class="fa fa-angle-down"></i></a>
                                                        <div class="filter-info" >
                                                            <span class="shop-price">0 selected</span>
                                                            <facet-remove>
                                                            <a href="collection-list-right.html" class="reset-text">Reset</a>
                                                            </facet-remove>
                                                        </div>
                                                        <div class="collapse shop-element shop-flavor" id="collapse-6">
                                                            <ul class="brand-ul scrollbar">
                                                                <li class="cat-checkbox" >
                                                                    <label class="checkbox-label 16gb">
                                                                        <input type="checkbox" value="16gb" class="cust-checkbox">
                                                                        <span class="check-name">Air conditioner</span>
                                                                        <span class="count-check">(12)</span>
                                                                        <span class="cust-check"></span>
                                                                    </label>
                                                                </li>
                                                                <li class="cat-checkbox" >
                                                                    <label class="checkbox-label 32gb">
                                                                        <input type="checkbox" value="32gb" class="cust-checkbox">
                                                                        <span class="check-name">Portable speaker</span>
                                                                        <span class="count-check">(12)</span>
                                                                        <span class="cust-check"></span>
                                                                    </label>
                                                                </li>
                                                                <li class="cat-checkbox" >
                                                                    <label class="checkbox-label 64gb">
                                                                        <input type="checkbox" value="64gb" class="cust-checkbox">
                                                                        <span class="check-name">Wireless earbuds</span>
                                                                        <span class="count-check">(12)</span>
                                                                        <span class="cust-check"></span>
                                                                    </label>
                                                                </li>
                                                                <li class="cat-checkbox" >
                                                                    <label class="checkbox-label 500gb">
                                                                        <input type="checkbox" value="500gb" class="cust-checkbox">
                                                                        <span class="check-name">Ev charging plug</span>
                                                                        <span class="count-check">(12)</span>
                                                                        <span class="cust-check"></span>
                                                                    </label>
                                                                </li>
                                                                <li class="cat-checkbox" >
                                                                    <label class="checkbox-label 1tb">
                                                                        <input type="checkbox" value="1tb" class="cust-checkbox">
                                                                        <span class="check-name">DVD player slot</span>
                                                                        <span class="count-check">(12)</span>
                                                                        <span class="cust-check"></span>
                                                                    </label>
                                                                </li>
                                                                <li class="cat-checkbox" >
                                                                    <label class="checkbox-label 2tb">
                                                                        <input type="checkbox" value="2tb" class="cust-checkbox">
                                                                        <span class="check-name">Verse earphones</span>
                                                                        <span class="count-check">(12)</span>
                                                                        <span class="cust-check"></span>
                                                                    </label>
                                                                </li>
                                                                <li class="cat-checkbox" >
                                                                    <label class="checkbox-label 3tb">
                                                                        <input type="checkbox" value="3tb" class="cust-checkbox">
                                                                        <span class="check-name">Video shoot drone</span>
                                                                        <span class="count-check">(12)</span>
                                                                        <span class="cust-check"></span>
                                                                    </label>
                                                                </li>
                                                                <li class="cat-checkbox" >
                                                                    <label class="checkbox-label 3tb">
                                                                        <input type="checkbox" value="3tb" class="cust-checkbox">
                                                                        <span class="check-name">Collection right</span>
                                                                        <span class="count-check">(12)</span>
                                                                        <span class="cust-check"></span>
                                                                    </label>
                                                                </li>
                                                                <li class="cat-checkbox" >
                                                                    <label class="checkbox-label 3tb">
                                                                        <input type="checkbox" value="3tb" class="cust-checkbox">
                                                                        <span class="check-name">Wifro wi-fi camera</span>
                                                                        <span class="count-check">(12)</span>
                                                                        <span class="cust-check"></span>
                                                                    </label>
                                                                </li>
                                                                <li class="cat-checkbox" >
                                                                    <label class="checkbox-label 3tb">
                                                                        <input type="checkbox" value="3tb" class="cust-checkbox">
                                                                        <span class="check-name">Movie projector S8</span>
                                                                        <span class="count-check">(12)</span>
                                                                        <span class="cust-check"></span>
                                                                    </label>
                                                                </li>
                                                                <li class="cat-checkbox" >
                                                                    <label class="checkbox-label 3tb">
                                                                        <input type="checkbox" value="3tb" class="cust-checkbox">
                                                                        <span class="check-name">Wireless headphones</span>
                                                                        <span class="count-check">(12)</span>
                                                                        <span class="cust-check"></span>
                                                                    </label>
                                                                </li>
                                                                <li class="cat-checkbox" >
                                                                    <label class="checkbox-label 3tb">
                                                                        <input type="checkbox" value="3tb" class="cust-checkbox">
                                                                        <span class="check-name">Stylish for trimmer</span>
                                                                        <span class="count-check">(12)</span>
                                                                        <span class="cust-check"></span>
                                                                    </label>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div> --}}
                                                    <!-- More-filters end -->
                                                </div>
                                                {{-- <div class="shop-sidebar sidebar-product">
                                                    <h6 class="shop-title" >Product type</h6>
                                                    <a href="#collapse-2" data-bs-toggle="collapse" class="shop-title shop-title-lg" >Product type</a>
                                                    <div class="filter-info" >
                                                        <span class="shop-price no-js-hidden">0 selected</span>
                                                        <facet-remove>
                                                        <a href="collection.html" class="reset-text">Reset</a>
                                                        </facet-remove>
                                                    </div>
                                                    <div class="collapse filter-element" id="collapse-2" >
                                                        <ul class="brand-ul scrollbar">
                                                            <li class="brand-li">
                                                                <label class="cust-checkbox-label">
                                                                    <input type="checkbox" name="cust-checkbox" class="cust-checkbox">
                                                                    <span class="filter-name">Electon</span>
                                                                    <span class="count-check">(23)</span>
                                                                    <span class="cust-check"></span>
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="shop-sidebar sidebar-wedget">
                                                    <h6 class="shop-title" >Availability</h6>
                                                    <a href="#collapse-1" class="shop-title shop-title-lg" data-bs-toggle="collapse" >Availability</a>
                                                    <div class="filter-info" >
                                                        <span class="shop-price no-js-hidden">0 selected</span>
                                                        <facet-remove>
                                                        <a href="collection.html" class="reset-text">Reset</a>
                                                        </facet-remove>
                                                    </div>
                                                    <div class="collapse filter-element" id="collapse-1" >
                                                        <ul class="brnad-ul scrollbar">
                                                            <li class="availability">
                                                                <label class="cust-checkbox-label availability in-stock">
                                                                    <input type="checkbox" name="filter.v.availability" value="1" class="cust-checkbox">
                                                                    <span class="filter-name">In stock</span>
                                                                    <span class="count-check">(23)</span>
                                                                    <span class="cust-check"></span>
                                                                </label>
                                                            </li>
                                                            <li class="availability">
                                                                <label class="cust-checkbox-label availability in-stock">
                                                                    <input type="checkbox" name="filter.v.availability" value="1" class="cust-checkbox">
                                                                    <span class="filter-name">Out of stock</span>
                                                                    <span class="count-check">(1)</span>
                                                                    <span class="cust-check"></span>
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div> --}}
                                                {{-- <div class="shop-sidebar sidebar-wedget">
                                                    <h6 class="shop-title" >Brand</h6>
                                                    <a href="#reset" data-bs-toggle="collapse" class="shop-title shop-title-lg" >Brand</a>
                                                    <div class="filter-info" >
                                                        <span class="shop-price no-js-hidden">0 selected</span>
                                                        <facet-remove>
                                                        <a href="collection.html" class="reset-text">Reset</a>
                                                        </facet-remove>
                                                    </div>
                                                    <div class="collapse filter-element" id="reset" >
                                                        <ul class="brand-ul scrollbar">
                                                            <li class="brand-li">
                                                                <label class="cust-checkbox-label">
                                                                    <input type="checkbox" name="cust-checkbox" class="cust-checkbox">
                                                                    <span class="filter-name">Electon</span>
                                                                    <span class="count-check">(23)</span>
                                                                    <span class="cust-check"></span>
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </form>
                                    </div>
                                    <!-- filter-form end -->
                                </div>
                            </div>
                            <!-- sidebar img start -->
                            {{-- <div class="sidebar-banner banner-hover">
                                <a href="collection.html" class="sidebar-img banner-img">
                                    <span class="sidebar-banner-image" >
                                        <img src="img/banner/side-banner.jpg" class="img-fluid" alt="side-banner">
                                    </span>
                                    <span class="sidebar-banner-icon"><i class="bi bi-arrow-right-short"></i></span>
                                </a>
                            </div> --}}
                            <!-- sidebar img start -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('#sortby').on('change', function () {
                var sortby = $(this).val();
                var url = new URL(window.location.href);
                url.searchParams.set('sortby', sortby);

                window.location.href = url.toString();
            });
        });

        function filterProducts() {
            let min_price = document.getElementById('min_price').value;
            let max_price = document.getElementById('max_price').value;
            let urlParams = new URLSearchParams(window.location.search);

            if (min_price) {
                urlParams.set('min_price', min_price);
            } else {
                urlParams.delete('min_price');
            }

            if (max_price) {
                urlParams.set('max_price', max_price);
            } else {
                urlParams.delete('max_price');
            }

            window.location.search = urlParams.toString();
        }

    </script>
@endpush
