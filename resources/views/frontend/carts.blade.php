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
        <li class="breadcrumb-item"> {{$title}}</li>
    @endsection
    <!-- ======================= breadcrumb end  ============================ -->

    <div class="page-content pt-2 pb-2">
        <div class="">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="cart_table">
                            <table class="table table-cart table-mobile m-0">
                                <thead>
                                    <tr>
                                        <th style="width:50%;">Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($cartItems) > 0)
                                        @foreach ($cartItems as $item)
                                            <tr>
                                                <td class="product-col">
                                                    <div class="product">
                                                        <figure class="product-media">
                                                            <a href="{{route('productDetails', $item['slug'])}}">
                                                                <img src="{{asset($item['thumbnail'])}}"
                                                                    alt="Product image">
                                                            </a>
                                                        </figure>

                                                        <h3 class="product-title">
                                                            <a href="{{route('productDetails', $item['slug'])}}">{{$item['title']}}</a>
                                                        </h3>
                                                    </div>
                                                </td>
                                                <td class="quantity-col">
                                                    <div class="cart-product-quantity">
                                                        <input type="number" class="form-control cart-quantity" value="{{$item['quantity']}}"
                                                            min="1" max="{{ $item['stock'] }}" step="1"
                                                            data-decimals="0"
                                                            data-id="{{ $item['product_id'] }}"
                                                            data-price="{{($item['price'])}}"
                                                            data-stock="{{ $item['stock'] }}"
                                                        required>
                                                        <small class="text-danger stock-message d-none">Stock is over!</small>
                                                    </div>
                                                </td>
                                                <td class="price-col">${{$item['price']}}</td>
                                                <td class="total-col">$<span class="product-total">{{ number_format($item['price'] * $item['quantity'], 2) }}</span></td>
                                                <td class="remove-col">
                                                    <a href="{{ route('cart.remove', $item['product_id']) }}" class="btn btn-danger">
                                                        <i class="icon-close"></i>
                                                    </a>
                                                    {{-- <button class="btn-remove"><i class="icon-close"></i></button> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <h3>Your cart is empty.</h3>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="cart-bottom w-100 d-block mt-4">
                            <div class="d-sm-flex align-items-center justify-content-end">
                                {{-- <div class="cart-discount mb-1 mb-sm-0 w-100">
                                    <form action="#">
                                        <div class="input-group">
                                            <input type="text" class="form-control" required
                                                placeholder="coupon code">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary-2 px-4" type="submit">
                                                   Apply
                                                </button>
                                            </div><!-- .End .input-group-append -->
                                        </div>
                                    </form>
                                </div> --}}
                                <div class="">
                                    <a href="{{route('shop')}}" class="btn btn-outline-dark-2 btn-block py-3">
                                        <span>CONTINUE SHOPPING</span><i class="icon-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <aside class="col-lg-3">
                        <div class="summary summary-cart">
                            <h3 class="summary-title">Cart Total</h3>

                            <table class="table table-summary">
                                <tbody>
                                    <tr class="summary-shipping">
                                        <td class="pb-0">Subtotal:</td>
                                        <td class="pb-0">$<span id="cart-subtotal">{{ $subtotal }}</span></td>
                                    </tr>
                                    {{-- <tr class="summary-shipping">
                                        <td class="pb-0">Discount (10%):</td>
                                        <td class="pb-0">-$16.00</td>
                                    </tr>
                                    <tr class="summary-shipping">
                                        <td class="pb-0">Tax (8%):</td>
                                        <td class="pb-0">$11.52</td>
                                    </tr>
                                    <tr class="summary-shipping">
                                        <td class="pb-0">Shipping:</td>
                                        <td class="pb-0">$5.00</td>
                                    </tr> --}}
                                    <tr class="summary-total">
                                        <td><strong>Total:</strong></td>
                                        <td><strong>$<span id="cart-total">{{ $subtotal }}</span></strong></td>
                                    </tr>
                                </tbody>
                            </table>

                            @if (count($cartItems) > 0)
                                {{-- @auth
                                    <form action="{{ route('user.checkout') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="total" value="{{ $subtotal }}">
                                        <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</button>
                                    </form>
                                @else
                                    <a href="{{route('login')}}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                                @endauth --}}
                                <a href="{{ route('checkout') }}" class="btn btn-checkout"><i class="fas fa-lock"></i> Checkout</a>
                                {{-- <form action="{{ route('checkout') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="total" value="{{ $subtotal }}">
                                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</button>
                                </form> --}}
                            @endif
                        </div>


                    </aside>
                </div>
            </div>
        </div>
    </div>

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

