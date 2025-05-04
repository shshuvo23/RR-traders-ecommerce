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
    <li class="breadcrumb-item"> {{ $title }}</li>
@endsection
<!-- ======================= breadcrumb end  ============================ -->

<div class="page-content pt-2 pb-2">
    <div class="container">
        <div class="product-details-top mb-2">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0 text-center position-relative">
                    <span class="discount-badge" style="    background: #ff5e00; color: #fff; padding: 3px 8px 0px 8px; border-radius: 3px; font-size: 16px; margin-left: 5px; position: absolute; top: 10px; left: 15px; z-index: 9;">
                        {{ $product->discount }}% OFF
                    </span>
                    <div class="fotorama overflow-hidden mx-auto w-100" data-nav="thumbs">
                        <img src="{{ asset($product->thumbnail) }}" class="rounded w-100" alt="Image">
                        @foreach ($product->images as $image)
                            <img src="{{ asset($image->image) }}" class="rounded w-100" alt="Image">
                        @endforeach
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="product-details">
                        <h1 class="product-title">{{ $product->title }}</h1>

                        <div class="product-price">
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
                        </div>


                        <div class="mb-2">
                            <p class="d-block"> <span style="font-weight: 400">Brand:</span> {{ $product->brand->name }}</p>
                            {{-- <i class="fa-solid fa-circle mx-2" style="font-size: 10px"></i> --}}
                            <p class="d-block"> <span style="font-weight: 400">Category:</span> {{ $product->category->name }}</p>
                        </div>

                        <div class="product-content">
                            <p>
                                {!! $product->short_description !!}
                            </p>
                        </div>

                        <div class="details-filter-row details-row-size">
                            <label for="qty">Qty:</label>
                            <div class="product-details-quantity">
                                <input type="number" id="qty" class="form-control" value="1" min="1"
                                    max="{{ $product->stock }}" step="1" data-decimals="0" required>
                            </div>
                        </div>

                        <div class="product-details-action">
                            <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                class="btn-product btn-cart addToCartproductdetails open-offcanvas"><span>add to cart</span></a>
                            @php
                                $isInWishlist = auth()->check() && auth()->user()->wishlist->contains('product_id', $product->id);
                            @endphp
                            <div class="details-action-wrapper">
                                <a href="javascript:void(0)" data-id="{{ $product->id }}" class="btn-product btn-wishlist addToWishlist" title="Add to Wishlist"><span>
                                    {{-- <i class="fa-regular fa-heart"></i> add to wishlist</span> --}}
                                    <i class="{{ $isInWishlist ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}"></i>
                                    <span>
                                        {{ $isInWishlist ? 'Added to Wishlist' : 'Add to Wishlist' }}
                                    </span>
                                </a>
                            </div>
                            {{-- <div class="details-action-wrapper">
                                <a href="#" class="btn-product btn-wishlist" title="Wishlist">
                                    <span>
                                        Add to Wishlist
                                    </span>
                                </a>
                            </div> --}}
                        </div>

                        <div class="product-details-footer">
                            {{-- <div class="product-cat">
                                <span>Category:</span>
                                <a href="#">Women</a>,
                                <a href="#">Shoes</a>,
                                <a href="#">Sandals</a>,
                                <a href="#">Yellow</a>
                            </div> --}}

                            <div class="social-icons social-icons-sm">
                                <span class="social-label">Share:</span>
                                <div class="social-share">
                                    {!! $shareComponent !!}

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-details-tab product-details-extended">
        <div class="container">
            <ul class="nav nav-pills justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab"
                        role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab"
                        aria-controls="product-info-tab" aria-selected="false">Additional
                        information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab"
                        role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel"
                aria-labelledby="product-desc-link">
                <div class="product-desc-content">
                    <div class="container">
                        <h3>Product Information</h3>
                        <p>{!! $product->description !!} </p>

                        {{-- <h3>Fabric & care</h3>
                        <ul>
                            <li>Faux suede fabric</li>
                            <li>Gold tone metal hoop handles.</li>
                            <li>RI branding</li>
                            <li>Snake print trim interior </li>
                            <li>Adjustable cross body strap</li>
                            <li> Height: 31cm; Width: 32cm; Depth: 12cm; Handle Drop: 61cm</li>
                        </ul>

                        <h3>Size</h3>
                        <p>one size</p> --}}
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                <div class="product-desc-content">
                    <div class="container">
                        <h3>Information</h3>
                        <p>{!! $product->aditional_info !!} </p>

                        {{-- <h3>Fabric & care</h3>
                        <ul>
                            <li>Faux suede fabric</li>
                            <li>Gold tone metal hoop handles.</li>
                            <li>RI branding</li>
                            <li>Snake print trim interior </li>
                            <li>Adjustable cross body strap</li>
                            <li> Height: 31cm; Width: 32cm; Depth: 12cm; Handle Drop: 61cm</li>
                        </ul>

                        <h3>Size</h3>
                        <p>one size</p> --}}
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel"
                aria-labelledby="product-shipping-link">
                <div class="product-desc-content">
                    <div class="container">
                        <h3>Delivery & returns</h3>
                        <p>We deliver to over 100 countries around the world. For full details of the
                            delivery options we offer, please view our <a href="#">Delivery
                                information</a><br>
                            We hope you’ll love every purchase, but if you ever need to return an item you
                            can do so within a month of receipt. For full details of how to make a return,
                            please view our <a href="#">Returns information</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($relatedProducts->count() > 0)
        <div class="container">
            <h2 class="title text-center mb-4">You May Also Like</h2>
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

                @foreach ($relatedProducts as $row)
                    <div class="product product-2">
                        <figure class="product-media">
                            <div class="product-cat">
                                <a href="#">{{ $row->category->name }}</a>
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
                                    class="btn-product btn-cart addToCart" title="Add to cart"><span>add to
                                        cart</span></a>
                            </div>

                            @php
                                $isInWishlist = auth()->check() && auth()->user()->wishlist->contains('product_id', $row->id);
                            @endphp
                            <div class="product-action wishlist mb-2">
                                <a href="javascript:void(0)" data-id="{{ $row->id }}" class="btn-product btn-wishlist addToWishlist" title="Add to Wishlist"><span>
                                    {{-- <i class="fa-regular fa-heart"></i> add to wishlist</span> --}}
                                    <i class="{{ $isInWishlist ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}"></i>
                                    <span>
                                        {{ $isInWishlist ? 'Added to Wishlist' : 'Add to Wishlist' }}
                                    </span>
                                </a>
                            </div>
                            {{-- <div class="product-action wishlist mb-2">
                                <a href="#" class="btn-product btn-wishlist" title="Add to cart"><span>add to
                                        wishlist</span></a>
                            </div> --}}
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
                                {{-- <span class="new-price">$279.99</span>
                                <sup> <span class="old-price">$349.99</span> </sup> --}}
                            </div>

                            <h3 class="product-title"><a
                                    href="{{ route('productDetails', $row->slug) }}">{{ $row->title }}</a></h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        // Add to cart button click
        $('.addToCartproductdetails').on('click', function() {
            let productId = $(this).data('id');
            console.log(productId);

            let quantity = parseInt($('#qty').val()); // Get the quantity from the input field

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
