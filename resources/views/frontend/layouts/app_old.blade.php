<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @php
        $settings = getSetting();
    @endphp
    <title>@yield('title')</title>

    {{-- meta info --}}
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="">
    <meta property="fb:app_id" content="{{ '100087492087217' }}" />
    <meta name="robots" content="index,follow">
    <meta name="Developed By" content="Arobil Limited" />
    <meta name="Developer" content="Sajjel Hossain" />
    <meta property="og:image:width" content="700" />
    <meta property="og:image:height" content="400" />
    <meta property="og:site_name" content="{{ $settings->site_name ?? 'Techalpha - Austrilia' }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">


    @if (View::hasSection('meta'))
        @yield('meta')
    @else
        <meta property="og:title" content="{{ $settings->site_name ?? config('app.name') }} - @yield('title')" />
        <meta property="og:description" content="Techalpha - Austrilia" />
        <meta property="og:image" content="{{getIcon($settings->site_logo)}}" />
    @endif

    {{-- style  --}}
    @include('frontend.layouts.style')

    {{-- toastr style  --}}
    <link rel="stylesheet" href="{{asset('massage/toastr/toastr.css')}}">

    <style>
    /* ul.dropdown-menu.p-2.show {
        left: -50px;
        top: 32px;
    }
    .flag {
        width: 25px;
        height: 15px;
        object-fit: contain;
    }
    .toast-title{
        font-size: 14px;
    }
    .toast-message {
        font-size: 13px !important;
    } */

    </style>
    {{-- custom style  --}}
    @stack('style')

</head>

<body>


    <div class="page-wrapper">
        {{-- header section  --}}
        @include('frontend.layouts.header')

        <main class="main">

            @if (!request()->routeIs('home'))
                @include('frontend.layouts.breadcrumb')
            @endif
            {{-- content section  --}}
            @yield('content')

        <main class="main">
        {{-- footer section  --}}
        @include('frontend.layouts.footer')

        {{-- javascript  --}}
        @include('frontend.layouts.script')

        <script>
            $(document).ready(function() {
                $(".addToCart").click(function() {
                    let product_id = $(this).data("id");

                    $.ajax({
                        url: "{{ route('add.cart') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            product_id: product_id,
                            quantity: 1 // Default quantity
                        },
                        success: function(response) {
                            if (response.status === "success") {
                                console.log(response);

                                $('.cart-count').text(response.cartCount);
                                // toastr.success(response.message, "Success");
                            } else {
                                toastr.error(response.message, "Error");
                            }

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
                        },
                        error: function() {
                            toastr.error("Something went wrong!", "Error");
                        }
                    });
                });
            });

            $(document).ready(function() {
                $('.addToWishlist').on('click', function() {
                    let button = $(this);
                    let productId = button.data('id');
                    let icon = button.find("i");

                    $.ajax({
                        url: "{{ route('add.wishlist') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            product_id: productId
                        },
                        success: function(response) {
                            if (response.status === "added") {
                                toastr.success(response.message, "Success");
                                if (icon.length) {
                                    icon.removeClass("fa-regular fa-heart").addClass("fa-solid fa-heart");
                                }

                                // Update only the text inside <span> without removing <i>
                                button.find("span:last").text("Added to Wishlist");
                                $(".wishlist-count").text(response.wishlistCount);
                            } else if (response.status === "removed") {
                                toastr.warning(response.message, "Error");
                            } else {
                                toastr.error(response.message, 'Error');
                            }
                        },
                        error: function() {
                            toastr.error("Something went wrong!", "Error");
                        }
                    });
                });
            });
        </script>

        <script src="{{asset('massage/toastr/toastr.js')}}"></script>
            {!! Toastr::message() !!}
        <script>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error('{{ $error }}','Error',{
                        closeButton:true,
                        progressBar:true,
                    });
                @endforeach
            @endif
        </script>

        {{-- custom js area  --}}

        @stack('script')

    </div>
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>
</body>

</html>
