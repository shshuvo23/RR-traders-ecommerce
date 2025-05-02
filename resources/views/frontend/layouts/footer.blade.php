@php
    $settings = getSetting();
@endphp

<footer class="footer footer-2">
    @if (!request()->routeIs('home'))
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
    @endif

    <div class="footer-middle">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-sm-12 col-lg-4">
                    <div class="widget widget-about">
                        <img src="{{ getIcon($settings->site_logo) }}" class="footer-logo" alt="Footer Logo" width="220"
                            height="100">
                        <p>
                            <p>
                                {{ ($settings->footer_text ?? '') }}
                             </p>

                        </p>

                        <div class="widget-about-info">
                            <span class="widget-about-title">Got Question? Call us 24/7</span>
                            <a href="tel:1300 000 000">1300 000 000</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-2">
                    <div class="widget">
                        <h4 class="widget-title"><strong>Information</strong></h4>

                        <ul class="widget-list">
                            <li><a href="{{route('frontend.about')}}">About Techalpha</a></li>
                            <li><a href="{{ route('frontend.HowToShop') }}">How to shop on Techalpha</a></li>
                            <li><a href="{{route('frontend.faq')}}">FAQ</a></li>
                            <li><a href="{{route('frontend.contact')}}">Contact us</a></li>
                            <li><a href="{{ route('login') }}">Log in</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-2">
                    <div class="widget">
                        <h4 class="widget-title"><strong>Customer Service</strong></h4>

                        <ul class="widget-list">
                            {{-- <li><a href="{{ route('frontend.moneyBackGuarantee') }}">Money-back guarantee!</a></li> --}}
                            <li><a href="{{route('frontend.returns')}}">Returns</a></li>
                            <li><a href="{{route('frontend.shipping-conditions')}}">Shipping</a></li>
                            <li><a href="{{route('frontend.terms-condition')}}">Terms and conditions</a></li>
                            <li><a href="{{route('frontend.privacy-policy')}}">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-2">
                    <div class="widget">
                        <h4 class="widget-title"><strong>My Account</strong></h4>

                        <ul class="widget-list">
                            @auth
                                <li><a href="{{route('user.dashboard')}}">Dashboard</a></li>
                            @else
                                <li><a href="{{route('login')}}">Sign In</a></li>
                            @endauth
                            <li><a href="{{route('carts')}}">View Cart</a></li>
                            <li><a href="{{route('user.wishlist')}}">My Wishlist</a></li>
                            {{-- <li><a href="#">Track My Order</a></li> --}}
                            {{-- <li><a href="#">Help</a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p class="footer-copyright">Copyright © 2025 Techalpha. All Rights Reserved.</p>

            <ul class="footer-menu">
                <li><a href="{{ route('frontend.termsOfUse') }}">Terms Of Use</a></li>
                <li><a href="{{ route('frontend.privacy-policy') }}">Privacy Policy</a></li>
            </ul>

            <div class="social-icons social-icons-color">
                <span class="social-label">Social Media</span>
                {{-- @if($settings->facebook_url) --}}
                <a href="{{ $settings->facebook_url }}" class="social-icon social-facebook" title="Facebook" target="_blank"><i
                        class="icon-facebook-f"></i></a>
                {{-- @endif --}}
                {{-- @if($settings->twitter_url) --}}
                <a href="{{ $settings->twitter_url ?? '#'}}" class="social-icon social-twitter" title="Twitter" target="_blank"><i
                        class="icon-twitter"></i></a>
                        {{-- @endif --}}
                        {{-- @if($settings->instagram_url) --}}
                <a href="{{ $settings->instagram_url ?? '#'}}" class="social-icon social-instagram" title="Instagram" target="_blank"><i
                        class="icon-instagram"></i></a>
                        {{-- @endif --}}
                        {{-- @if($settings->youtube_url) --}}
                <a href="{{ $settings->youtube_url ?? '#'}}" class="social-icon social-youtube" title="Youtube" target="_blank"><i
                        class="icon-youtube"></i></a>
                        {{-- @endif --}}
                {{-- <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i
                        class="icon-pinterest"></i></a> --}}
            </div>
        </div>
    </div>
</footer>
