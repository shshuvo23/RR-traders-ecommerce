@php
    $rows = DB::table('categories')->get();
@endphp

<!-- notification-bar end -->
<!-- header start -->
<header class="main-header" id="stickyheader">
    <div class="header-top-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="header-area">
                        <div class="header-element header-toggle">
                            <div class="header-icon-block">
                                <ul class="shop-element">
                                    <li class="side-wrap toggler-wrap">
                                        <div class="toggler-wrapper">
                                            <button class="toggler-btn">
                                                <span class="toggler-icon"><svg viewBox="0 0 24 24" width="24"
                                                        height="24" stroke="currentColor" stroke-width="2"
                                                        fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                        class="css-i6dzq1">
                                                        <line x1="3" y1="12" x2="21"
                                                            y2="12"></line>
                                                        <line x1="3" y1="6" x2="21"
                                                            y2="6"></line>
                                                        <line x1="3" y1="18" x2="21"
                                                            y2="18"></line>
                                                    </svg></span>
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="header-element header-logo">
                            <div class="header-theme-logo">
                                <a href="{{ route('home') }}" class="theme-logo">
                                    <img src="{{ getIcon($settings->site_logo) }}" class="img-fluid" alt="logo">
                                </a>
                            </div>
                        </div>
                        <div class="header-element header-search">
                            <div class="search-crap">
                                <div class="search-content">
                                    <div class="search-box">
                                        <form action="{{ route('shop') }}" method="get" class="search-bar">
                                            <div class="form-search">
                                                <input type="search" name="q" placeholder="Find our search"
                                                    value="{{ request()->get('q') }}" class="search-input">
                                                <button type="submit" class="search-btn"><i
                                                        class="feather-search"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="header-element header-icon">
                            <div class="header-icon-block">
                                <ul class="shop-element">
                                    <li class="side-wrap search-wrap">
                                        <div class="search-wrapper">
                                            <a href="#searchmodal" data-bs-toggle="modal">
                                                <span class="search-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="1em" height="1em" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M11 2c4.968 0 9 4.032 9 9s-4.032 9-9 9s-9-4.032-9-9s4.032-9 9-9m0 16c3.867 0 7-3.133 7-7s-3.133-7-7-7s-7 3.133-7 7s3.133 7 7 7m8.485.071l2.829 2.828l-1.415 1.415l-2.828-2.829z">
                                                        </path>
                                                    </svg></span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="header-element header-details">
                            <div class="header-icon-details">
                                <ul class="details-ul">
                                    <li class="info-wrap info-Login">
                                        <div class="info-wrapper">
                                            @auth
                                                <a href="{{ route('user.dashboard') }}" class="icon">
                                                    <i class="feather-user"></i>
                                                </a>
                                                <div class="info-text">
                                                    <span class="label">My Account</span>
                                                    <a href="{{ route('user.dashboard') }}" class="info-link">Dashboard</a>
                                                </div>
                                            @else
                                                <a href="{{ route('login') }}" class="icon">
                                                    <i class="feather-log-in"></i> {{-- Using a login-style icon --}}
                                                </a>
                                                <div class="info-text">
                                                    <span class="label">Account</span>
                                                    <a href="{{ route('login') }}" class="info-link">Login</a> /
                                                    <a href="{{ route('register') }}" class="info-link">Register</a>
                                                </div>
                                            @endauth
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header-bottam start -->
    <div class="header-bottom-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="main-block">
                        <div class="side-wrap header-support">
                            <div class="vega-menu-area">
                                <a href="#vega-collapse" class="browse-cat" data-bs-toggle="collapse"
                                    aria-expanded="false">
                                    <span class="menu-icon"><i class="feather-menu"></i></span>
                                    <span class="menu-title">Trending category</span>
                                    <span class="menu-arrow"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <a href="#vega-collapse" class="browse-cat browse-cat-lg" data-bs-toggle="collapse"
                                    aria-expanded="false">
                                    <span class="menu-icon"><i class="feather-menu"></i></span>
                                    <span class="menu-title">Trending category</span>
                                    <span class="menu-arrow"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <div class="vegawrap collapse" id="vega-collapse">
                                    <ul class="vega-menu">
                                        @foreach ($rows as $row)
                                            <li class="menu-link">
                                                <a href="{{ route('shop', $row->slug) }}" class="link-title">
                                                    <span class="menu-img-icon">
                                                        <img src="{{ asset('frontend/asset/img/menu/cate-menu2.jpg') }}" class="img-fluid"
                                                            alt="cate-menu2">
                                                    </span>
                                                    <span class="sp-link-title">{{ $row->name }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="side-wrap header-menu">
                            <div class="mainmenu-content">
                                <div class="main-wrap">
                                    <ul class="main-menu">
                                        <li class="menu-link">
                                            <a href="{{ route('home') }}" class="link-title">
                                                <span class="sp-link-title">Home</span>
                                                <span class="menu-arrow"><i class="fa fa-angle-down"></i></span>
                                            </a>
                                        </li>
                                        <li class="menu-link">
                                            <a href="{{ route('shop') }}" class="link-title">
                                                <span class="sp-link-title">Shop</span>
                                                <span class="menu-arrow"><i class="fa fa-angle-down"></i></span>
                                            </a>
                                        </li>

                                        <li class="menu-link">
                                            <a href="blog-grid.html" class="link-title">
                                                <span class="sp-link-title">Blogs</span>
                                                <span class="menu-arrow"><i class="fa fa-angle-down"></i></span>
                                            </a>
                                            <div class="menu-dropdown menu-single collapse" id="blogs">
                                                <ul class="ul">
                                                    <li class="menusingle-li">
                                                        <a href="blog-grid-without.html" class="menusingle-title">
                                                            <span class="sp-link-title">Blog grid</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menu-link">
                                            <a href="{{ route('frontend.about') }}" class="link-title">
                                                <span class="sp-link-title">About us</span>
                                                <span class="menu-arrow"><i class="fa fa-angle-down"></i></span>
                                            </a>
                                        </li>
                                        <li class="menu-link">
                                            <a href="{{ route('frontend.contact') }}" class="link-title">
                                                <span class="sp-link-title">Contact us</span>
                                                <span class="menu-arrow"><i class="fa fa-angle-down"></i></span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="side-wrap header-icon">
                            <div class="header-icon-block">
                                <ul class="shop-element">
                                    <li class="side-wrap toggler-wrap">
                                        <div class="toggler-wrapper">
                                            <button class="toggler-btn">
                                                <span class="toggler-icon"><svg viewBox="0 0 24 24" width="24"
                                                        height="24" stroke="currentColor" stroke-width="2"
                                                        fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                        class="css-i6dzq1">
                                                        <line x1="3" y1="12" x2="21"
                                                            y2="12"></line>
                                                        <line x1="3" y1="6" x2="21"
                                                            y2="6"></line>
                                                        <line x1="3" y1="18" x2="21"
                                                            y2="18"></line>
                                                    </svg></span>
                                            </button>
                                        </div>
                                    </li>
                                    <li class="side-wrap search-wrap">
                                        <div class="search-wrapper">
                                            <a href="#searchmodal" data-bs-toggle="modal">
                                                <span class="search-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="1em" height="1em" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M11 2c4.968 0 9 4.032 9 9s-4.032 9-9 9s-9-4.032-9-9s4.032-9 9-9m0 16c3.867 0 7-3.133 7-7s-3.133-7-7-7s-7 3.133-7 7s3.133 7 7 7m8.485.071l2.829 2.828l-1.415 1.415l-2.828-2.829z">
                                                        </path>
                                                    </svg></span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="side-wrap user-wrap">
                                        <div class="user-wrapper">
                                            <a href="#store-account" class="collapsed" data-bs-toggle="collapse"
                                                aria-expanded="false">
                                                <span class="user-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="1em" height="1em" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M20 22h-2v-2a3 3 0 0 0-3-3H9a3 3 0 0 0-3 3v2H4v-2a5 5 0 0 1 5-5h6a5 5 0 0 1 5 5zm-8-9a6 6 0 1 1 0-12a6 6 0 0 1 0 12m0-2a4 4 0 1 0 0-8a4 4 0 0 0 0 8">
                                                        </path>
                                                    </svg></span>
                                                <span class="user-title">Login</span>
                                            </a>
                                            <div class="user-drower collapse" id="store-account">
                                                <a href="login-account.html">Login</a>
                                                <a href="create-account.html">Register</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="side-wrap wishlist-wrap">
                                        <div class="wishlist-wrapper">
                                            <a href="{{ route('user.wishlist') }}">
                                                <span class="wishlist-icon-count">
                                                    <span class="wishlist-icon"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="1em"
                                                            height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor"
                                                                d="M12.001 4.529a5.998 5.998 0 0 1 8.242.228a6 6 0 0 1 .236 8.236l-8.48 8.492l-8.478-8.492a6 6 0 0 1 8.48-8.464m6.826 1.641a3.998 3.998 0 0 0-5.49-.153l-1.335 1.198l-1.336-1.197a4 4 0 0 0-5.686 5.605L12 18.654l7.02-7.03a4 4 0 0 0-.193-5.454">
                                                            </path>
                                                        </svg></span>
                                                </span>
                                                @auth
                                                    @php
                                                        $wishlistCount = DB::table('wishlists')
                                                            ->where('user_id', Auth::user()->id)
                                                            ->count();
                                                    @endphp
                                                    @if ($wishlistCount > 0)
                                                        <span
                                                            class="badge bg-danger wishlist-count-badge">{{ $wishlistCount }}</span>
                                                    @endif
                                                @endauth
                                                <span class="wishlist-title">My wishlist</span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="side-wrap cart-wrap">
                                        <div class="cart-wrapper">
                                            <div class="shopping-cart">
                                                <a class="add-to-cart" href="{{ route('carts') }}">
                                                    <span class="icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                            height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor"
                                                                d="M6.505 2h11a1 1 0 0 1 .8.4l2.7 3.6v15a1 1 0 0 1-1 1h-16a1 1 0 0 1-1-1V6l2.7-3.6a1 1 0 0 1 .8-.4m12.5 6h-14v12h14zm-.5-2l-1.5-2h-10l-1.5 2zm-9.5 4v2a3 3 0 1 0 6 0v-2h2v2a5 5 0 0 1-10 0v-2z" />
                                                        </svg>
                                                    </span>
                                                    <span class="cart-title text">My cart</span>
                                                    <span class="bigcounter cart-count">
                                                        {{ session('cart') ? count(session('cart')) : 0 }}
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>



{{-- <div class="cart-drawer" id="cart-drawer">
    <form action="https://spacingtech.com/cart" method="post" class="drawer-contents">
        <div class="drawer-fixed-header">
            <div class="drawer-header">
                <h6 class="drawer-header-title">Cart</h6>
                <div class="drawer-close">
                    <button type="button" class="drawer-close-btn">
                        <span class="drawer-close-icon">
                            <svg
                                    viewBox="0 0 24 24" width="16" height="16" stroke="currentColor"
                                    stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    class="css-i6dzq1">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        @php
            $subtotal = 0;
        @endphp

        @if (session('cart') && count(session('cart')) > 0)
            <div class="drawer-inner">
                <div class="drawer-scrollable">
                    <ul class="cart-items">
                        @foreach (session('cart') as $item)
                            @php
                                $itemTotal = $item['quantity'] * $item['price'];
                                $subtotal += $itemTotal;
                            @endphp
                            <li class="cart-item">
                                <div class="cart-item-info">
                                    <div class="cart-item-image">
                                        <a href="product-template.html">
                                            <img src="img/menu/home-pro-banner1.jpg" class="img-fluid" alt="cart-1">
                                        </a>
                                    </div>
                                    <div class="cart-item-details">
                                        <div class="cart-item-name">
                                            <a href="product-template.html">{{ $item['title'] }}</a>
                                        </div>
                                        <div class="cart-pro-info">
                                            <div class="cart-qty-price">
                                                <span>{{ $item['quantity'] }}</span>
                                                <span>×</span>
                                                <span class="price">${{ $item['price'] }}</span>
                                            </div>
                                        </div>
                                        <div class="cart-item-sub">
                                            <div class="cart-qty-price-remove">
                                                <div class="cart-item-qty">
                                                    <div class="js-qty-wrapper">
                                                        <div class="js-qty-wrap">
                                                            <button type="button"
                                                                class="js-qty-adjust ju-qty-adjust-minus"><span><svg
                                                                        viewBox="0 0 24 24" width="16" height="16"
                                                                        stroke="currentColor" stroke-width="2" fill="none"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="css-i6dzq1">
                                                                        <line x1="5" y1="12" x2="19"
                                                                            y2="12"></line>
                                                                    </svg></span></button>
                                                            <input type="text" class="js-qty-num" name="name"
                                                                value="1" pattern="[0-9]*">
                                                            <button type="button"
                                                                class="js-qty-adjust ju-qty-adjust-plus"><span><svg
                                                                        viewBox="0 0 24 24" width="16" height="16"
                                                                        stroke="currentColor" stroke-width="2" fill="none"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="css-i6dzq1">
                                                                        <line x1="12" y1="5" x2="12"
                                                                            y2="19"></line>
                                                                        <line x1="5" y1="12" x2="19"
                                                                            y2="12"></line>
                                                                    </svg></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="cart-item-price">
                                                    <span class="cart-price">$12.00</span>
                                                </div>
                                                <div class="cart-item-remove">
                                                    <button type="button" class="cart-remove"><span><svg viewBox="0 0 24 24"
                                                                width="16" height="16" stroke="currentColor"
                                                                stroke-width="2" fill="none" stroke-linecap="round"
                                                                stroke-linejoin="round" class="css-i6dzq1">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                </path>
                                                                <line x1="10" y1="11" x2="10"
                                                                    y2="17"></line>
                                                                <line x1="14" y1="11" x2="14"
                                                                    y2="17"></line>
                                                            </svg></span></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cart-item-variants">
                                            <h6>Color:</h6>
                                            <span>Black</span>
                                        </div>
                                        <div class="cart-item-variants">
                                            <h6>Size:</h6>
                                            <span>XL</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                    <div class="drawer-notes">
                        <label for="cartnote">Order note</label>
                        <textarea name="note" class="cart-notes" id="cartnote"></textarea>
                    </div>
                </div>
                <div class="drawer-footer">
                    <div class="drawer-block drawer-total">
                        <span class="drawer-subtotal">Subtotal</span>
                        <span class="drawer-totalprice">$74.00</span>
                    </div>
                    <div class="drawer-block drawer-ship-text">
                        <label class="box-area">
                            <span class="text">I have read and agree with the <a href="terms-condition.html">terms &amp;
                                    condition.</a></span>
                            <input type="checkbox" class="cust-checkbox">
                            <span class="cust-check"></span>
                        </label>
                    </div>
                    <div class="drawer-block drawer-cart-checkout">
                        <div class="cart-checkout-btn">
                            <button type="button" onclick="location.href='cart-page.html'" name="checkout"
                                class="btn btn-style2">View cart</button>
                            <button type="button" onclick="location.href='checkout-style1.html'"
                                class="checkout btn btn-style2 disabled">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="drawer-cart-empty">
                <div class="drawer-scrollable">
                    <h2>Your cart is currently empty</h2>
                    <a href="https://spacingtech.com/collection/all" class="btn btn-style2">Continue shopping</a>
                </div>
            </div>
        @endif
    </form>
</div>


<div class="offcanvas">
    <div class="offcanvas-header">
        <h5>Your Cart</h5>
        <span class="close-offcanvas">&times;</span>
    </div>
    <div class="offcanvas-body cartItems">
        @php
            $subtotal = 0;
        @endphp

        @if (session('cart') && count(session('cart')) > 0)
            @foreach (session('cart') as $item)
                @php
                    $itemTotal = $item['quantity'] * $item['price'];
                    $subtotal += $itemTotal;
                @endphp
                <div class="cart-item">
                    <div class="cart-item-remove">
                        <a href="{{ route('cart.remove', $item['product_id']) }}" class="btn text-danger p-0">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                    <a href="#" class="d-flex align-items-start justify-content-between w-100">
                        <div class="cart-item-details mr-2">
                            <h6>{{ $item['title'] }}</h6>
                            <div>{{ $item['quantity'] }} × <span class="price">${{ $item['price'] }}</span></div>
                        </div>
                        <img src="{{ asset($item['thumbnail']) }}" alt="{{ $item['title'] }}" />
                    </a>
                </div>
            @endforeach
        @else
            <div>
                <p class="text-center">No products in the cart.</p>
            </div>
        @endif
    </div>
    <div class="cart-footer">
        @if (session('cart') && count(session('cart')) > 0)
            <div class="subtotal text-dark">
                <span>Subtotal:</span>
                <span>${{ number_format($subtotal, 2) }}</span>
            </div>
            <a href="{{ route('carts') }}" class="btn btn-view-cart">View Cart</a>
            <a href="{{ route('checkout') }}" class="btn btn-checkout"><i class="fas fa-lock"></i> Checkout</a>


        @endif
    </div>
</div> --}}

