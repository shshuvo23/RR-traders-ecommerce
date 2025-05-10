@extends('frontend.layouts.app')

@section('title')
    {{ $title ?? '' }}
@endsection

@section('meta')
    <meta property="og:title" content="{{ $product->title ?? $og_title }}" />
    <meta property="og:description" content="{{ Str::limit($product->short_description ?? $og_description, 160) }}" />
    <meta property="og:image" content="{{ asset($product->thumbnail ?? $og_image) }}" />
    <meta name="description" content="{{ Str::limit($product->short_description ?? $og_description, 160) }}">
    {{-- <meta name="keywords" content="{{ $product->keywords ?? $meta_keywords }}"> --}}
@endsection
@push('style')
    <style>
        div#social-links {
            margin: 0 auto;
            max-width: 500px;
        }

        div#social-links ul {
            margin: 0 !important;
        }

        div#social-links ul li {
            display: inline-block;
        }

        div#social-links ul li a {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            width: 30px;
            height: 30px;
            color: #777;
            margin: 0;
            background-color: transparent;
            border: .1rem solid #e1e2e6;
            border-radius: 50%;
            text-decoration: none;
            opacity: 1;
            transition: all .35s ease;
            margin: 0 3px;
        }
    </style>
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
@endsection
<!-- ======================= breadcrumb end  ============================ -->

<section class="product-details-page pro-style1 section-ptb">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="pro-details-pos pro-details-left-pos">
                    <!-- Product slider start -->
                    <div class="product-detail-slider product-details-tb product-details">
                        <a href="product-template7.html" class="next-prev-product prev">
                            <span>Prev</span>
                        </a>
                        <a href="product-template2.html" class="next-prev-product next">
                            <span>Next</span>
                        </a>
                        <!-- Product slider start -->
                        <div class="product-detail-img product-detail-img-bottom">
                            <!-- top slick-slider start -->
                            <div class="product-img-top">
                                <button class="full-view"><i class="bi bi-arrows-fullscreen"></i></button>
                                <div class="slider-big slick-slider">
                                    <div class="slick-slide ">
                                        <a href="img/product/home1-pro-1.jpg" class="product-single">
                                            <figure class="zoom" onmousemove="zoom(event)"
                                                style="background-image: url('img/product/home1-pro-1.jpg');">
                                                <img src="img/product/home1-pro-1.jpg" class="img-fluid" alt="pro-1">
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="img/product/home1-pro-2.jpg" class="product-single">
                                            <figure class="zoom" onmousemove="zoom(event)"
                                                style="background-image: url('img/product/home1-pro-2.jpg');">
                                                <img src="img/product/home1-pro-2.jpg" class="img-fluid" alt="pro-2">
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="img/product/home1-pro-3.jpg" class="product-single">
                                            <figure class="zoom" onmousemove="zoom(event)"
                                                style="background-image: url('img/product/home1-pro-3.jpg');">
                                                <img src="img/product/home1-pro-3.jpg" class="img-fluid" alt="pro-3">
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="img/product/home1-pro-4.jpg" class="product-single">
                                            <figure class="zoom" onmousemove="zoom(event)"
                                                style="background-image: url('img/product/home1-pro-4.jpg');">
                                                <img src="img/product/home1-pro-4.jpg" class="img-fluid" alt="pro-4">
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="img/product/home1-pro-5.jpg" class="product-single">
                                            <figure class="zoom" onmousemove="zoom(event)"
                                                style="background-image: url('img/product/home1-pro-5.jpg');">
                                                <img src="img/product/home1-pro-5.jpg" class="img-fluid" alt="pro-5">
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="img/product/home1-pro-6.jpg" class="product-single">
                                            <figure class="zoom" onmousemove="zoom(event)"
                                                style="background-image: url('img/product/home1-pro-6.jpg');">
                                                <img src="img/product/home1-pro-6.jpg" class="img-fluid" alt="p-6">
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="img/product/home1-pro-7.jpg" class="product-single">
                                            <figure class="zoom" onmousemove="zoom(event)"
                                                style="background-image: url('img/product/home1-pro-7.jpg');">
                                                <img src="img/product/home1-pro-7.jpg" class="img-fluid" alt="p-7">
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="img/product/home1-pro-8.jpg" class="product-single">
                                            <figure class="zoom" onmousemove="zoom(event)"
                                                style="background-image: url('img/product/home1-pro-8.jpg');">
                                                <img src="img/product/home1-pro-8.jpg" class="img-fluid" alt="pro-8">
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="img/product/home1-pro-9.jpg" class="product-single">
                                            <figure class="zoom" onmousemove="zoom(event)"
                                                style="background-image: url('img/product/home1-pro-9.jpg');">
                                                <img src="img/product/home1-pro-9.jpg" class="img-fluid" alt="pro-9">
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="img/product/home1-pro-10.jpg" class="product-single">
                                            <figure class="zoom" onmousemove="zoom(event)"
                                                style="background-image: url('img/product/home1-pro-10.jpg');">
                                                <img src="img/product/home1-pro-10.jpg" class="img-fluid" alt="pro-10">
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="img/product/home1-pro-11.jpg" class="product-single">
                                            <figure class="zoom" onmousemove="zoom(event)"
                                                style="background-image: url('img/product/home1-pro-11.jpg');">
                                                <img src="img/product/home1-pro-11.jpg" class="img-fluid" alt="pro-11">
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="img/product/home1-pro-12.jpg" class="product-single">
                                            <figure class="zoom" onmousemove="zoom(event)"
                                                style="background-image: url('img/product/home1-pro-12.jpg');">
                                                <img src="img/product/home1-pro-12.jpg" class="img-fluid" alt="pro-12">
                                            </figure>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- top slick-slider end -->
                            <!-- small slick-slider start -->
                            <div class="pro-slider">
                                <div class="slider-small pro-detail-slider small-slider">
                                    <div class="slick-slide ">
                                        <a href="javascript:void(0)" class="product-single--thumbnail">
                                            <img src="img/product/home1-pro-1.jpg" class="img-fluid" alt="pro-1">
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="javascript:void(0)" class="product-single--thumbnail">
                                            <img src="img/product/home1-pro-2.jpg" class="img-fluid" alt="pro-2">
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="javascript:void(0)" class="product-single--thumbnail">
                                            <img src="img/product/home1-pro-3.jpg" class="img-fluid" alt="pro-3">
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="javascript:void(0)" class="product-single--thumbnail">
                                            <img src="img/product/home1-pro-4.jpg" class="img-fluid" alt="pro-4">
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="javascript:void(0)" class="product-single--thumbnail">
                                            <img src="img/product/home1-pro-6.jpg" class="img-fluid" alt="pro-5">
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="javascript:void(0)" class="product-single--thumbnail">
                                            <img src="img/product/home1-pro-6.jpg" class="img-fluid" alt="pro-6">
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="javascript:void(0)" class="product-single--thumbnail">
                                            <img src="img/product/home1-pro-7.jpg" class="img-fluid" alt="pro-7">
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="javascript:void(0)" class="product-single--thumbnail">
                                            <img src="img/product/home1-pro-8.jpg" class="img-fluid" alt="pro-8">
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="javascript:void(0)" class="product-single--thumbnail">
                                            <img src="img/product/home1-pro-9.jpg" class="img-fluid" alt="pro-9">
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="javascript:void(0)" class="product-single--thumbnail">
                                            <img src="img/product/home1-pro-10.jpg" class="img-fluid" alt="pro-10">
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="javascript:void(0)" class="product-single--thumbnail">
                                            <img src="img/product/home1-pro-11.jpg" class="img-fluid" alt="pro-11">
                                        </a>
                                    </div>
                                    <div class="slick-slide ">
                                        <a href="javascript:void(0)" class="product-single--thumbnail">
                                            <img src="img/product/home1-pro-12.jpg" class="img-fluid" alt="pro-12">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- small slick-slider end -->
                        </div>
                        <!-- Product slider end -->
                    </div>
                    <!-- peoduct detail start -->
                    <div class="product-details-wrap product-details-tb product-details">
                        <div class="product-details-info">
                            <div class="pro-nprist">
                                <div class="product-info">
                                    <!--  product-ratting start -->
                                    <div class="product-ratting">
                                        <span class="pro-ratting">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </span>
                                        <span class="spr-badge-caption">3 Reviews</span>
                                    </div>
                                    <!--  product-ratting end -->
                                </div>
                                <div class="product-info">
                                    <!-- product-title start -->
                                    <div class="product-title">
                                        <h2>{{ $product->title }}</h2>
                                    </div>
                                    <!-- product-title end -->
                                </div>
                                <div class="product-info">
                                    <div class="pro-prlb pro-sale">
                                        <div class="price-box">
                                            @if ($product->discount && $product->discount > 0)
                                                @php
                                                    $discountPrice = $product->price - ($product->price * $product->discount) / 100;
                                                @endphp
                                                <span class="new-price">
                                                    ${{ number_format($discountPrice, 2) }}
                                                </span>
                                                <span class="old-price">
                                                    ${{ number_format($product->price, 2) }}
                                                </span>
                                            @else
                                                <span class="new-price" style="color: #000; font-weight: bold; font-size: 18px;">
                                                    ${{ number_format($product->price, 2) }}
                                                </span>
                                            @endif
                                            {{-- <span class="new-price">$21.00</span>
                                            <span class="old-price">$25.00</span> --}}
                                            <span class="percent-count">{{ $product->discount }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <div class="product-inventory">
                                        <div class="stock-inventory stock-more">
                                            <p class="text-success">Hurry up! only
                                                <span class="available-stock bg-success">4</span>
                                                <span>products left in stock!</span>
                                            </p>
                                        </div>
                                        <div class="product-variant">
                                            <h6>Availability:</h6>
                                            <span class="stock-qty in-stock text-success">
                                                <span>In stock<i class="bi bi-check2"></i></span>
                                            </span>
                                            <span class="stock-qty out-stock text-danger collapse" style="display:none;">
                                                <span>Out of stock</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <div class="pro-detail-action">
                                        <form method="get" class="cart">
                                            <div class="product-variant-option">
                                                <div class="swatch-variant">
                                                    <div class="swatch clearfix Color">
                                                        <div class="header">
                                                            <h6><span>Color</span></h6>
                                                        </div>
                                                        <div class="variant-wrap">
                                                            <div class="variant-property">
                                                                <div class="swatch-element Black first-variant">
                                                                    <input type="radio" name="option-0" value="Black" checked>
                                                                    <label>Black</label>
                                                                </div>
                                                                <div class="swatch-element Red">
                                                                    <input type="radio" name="option-0" value="Red">
                                                                    <label>Red</label>
                                                                </div>
                                                                <div class="swatch-element Green">
                                                                    <input type="radio" name="option-0" value="Green">
                                                                    <label>Green</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <form method="post" class="cart">
                                        <div class="product-quantity-action">
                                            <h6>Quantity:</h6>
                                            <div class="product-quantity">
                                                <div class="cart-plus-minus">
                                                    <button class="dec qtybutton minus"><i class="fa-solid fa-minus"></i></button>
                                                    <input type="number" id="qty" class="form-control" value="1" min="1"
                                                            max="{{ $product->stock }}" step="1" data-decimals="0" required>
                                                    {{-- <input type="text" name="quantity" value="1"> --}}
                                                    <button class="inc qtybutton plus"><i class="fa-solid fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="product-info">
                                    <div class="product-actions">
                                        <!-- pro-deatail button start -->
                                        <div class="pro-detail-button">
                                            <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                                class="btn add-to-cart addToCartproductdetails"><span>add to cart</span></a>
                                            {{-- <button type="button" onclick="location. href='cart-page.html'" class="btn add-to-cart ajax-spin-cart">
                                            <span class="cart-title">Add to cart</span> --}}
                                            </button>
                                            <a href="cart-empty.html" class="btn btn-cart btn-theme">
                                                <span>Buy now</span>
                                            </a>
                                        </div>
                                        <!-- pro-deatail button start -->
                                        <!-- pro-deatail wishlist start -->
                                        <div class="pro-aff-che">
                                            <a href="wishlist-product.html" class="wishlist">
                                                <span class="wishlist-icon action-wishlist tile-actions--btn wishlist-btn">
                                                    <span class="add-wishlist"><i class="bi bi-heart"></i></span>
                                                </span>
                                                <span class="wishlist-text">Wishlist</span>
                                            </a>
                                        </div>
                                        <!-- pro-deatail wishlist end -->
                                    </div>
                                </div>
                                <div class="product-info">
                                    <div class="form-group">
                                        <a href="#deliver-modal" data-bs-toggle="modal">Delivery &amp; return</a>
                                        <a href="#que-modal" data-bs-toggle="modal">Ask a question</a>
                                    </div>
                                </div>
                                <div class="modal fade deliver-modal" id="deliver-modal" tabindex="-1" style="display: none;"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="pop-close" data-bs-dismiss="modal" aria-label="Close"><i
                                                class="feather-x"></i></button>
                                                <div class="delivery-block">
                                                    <div class="space-block">
                                                        <h4>Delivery</h4>
                                                        <p>All orders shipped with UPS Express.</p>
                                                        <p>Always free shipping for orders over US $250.</p>
                                                        <p>All orders are shipped with a UPS tracking number.</p>
                                                    </div>
                                                    <div class="space-block">
                                                        <h4>Returns</h4>
                                                        <p>Items returned within 14 days of their original shipment date in same as new
                                                        condition will be eligible for a full refund or store credit.</p>
                                                        <p>Refunds will be charged back to the original form of payment used for purchase.</p>
                                                        <p>Customer is responsible for shipping charges when making returns and
                                                        shipping/handling fees of original purchase is non-refundable.</p>
                                                        <p>All sale items are final purchases.</p>
                                                    </div>
                                                    <div class="space-block">
                                                        <h4>Help</h4>
                                                        <p>Give us a shout if you have any other questions and/or concerns.</p>
                                                        <p>Email:<a href="mailto:contact@domain.com">demo@gmail.com</a></p>
                                                        <p>Phone:<a href="tel:+1(23)456789">+1 (23) 456 789</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- que-modal stat -->
                                <div class="modal fade que-modal" id="que-modal" aria-modal="true" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="pop-close" data-bs-dismiss="modal" aria-label="Close"><i
                                                class="feather-x"></i></button>
                                                <div class="product-form-list">
                                                    <div class="single-product-wrap">
                                                        <div class="product-image">
                                                            <a class="pro-img" href="collection.html">
                                                                <img class="img-fluid img1 resp-img1" src="img/product/home1-pro-12.jpg"
                                                                alt="p-1">
                                                                <img class="img-fluid img2 resp-img2" src="img/product/home1-pro-13.jpg"
                                                                alt="p-2">
                                                            </a>
                                                        </div>
                                                        <div class="product-content">
                                                            <div class="pro-title-price">
                                                                <h6><a href="product-template.html">Portable speaker</a></h6>
                                                                <div class="product-price">
                                                                    <div class="price-box">
                                                                        <span class="new-price">$44.00</span>
                                                                        <span class="old-price">$49.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ask-form">
                                                    <h6>Ask a question</h6>
                                                    <form method="post" class="contact-form">
                                                        <input type="hidden" name="contact[product url]" value="">
                                                        <div class="form-grp">
                                                            <input type="text" name="contact[name]" required="" placeholder="Your name*">
                                                            <input type="text" name="contact[phone]" placeholder="Your phone number">
                                                            <input type="email" name="contact[email]" required="" placeholder="Your email*">
                                                            <textarea name="contact[question]" rows="4" required=""
                                                            placeholder="Your message*"></textarea>
                                                            <p>* Required fields</p>
                                                            <button type="submit" class="btn-style2">Submit Now</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- que-modal end -->
                                <div class="product-info">
                                    <p><span>🚚</span> Item will be delivered on or before <span id="ten-days-ahead">Mar 3 2025</span></p>
                                </div>
                                <div class="product-info">
                                    <div class="product-sku">
                                        <h6>SKU:</h6>
                                        <span class="variant-sku">abccd-13</span>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <div class="share-icons">
                                        <h6>Share:</h6>
                                        <div class="pro-social">
                                            <ul class="social-icon">
                                                <li class="facebook">
                                                    <a href="https://facebook.com/"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z"></path></svg></a>
                                                </li>
                                                <li class="twitter">
                                                    <a href="https://twitter.com/"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"></path></svg></a>
                                                </li>
                                                <li class="pinterest">
                                                    <a href="https://pinterest.com/"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z"></path></svg></a>
                                                </li>
                                                <li class="instagram">
                                                    <a href="https://instagram.com/"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <div class="product-payment-image">
                                       <ul class="payment-icon">
                                            <li>
                                                <a href="index.html"><svg viewBox="0 0 38 24" xmlns="http://www.w3.org/2000/svg" role="img" width="38" height="24"><title id="visa">Visa</title><path opacity=".07" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z"></path><path fill="#fff" d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"></path><path d="M28.3 10.1H28c-.4 1-.7 1.5-1 3h1.9c-.3-1.5-.3-2.2-.6-3zm2.9 5.9h-1.7c-.1 0-.1 0-.2-.1l-.2-.9-.1-.2h-2.4c-.1 0-.2 0-.2.2l-.3.9c0 .1-.1.1-.1.1h-2.1l.2-.5L27 8.7c0-.5.3-.7.8-.7h1.5c.1 0 .2 0 .2.2l1.4 6.5c.1.4.2.7.2 1.1.1.1.1.1.1.2zm-13.4-.3l.4-1.8c.1 0 .2.1.2.1.7.3 1.4.5 2.1.4.2 0 .5-.1.7-.2.5-.2.5-.7.1-1.1-.2-.2-.5-.3-.8-.5-.4-.2-.8-.4-1.1-.7-1.2-1-.8-2.4-.1-3.1.6-.4.9-.8 1.7-.8 1.2 0 2.5 0 3.1.2h.1c-.1.6-.2 1.1-.4 1.7-.5-.2-1-.4-1.5-.4-.3 0-.6 0-.9.1-.2 0-.3.1-.4.2-.2.2-.2.5 0 .7l.5.4c.4.2.8.4 1.1.6.5.3 1 .8 1.1 1.4.2.9-.1 1.7-.9 2.3-.5.4-.7.6-1.4.6-1.4 0-2.5.1-3.4-.2-.1.2-.1.2-.2.1zm-3.5.3c.1-.7.1-.7.2-1 .5-2.2 1-4.5 1.4-6.7.1-.2.1-.3.3-.3H18c-.2 1.2-.4 2.1-.7 3.2-.3 1.5-.6 3-1 4.5 0 .2-.1.2-.3.2M5 8.2c0-.1.2-.2.3-.2h3.4c.5 0 .9.3 1 .8l.9 4.4c0 .1 0 .1.1.2 0-.1.1-.1.1-.1l2.1-5.1c-.1-.1 0-.2.1-.2h2.1c0 .1 0 .1-.1.2l-3.1 7.3c-.1.2-.1.3-.2.4-.1.1-.3 0-.5 0H9.7c-.1 0-.2 0-.2-.2L7.9 9.5c-.2-.2-.5-.5-.9-.6-.6-.3-1.7-.5-1.9-.5L5 8.2z" fill="#142688"></path></svg></a>
                                            </li>
                                            <li>
                                                <a href="index.html"><svg viewBox="0 0 38 24" xmlns="http://www.w3.org/2000/svg" role="img" width="38" height="24"><title id="master">Mastercard</title><path opacity=".07" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z"></path><path fill="#fff" d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"></path><circle fill="#EB001B" cx="15" cy="12" r="7"></circle><circle fill="#F79E1B" cx="23" cy="12" r="7"></circle><path fill="#FF5F00" d="M22 12c0-2.4-1.2-4.5-3-5.7-1.8 1.3-3 3.4-3 5.7s1.2 4.5 3 5.7c1.8-1.2 3-3.3 3-5.7z"></path></svg></a>
                                            </li>
                                            <li>
                                                <a href="index.html"><svg xmlns="http://www.w3.org/2000/svg" role="img" viewBox="0 0 38 24" width="38" height="24"><title id="american-express">American Express</title><path fill="#000" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3Z" opacity=".07"></path><path fill="#006FCF" d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32Z"></path><path fill="#FFF" d="M22.012 19.936v-8.421L37 11.528v2.326l-1.732 1.852L37 17.573v2.375h-2.766l-1.47-1.622-1.46 1.628-9.292-.02Z"></path><path fill="#006FCF" d="M23.013 19.012v-6.57h5.572v1.513h-3.768v1.028h3.678v1.488h-3.678v1.01h3.768v1.531h-5.572Z"></path><path fill="#006FCF" d="m28.557 19.012 3.083-3.289-3.083-3.282h2.386l1.884 2.083 1.89-2.082H37v.051l-3.017 3.23L37 18.92v.093h-2.307l-1.917-2.103-1.898 2.104h-2.321Z"></path><path fill="#FFF" d="M22.71 4.04h3.614l1.269 2.881V4.04h4.46l.77 2.159.771-2.159H37v8.421H19l3.71-8.421Z"></path><path fill="#006FCF" d="m23.395 4.955-2.916 6.566h2l.55-1.315h2.98l.55 1.315h2.05l-2.904-6.566h-2.31Zm.25 3.777.875-2.09.873 2.09h-1.748Z"></path><path fill="#006FCF" d="M28.581 11.52V4.953l2.811.01L32.84 9l1.456-4.046H37v6.565l-1.74.016v-4.51l-1.644 4.494h-1.59L30.35 7.01v4.51h-1.768Z"></path></svg></a>
                                            </li>
                                            <li>
                                                <a href="index.html"><svg viewBox="0 0 38 24" xmlns="http://www.w3.org/2000/svg" width="38" height="24" role="img"><title id="paypal">PayPal</title><path opacity=".07" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z"></path><path fill="#fff" d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"></path><path fill="#003087" d="M23.9 8.3c.2-1 0-1.7-.6-2.3-.6-.7-1.7-1-3.1-1h-4.1c-.3 0-.5.2-.6.5L14 15.6c0 .2.1.4.3.4H17l.4-3.4 1.8-2.2 4.7-2.1z"></path><path fill="#3086C8" d="M23.9 8.3l-.2.2c-.5 2.8-2.2 3.8-4.6 3.8H18c-.3 0-.5.2-.6.5l-.6 3.9-.2 1c0 .2.1.4.3.4H19c.3 0 .5-.2.5-.4v-.1l.4-2.4v-.1c0-.2.3-.4.5-.4h.3c2.1 0 3.7-.8 4.1-3.2.2-1 .1-1.8-.4-2.4-.1-.5-.3-.7-.5-.8z"></path><path fill="#012169" d="M23.3 8.1c-.1-.1-.2-.1-.3-.1-.1 0-.2 0-.3-.1-.3-.1-.7-.1-1.1-.1h-3c-.1 0-.2 0-.2.1-.2.1-.3.2-.3.4l-.7 4.4v.1c0-.3.3-.5.6-.5h1.3c2.5 0 4.1-1 4.6-3.8v-.2c-.1-.1-.3-.2-.5-.2h-.1z"></path></svg></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- peoduct detail end -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        // Add to cart button click
        $('.addToCartproductdetails').on('click', function() {
            let productId = $(this).data('id');
            // console.log(productId);

            let quantity = parseInt($('#qty').val()); // Get the quantity from the input field
            // console.log(quantity);


            let stock = parseInt($('#qty').attr('max')); // Get the stock from the max attribute

            // Check if the quantity is greater than available stock
            if (quantity > stock) {
                alert('Sorry, we only have ' + stock + ' units in stock!');
                $('#qty').val(stock); // Set quantity to available stock
                return; // Exit the function to prevent adding to the cart
            }

            // AJAX request to add to cart
            $.ajax({
                url: "{{ route('add.cart') }}", // Define your route here
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // CSRF token
                    product_id: productId,
                    quantity: quantity
                },
                success: function(response) {
                    if (response.status === "success") {
                        $('.cart-count').text(response.cartCount);
                        // toastr.success(response.message, "Success"); // Notify success
                        // Clear existing cart items and build new ones
                        var cartItemsHtml = '';
                            var subtotal = 0;

                            // Loop through the cart items to build the HTML
                            $.each(response.cartItems, function (key, item) {
                                var itemTotal = item.quantity * item.price;

                                subtotal += itemTotal;

                                cartItemsHtml += `
                                    <div class="cart-item">
                                        <div class="cart-item-remove">
                                            <a href="{{ route('cart.remove') }}/${item.product_id}" class="btn text-danger p-0">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                        <a href="#" class="d-flex align-items-start justify-content-between w-100">
                                            <div class="cart-item-details mr-2">
                                                <h6>${item.title}</h6>
                                                <div>${item.quantity} × <span class="price">$${item.price}</span></div>
                                            </div>
                                            <img src="${item.thumbnail}" alt="${item.title}" />
                                        </a>
                                    </div>
                                `;
                            });

                            // Inject the built cart items HTML into the offcanvas body
                            $('.cartItems').html(cartItemsHtml);

                            // Update the subtotal
                            var subtotalHtml = `
                                <div class="subtotal text-dark">
                                    <span>Subtotal:</span>
                                    <span>$${subtotal.toFixed(2)}</span>
                                </div>
                                <a href="{{ route('carts') }}" class="btn btn-view-cart">View Cart</a>
                                <a href="{{ route('checkout') }}" class="btn btn-checkout"><i class="fas fa-lock"></i> Checkout</a>
                            `;
                            $('.cart-footer').html(subtotalHtml);
                    } else {
                        toastr.error(response.message, "Error"); // Notify error
                    }
                },
                error: function() {
                    toastr.error("Something went wrong!", "Error");
                }
            });
        });
    });
</script>
@endpush
