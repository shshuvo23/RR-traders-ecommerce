@php
    $rows = DB::table('categories')->get();
@endphp
<!-- ======================= header start  ============================ -->
<header class="header header-2 header-intro-clearance">
    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ getIcon($settings->site_logo) }}" alt="Techalpha Logo" width="220" height="100">
                </a>
            </div>

            <div class="header-center">
                <div
                    class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                    <form action="{{ route('shop') }}" method="get">
                        <div class="header-search-wrapper search-wrapper-wide">
                            <label for="q" class="sr-only">Search</label>
                            {{-- <input type="search" class="form-control" name="q" id="q"
                                placeholder="Search product ..." required> --}}
                            <input type="search" class="form-control" name="q" id="q"
                                placeholder="Search product ..." value="{{ request()->get('q') }}" required>
                            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="header-right">
                <div class="account">
                    @auth
                        <a href="{{ route('user.dashboard') }}" title="My account">
                            <div class="icon">
                                {{-- <i class="fa-regular fa-user"></i> --}}
                                <i class="icon-user"></i>
                            </div>
                            <p>Dashboard</p>
                        </a>
                    @else
                        <a href="{{ route('login') }}" title="My account">
                            <div class="icon">
                                {{-- <i class="fa-regular fa-user"></i> --}}
                                <i class="icon-user"></i>
                            </div>
                            <p>Login</p>
                        </a>
                    @endauth
                    {{-- <a href="{{route('login')}}" title="My account">
                        <div class="icon">
                            <i class="icon-user"></i>
                        </div>
                        <p>Login</p>
                    </a> --}}
                </div>

                <div class="wishlist">
                    <a href="{{ route('user.wishlist') }}" title="Wishlist">
                        <div class="icon">
                            <i class="icon-heart-o"></i>
                            @auth
                                @php
                                    $wishlistcount = DB::table('wishlists')
                                        ->where('user_id', Auth::user()->id)
                                        ->count();
                                @endphp
                                <span class="wishlist-count badge">{{ $wishlistcount }}</span>
                            @else
                                <span class="wishlist-count badge">0</span>
                            @endauth
                        </div>
                        <p>Wishlist</p>
                    </a>
                </div>

                <div class="dropdown cart-dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle open-offcanvas">
                        <div class="icon">
                            <i class="icon-shopping-cart"></i>
                            <span class="cart-count">{{ session('cart') ? count(session('cart')) : 0 }}</span>
                        </div>
                        <p>Cart</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom sticky-header">
        <div class="container">
            <div class="header-left">
                <div class="dropdown category-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" data-display="static" title="Browse Categories">
                        Browse Categories
                    </a>

                    <div class="dropdown-menu">
                        <nav class="side-nav">
                            <ul class="menu-vertical sf-arrows">
                                {{-- <li class="item-lead"><a href="shop.html">Latest Arrivals</a></li>
                                <li class="item-lead"><a href="shop.html">Best Deals</a></li> --}}

                                {{-- <li><a href="shop.html">Smartphones</a></li> --}}

                                @foreach ($rows as $row)
                                    <li><a href="{{ route('shop', $row->slug) }}">{{ $row->name }}</a></li>
                                @endforeach


                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="header-center">
                <nav class="main-nav">
                    <ul class="menu">
                        <li><a href="{{ route('home') }}" class="sf-with-ul">Home</a></li>
                        <li><a href="{{ route('shop') }}" class="sf-with-ul">Shop</a></li>
                        <li><a href="{{ route('frontend.about') }}" class="sf-with-ul">About Us</a></li>
                        <li><a href="{{ route('frontend.contact') }}" class="sf-with-ul">Contact Us</a></li>
                    </ul>

                </nav>
            </div>

            <div class="header-right">
                <div class="account">
                    @auth
                        <a href="{{ route('user.dashboard') }}" title="My account">
                            <div class="icon">
                                {{-- <i class="fa-regular fa-user"></i> --}}
                                <i class="icon-user"></i>
                            </div>
                            <p class="m-0 text-white">Dashboard</p>
                        </a>
                    @else
                        <a href="{{ route('login') }}" title="My account">
                            <div class="icon">
                                {{-- <i class="fa-regular fa-user"></i> --}}
                                <i class="icon-user"></i>
                            </div>
                            <p class="m-0 text-white">Login</p>
                        </a>
                    @endauth
                    {{-- <a href="{{route('login')}}" title="My account">
                        <div class="icon">
                            <i class="icon-user"></i>
                        </div>
                        <p>Login</p>
                    </a> --}}
                </div>

                <div class="wishlist">
                    <a href="{{ route('user.wishlist') }}" title="Wishlist">
                        <div class="icon">
                            <i class="icon-heart-o"></i>
                            @auth
                                @php
                                    $wishlistcount = DB::table('wishlists')
                                        ->where('user_id', Auth::user()->id)
                                        ->count();
                                @endphp
                                <span class="wishlist-count badge">{{ $wishlistcount }}</span>
                            @else
                                <span class="wishlist-count badge">0</span>
                            @endauth
                        </div>
                        <p class="m-0 text-white">Wishlist</p>
                    </a>
                </div>

                <div class="dropdown cart-dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle open-offcanvas">
                        <div class="icon">
                            <i class="icon-shopping-cart"></i>
                            <span class="cart-count">{{ session('cart') ? count(session('cart')) : 0 }}</span>
                        </div>
                        <p class="m-0 text-white">Cart</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>


<div class="mobile-menu-overlay"></div>
<div class="mobile-menu-container mobile-menu-light">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab"
                    role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab"
                    aria-controls="mobile-cats-tab" aria-selected="false">Categories</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel"
                aria-labelledby="mobile-menu-link">
                <nav class="mobile-nav">
                    <ul class="mobile-menu">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="shop.html">Shop</a></li>
                        <li><a href="{{ route('frontend.about') }}">About Us</a></li>
                        <li><a href="{{ route('frontend.contact') }}">Contact Us</a></li>
                    </ul>
                </nav>
            </div>
            <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                <nav class="mobile-cats-nav">
                    <ul class="mobile-menu">
                        <li class="item-lead"><a href="shop.html">Latest Arrivals</a></li>
                        <li class="item-lead"><a href="shop.html">Best Deals</a></li>
                        <li><a href="shop.html">Smartphones</a></li>
                        <li><a href="shop.html">Laptops</a></li>
                        <li><a href="shop.html">Tablets</a></li>
                        <li><a href="shop.html">Cameras</a></li>
                        <li><a href="shop.html">Televisions</a></li>
                        <li><a href="shop.html">Headphones & Earbuds</a></li>
                        <li><a href="shop.html">Smartwatches</a></li>
                        <li><a href="shop.html">Gaming Consoles</a></li>
                        <li><a href="shop.html">Accessories</a></li>
                    </ul>
                </nav>
            </div>
        </div>

    </div>
</div>
<!-- ======================= header end  ============================ -->

<!-- Offcanvas -->
<div class="offcanvas">
    <div class="offcanvas-header">
        <h5>Your Cart</h5>
        <span class="close-offcanvas">&times;</span>
    </div>
    <div class="offcanvas-body cartItems">
        @php
            $subtotal = 0;
        @endphp
        <!-- Cart Item -->
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

            {{-- <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="total" value="{{ $subtotal }}">
                <button type="submit" class="btn btn-checkout"><i class="fas fa-lock"></i> Checkout</button>
            </form> --}}
        @endif
    </div>
</div>

<!-- Backdrop -->
<div class="offcanvas-backdrop"></div>
