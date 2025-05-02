@php
    $settings = getSetting();
@endphp

<!-- footer start -->
<section class="footer-area section-ptb">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="footer-list">
                    <ul class="footer-ul">
                        <li class="footer-li footer-logo" data-animate="animate__fadeInUp">
                            <div class="footer-content">
                                <a href="index.html" class="theme-logo">
                                    <img src="{{ getIcon($settings->site_logo) }}" class="img-fluid" alt="footer-logo">
                                </a>
                                <ul class="ftcontact-ul">
                                    <li class="ftcontact-li">
                                        <div class="footer-desc">
                                            <p class="desc">{{ ($settings->footer_text ?? '') }} </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="footer-li" data-animate="animate__fadeInUp">
                            <ul class="ftlist-ul">
                                <li class="ftlist-li">
                                    <h6 class="ftlist-title">Information</h6>
                                    <a href="#footer-information" class="ftlist-title" data-bs-toggle="collapse"
                                        aria-expanded="false">
                                        <span>Information</span>
                                        <span><i class="fa-solid fa-plus"></i></span>
                                    </a>
                                    <ul class="ftlink-ul collapse" id="footer-information">
                                        <li class="ftlink-li"><a href="{{route('frontend.returns')}}">Returns</a></li>
                                        <li class="ftlink-li"><a href="{{route('frontend.shipping-conditions')}}">Shipping</a></li>
                                        <li class="ftlink-li"><a href="{{route('frontend.terms-condition')}}">Terms and conditions</a></li>
                                        <li class="ftlink-li"><a href="{{route('frontend.privacy-policy')}}">Privacy Policy</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="footer-li" data-animate="animate__fadeInUp">
                            <ul class="ftlist-ul">
                                <li class="ftlist-li">
                                    <h6 class="ftlist-title">Top category</h6>
                                    <a href="#footer-category" class="ftlist-title" data-bs-toggle="collapse"
                                        aria-expanded="false">
                                        <span>Top category</span>
                                        <span><i class="fa-solid fa-plus"></i></span>
                                    </a>
                                    <ul class="ftlink-ul collapse" id="footer-category">
                                        <li class="ftlink-li">
                                            <a href="product-template.html">Wireless headphone</a>
                                        </li>
                                        <li class="ftlink-li">
                                            <a href="product-template2.html">Bluetooth speakers</a>
                                        </li>
                                        <li class="ftlink-li">
                                            <a href="product-template3.html">Portable devices</a>
                                        </li>
                                        <li class="ftlink-li">
                                            <a href="product-template4.html">Monio live camera</a>
                                        </li>
                                        <li class="ftlink-li">
                                            <a href="product-template5.html">Movie projector T6</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="footer-li footer-contact" data-animate="animate__fadeInUp">
                            <ul class="ftlist-ul">
                                <li class="ftlist-li">
                                    <h6 class="ftlist-title">Contact info</h6>
                                    <a href="#footer-Contact" class="ftlist-title" data-bs-toggle="collapse"
                                        aria-expanded="false">
                                        <span>Contact info</span>
                                        <span><i class="fa-solid fa-plus"></i></span>
                                    </a>
                                    <ul class="ftcontact-ul collapse" id="footer-Contact">
                                        <li class="ftcontact-li">
                                            <div class="ft-contact-add">
                                                <a href="#" class="ft-contact-address">Phone: +1 234 567 890
                                                </a>
                                            </div>
                                        </li>
                                        <li class="ftcontact-li">
                                            <div class="ft-contact-add">
                                                <a href="Email:info@domain.com" class="ft-contact-address">Email:
                                                    info@domain.com</a>
                                            </div>
                                        </li>
                                        <li class="ftcontact-li">
                                            <div class="ft-contact-add">
                                                <p class="ft-contact-text">401 Broadway, 24th floor,</p>
                                            </div>
                                        </li>
                                        <li class="ftcontact-li">
                                            <div class="ft-contact-add">
                                                <p class="ft-contact-text">orchard view, london, UK</p>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- footer end -->
<!-- footer-copyright start -->
<footer class="ft-copyright-area bt">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="ft-copyright">
                    <ul class="ft-copryright-ul">
                        <li class="ft-copryright-li ft-payment">
                            <ul class="payment-icon">
                                <li>
                                    <a href="index.html">
                                        <img src="{{ asset('frontend/asset/img/payment/pay-1.jpg') }}" class="img-fluid" alt="pay-1">
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html">
                                        <img src="{{ asset('frontend/asset/img/payment/pay-2.jpg') }}" class="img-fluid" alt="pay-2">
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html">
                                        <img src="{{ asset('frontend/asset/img/payment/pay-2.jpg') }}" class="img-fluid" alt="pay-3">
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html">
                                        <img src="{{ asset('frontend/asset/img/payment/pay-2.jpg') }}" class="img-fluid" alt="pay-4">
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="ft-copryright-li ft-copyright-text">
                            <p>
                                <span>© 2025 Power by spacingtech template</span>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer-copyright end -->
