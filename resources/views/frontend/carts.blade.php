@extends('frontend.layouts.app')

@section('title')
{{ $title ?? '' }}
@endsection

@section('meta')
    <meta property="og:title" content="{{ $seo->title ?? $og_title }}" />
    <meta property="og:description" content="{{ $seo->description ?? $og_description }}" />
    <meta property="og:image" content="{{ asset($seo->image ?? $og_image) }}" />
    <meta name="description" content="{{$seo->meta_description ?? $og_description}}">
    <meta name="keywords" content="{{$seo->keywords ?? $meta_keywords}}">
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
    @endsection
    <!-- ======================= breadcrumb end  ============================ -->

    <section class="cart-page section-ptb">
        <form method="post">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="cart-page-wrap">
                            <div class="cart-wrap-info">
                                <div class="cart-item-wrap">
                                    <div class="cart-title">
                                        <h6>My cart:</h6>
                                        <span class="cart-count">
                                            <span class="cart-counter">3</span>
                                            <span class="cart-item-title">Items</span>
                                        </span>
                                    </div>
                                    <div class="item-wrap">
                                        <ul class="cart-wrap">
                                            <!-- cart-info start -->
                                            @if (count($cartItems) > 0)
                                                @foreach ($cartItems as $item)
                                                    <li class="item-info">
                                                        <!-- cart-img start -->
                                                        <div class="item-img">
                                                            <a href="product-template.html">
                                                                <img src="{{asset($item['thumbnail'])}}" class="img-fluid" alt="p-1">
                                                            </a>
                                                        </div>
                                                        <!-- cart-img end -->
                                                        <!-- cart-title start -->
                                                        <div class="item-text">
                                                            <a href="product-template.html">{{$item['title']}}</a>
                                                            {{-- <span class="item-option">
                                                                <span class="item-title">Color:</span>
                                                                <span class="item-type">Black</span>
                                                            </span> --}}
                                                            <span class="item-option">
                                                                <span class="item-price">${{$item['price']}}</span>
                                                            </span>
                                                        </div>
                                                        <!-- cart-title send -->
                                                    </li>
                                                     <!-- cart-info end -->
                                                    <!-- cart-qty start -->
                                                    <li class="item-qty">
                                                        <div class="product-quantity-action">
                                                            <div class="product-quantity">
                                                                <div class="cart-plus-minus">
                                                                    <!-- Minus Button -->
                                                                    <button class="dec qtybutton minus" type="button"><i class="fa-solid fa-minus"></i></button>

                                                                    <!-- Input field with the same attributes as the first one -->
                                                                    <input type="number" name="quantity" class="form-control cart-quantity" value="1"
                                                                           min="1" max="{{ $item['stock'] }}" step="1"
                                                                           data-id="{{ $item['product_id'] }}"
                                                                           data-price="{{ $item['price'] }}"
                                                                           data-stock="{{ $item['stock'] }}" required>

                                                                    <!-- Plus Button -->
                                                                    <button class="inc qtybutton plus" type="button"><i class="fa-solid fa-plus"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Hidden stock warning message -->
                                                        <small class="text-danger stock-message d-none">Stock is over!</small>

                                                        <div class="item-remove">
                                                            <span class="remove-wrap">
                                                                {{-- <a href="{{ route('cart.remove', $item['product_id']) }}" class="btn btn-danger">
                                                                    <i class="icon-close"></i>
                                                                </a> --}}
                                                                <a href="{{ route('cart.remove', $item['product_id']) }}" class="text-danger">Remove</a>
                                                            </span>
                                                        </div>
                                                    </li>
                                                    <!-- cart-qty end -->
                                                    <!-- cart-price start -->
                                                    <li class="item-price">
                                                        <span class="amount full-price">{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                                    </li>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4" class="text-center">
                                                        <h3>Your cart is empty.</h3>
                                                    </td>
                                                </tr>
                                            @endif

                                            <!-- cart-price end -->
                                        </ul>
                                        {{-- <ul class="cart-wrap">
                                            <!-- cart-info start -->
                                            <li class="item-info">
                                                <!-- cart-img start -->
                                                <div class="item-img">
                                                    <a href="product-template.html">
                                                        <img src="img/menu/home-pro-banner2.jpg" class="img-fluid" alt="p-2">
                                                    </a>
                                                </div>
                                                <!-- cart-img end -->
                                                <!-- cart-title start -->
                                                <div class="item-text">
                                                    <a href="product-template.html">Portable speaker</a>
                                                    <span class="item-option">
                                                        <span class="item-title">Color:</span>
                                                        <span class="item-type">White</span>
                                                    </span>
                                                    <span class="item-option">
                                                        <span class="item-price">$21,00</span>
                                                    </span>
                                                </div>
                                                <!-- cart-title send -->
                                            </li>
                                            <!-- cart-info end -->
                                            <!-- cart-qty start -->
                                            <li class="item-qty">
                                                <div class="product-quantity-action">
                                                    <div class="product-quantity">
                                                        <div class="cart-plus-minus">
                                                            <button class="dec qtybutton minus"><i class="fa-solid fa-minus"></i></button>
                                                            <input type="text" name="quantity" value="1">
                                                            <button class="inc qtybutton plus"><i class="fa-solid fa-plus"></i></button>
                                                        </div>
                                                        <span class="dec qtybtn"></span>
                                                        <span class="inc qtybtn"></span>
                                                    </div>
                                                </div>
                                                <div class="item-remove">
                                                    <span class="remove-wrap">
                                                        <a href="javascript:void(0)" class="text-danger">Remove</a>
                                                    </span>
                                                </div>
                                            </li>
                                            <!-- cart-qty end -->
                                            <!-- cart-price start -->
                                            <li class="item-price">
                                                <span class="amount full-price">$21,00</span>
                                            </li>
                                            <!-- cart-price end -->
                                        </ul>
                                        <ul class="cart-wrap">
                                            <!-- cart-info start -->
                                            <li class="item-info">
                                                <!-- cart-img start -->
                                                <div class="item-img">
                                                    <a href="product-template.html">
                                                        <img src="img/menu/home-pro-banner3.jpg" class="img-fluid" alt="p-3">
                                                    </a>
                                                </div>
                                                <!-- cart-img end -->
                                                <!-- cart-title start -->
                                                <div class="item-text">
                                                    <a href="product-template.html">Verse earphones</a>
                                                    <span class="item-option">
                                                        <span class="item-title">Color:</span>
                                                        <span class="item-type">Red</span>
                                                    </span>
                                                    <span class="item-option">
                                                        <span class="item-price">$24,00</span>
                                                    </span>
                                                </div>
                                                <!-- cart-title send -->
                                            </li>
                                            <!-- cart-info end -->
                                            <!-- cart-qty start -->
                                            <li class="item-qty">
                                                <div class="product-quantity-action">
                                                    <div class="product-quantity">
                                                        <div class="cart-plus-minus">
                                                            <button class="dec qtybutton minus"><i class="fa-solid fa-minus"></i></button>
                                                            <input type="text" name="quantity" value="1">
                                                            <button class="inc qtybutton plus"><i class="fa-solid fa-plus"></i></button>
                                                        </div>
                                                        <span class="dec qtybtn"></span>
                                                        <span class="inc qtybtn"></span>
                                                    </div>
                                                </div>
                                                <div class="item-remove">
                                                    <span class="remove-wrap">
                                                        <a href="javascript:void(0)" class="text-danger">Remove</a>
                                                    </span>
                                                </div>
                                            </li>
                                            <!-- cart-qty end -->
                                            <!-- cart-price start -->
                                            <li class="item-price">
                                                <span class="amount full-price">$24,00</span>
                                            </li>
                                            <!-- cart-price end -->
                                        </ul> --}}
                                    </div>
                                    <div class="cart-buttons">
                                        <a href="collection.html" class="btn-style2">Continue shopping</a>
                                        <a href="cart-empty.html" class="btn-style2">Clear cart</a>
                                    </div>
                                </div>
                                <div class="special-notes">
                                    <label>Special instructions for seller</label>
                                    <textarea rows="10" name="note"></textarea>
                                </div>
                            </div>
                            <div class="cart-info-wrap">
                                <div class="cart-calculator cart-info">
                                    <h6>Shipping info</h6>
                                    <div class="culculate-shipping" id="shipping-calculator">
                                        <ul>
                                            <li class="field">
                                                <label>Country</label>
                                                <select>
                                                    <option>India</option>
                                                    <option>Afghanistan</option>
                                                    <option>Austria </option>
                                                    <option>Belgium</option>
                                                    <option>Bhutan</option>
                                                    <option>Canada</option>
                                                    <option>France</option>
                                                    <option>Germany</option>
                                                    <option>Maldives</option>
                                                    <option>Nepal</option>
                                                </select>
                                            </li>
                                            <li class="field">
                                                <label>State</label>
                                                <select>
                                                    <option>Gujarat</option>
                                                    <option>Andaman and Nicobar Islands</option>
                                                    <option>Andhra Pradesh</option>
                                                    <option>Bihar</option>
                                                    <option>Chandigarh</option>
                                                    <option>Delhi</option>
                                                    <option>Haryana</option>
                                                    <option>Jammu and Kashmir</option>
                                                    <option>Karnataka</option>
                                                    <option>Ladakh</option>
                                                </select>
                                            </li>
                                            <li class="field cpn-code">
                                                <label>Postal/Zip Codes</label>
                                                <input type="text" name="q" placeholder="Zip/Postal Code">
                                            </li>
                                        </ul>
                                        <div class="shipping-info">
                                            <a href="javascript:void(0)" class="btn btn-style2">Calculate</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-total-wrap cart-info">
                                    <div class="cart-total">
                                        <div class="total-amount">
                                            <h6 class="total-title">Total</h6>
                                            <span class="amount total-price">$56.00</span>
                                        </div>
                                        <div class="proceed-to-discount">
                                            <input type="text" name="discount" placeholder="Discount code">
                                        </div>
                                        <div class="proceed-to-checkout">
                                            <a href="checkout-style1.html" class="btn btn-style2">Checkout</a>
                                        </div>
                                        <div class="cart-payment-icon">
                                            <ul class="payment-icon">
                                                <li>
                                                    <a href="index.html">
                                                        <img src="img/payment/pay-1.jpg" class="img-fluid" alt="pay-1">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="index.html">
                                                        <img src="img/payment/pay-2.jpg" class="img-fluid" alt="pay-2">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="index.html">
                                                        <img src="img/payment/pay-3.jpg" class="img-fluid" alt="pay-3">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="index.html">
                                                        <img src="img/payment/pay-4.jpg" class="img-fluid" alt="pay-4">
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection

@push('script')
<script>
    $(document).ready(function () {
        $('.cart-quantity').on('change', function () {
            let quantity = parseInt($(this).val());

            let productId = $(this).data('id');
            let stock = parseInt($(this).data('stock'));
            console.log(quantity,stock);
            let totalElement = $(this).closest('tr').find('.product-total');
            let stockMessage = $(this).closest('.cart-product-quantity').find('.stock-message');

            if (quantity > stock) {

                $(this).val(stock); // Set max stock
                stockMessage.removeClass('d-none'); // Show stock message
                // toastr.warning("You have reached the maximum stock limit!");
                return;
            } else {
                stockMessage.addClass('d-none'); // Hide stock message if valid
            }

            $.ajax({
                url: "{{ route('cart.updateQuantity') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    quantity: quantity
                },
                success: function (response) {
                    if (response.status === "success") {
                        totalElement.text(response.total);
                        $('#cart-subtotal').text(response.subtotal);
                        $('#cart-total').text(response.subtotal);
                        $('input[name="total"]').val(response.subtotal);
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function () {
                    toastr.error("Something went wrong!");
                }
            });
        });
    });
</script>
@endpush

