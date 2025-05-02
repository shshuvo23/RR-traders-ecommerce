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
<style>
    #coupon_code {
        text-transform: uppercase;
    }
    .btn_coupon_remove{
        /* background-color: red; */
        color: red;
        border: none;
        /* padding: 5px 10px; */
        font-size: 26px;
        cursor: pointer;
    }
    .payment-methods {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .payment-option {
        position: relative;
    }

    .payment-label {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        border: 2px solid #ddd;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s ease-in-out;
    }

    .payment-label:hover,
    .payment-option input:checked + .payment-label {
        border-color: #007bff;
        background-color: #f0f8ff;
    }

    .payment-label i {
        font-size: 20px;
        color: #007bff;
    }
    .select2-container .select2-selection--single {
        height: 46px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding: 8px 8px;
    }
    .select2-container--default .select2-selection--single {
        background-color: #fafafa !important;
        border: 1px solid #ebebeb !important;
        border-radius: 4px;
    }
    .iti.iti--allow-dropdown.iti--separate-dial-code {
        width: 100% !important;
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
        <div class="container-fluid">
            <form action="{{route('user.order.process')}}" method="post" id="checkout_form">
                @csrf
                <input type="hidden" name="subtotal" value="{{$total}}">
                <input type="hidden" name="tax_rate" id="tax_rate">
                <input type="hidden" name="shipping_fee" id="shipping_fee">
                <div class="row">
                    <div class="col-lg-9">
                        <h2 class="summary-title">Billing Details</h2>
                        <div class="row">
                            <div class="col-sm-6">
                                <label><strong>Full Name</strong> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}" required
                                    placeholder="Enter your name">
                            </div>
                            <div class="col-sm-6">
                                <label><strong>Email</strong> <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}" required
                                    placeholder="Enter your email address">
                            </div>
                            <div class="col-sm-6">
                                <label><strong>Street address</strong> <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="street" required
                                    placeholder="Enter your street address">
                            </div>
                            <div class="col-sm-6">
                                <label><strong>Postcode / ZIP </strong> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="zipcode" required placeholder="Enter your postcode or ZIP code">
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label><strong>Phone</strong> <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" name="phone" id="phone"  required placeholder="Enter your phone number">

                            </div>
                            <div class="col-sm-6 mb-3">
                                <label><strong>Country</strong> <span class="text-danger">*</span></label>
                                <select class="form-control" name="country_id" id="country" required style="padding: 9px 12px !important; height: 46px !important;">
                                    <option value="" class="d-none">Select Country</option>
                                @foreach ($countries as $item)
                                    <option value="{{$item->id}}" {{old('country_id' == $item->id) ? 'selected' : ''}}>{{$item->name}}</option>
                                @endforeach
                                </select>
                                {{-- <input type="text" class="form-control" name="country" required
                                    placeholder="Enter your country"> --}}
                            </div>
                            <div class="col-sm-6 ">
                                <label><strong>State / County </strong> <span class="text-danger">*</span></label>
                                <select class="form-control" name="state_id" id="state" required style="padding: 9px 12px !important; height: 46px !important;">
                                    <option value="" class="d-none">Select State</option>
                                </select>
                                {{-- <input type="text" class="form-control" name="state" required
                                    placeholder="Enter your state or county"> --}}
                            </div>
                            <div class="col-sm-6">
                                <label><strong>City</strong> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="city" required placeholder="Enter your city">
                            </div>

                            <div class="col-12">
                                <label><strong>Order notes (optional)</strong></label>
                                <textarea class="form-control" cols="30" name="note" rows="4" placeholder="Enter any notes about your order (optional)"></textarea>
                            </div>
                        </div>

                    </div>

                    <aside class="col-lg-3">
                        {{-- @if (!$coupon) --}}
                            <div class="coupon-section mb-3" id="couponForm">
                                <h3 class="summary-title">Apply Coupon</h3>
                                <div class="input-group">
                                    <input type="text" id="coupon_code" name="coupon_code" class="form-control" placeholder="Enter coupon code">
                                    <div class="input-group-append">
                                        <button type="button" id="applyCoupon" class="btn btn-outline-primary">Apply</button>
                                    </div>
                                </div>
                                <p id="couponMessage" class="text-success mt-2" style="display: none;"></p>
                            </div>
                        {{-- @endif --}}


                        <div class="summary">
                            <h3 class="summary-title">Your Order</h3>

                            <table class="table table-summary">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($cartItems as $item)
                                    <tr>
                                        <td>
                                            <a href="{{route('productDetails', $item['slug'])}}">{{$item['title']}}</a>
                                        </td>
                                        <td>
                                            ({{$item['quantity']}} X {{$item['price']}})
                                        </td>
                                        <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    </tr>
                                    @endforeach
                                    {{-- <tr>
                                        <td><a href="#">Blue utility pinafore denimdress</a></td>
                                        <td>$76,00</td>
                                    </tr> --}}
                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td colspan="2" id="subtotalPrice">${{$total}}</td>
                                    </tr>
                                    @if ($coupon)
                                        <tr id="couponDiscountRow">
                                            <td>Coupon Discount:</td>
                                            <td class="text-center">
                                                <button type="button" id="removeCoupon" class="btn_coupon_remove" title="Remove Coupon"><i class="fa-solid fa-xmark"></i></button>
                                            </td>
                                            <td colspan="2" id="couponDiscountAmount"> - ${{ number_format($coupon['discount'], 2) }}</td>

                                        </tr>

                                        @php
                                            $adjustedTotal = $total - $coupon['discount'];
                                        @endphp
                                    @else
                                        <tr id="couponDiscountRow" style="display: none;">
                                            <td>Coupon Discount:</td>
                                            <td  class="text-center">
                                                <button type="button" id="removeCoupon" class="btn_coupon_remove" title="Remove Coupon"><i class="fa-solid fa-xmark"></i></button>
                                            </td>
                                            <td id="couponDiscountAmount"></td>
                                        </tr>

                                        @php
                                            $adjustedTotal = $total;
                                        @endphp
                                    @endif
                                    <tr>
                                        <td>Shipping:</td>
                                        <td colspan="2" id="shipping-fee">$ 0</td>
                                    </tr>
                                    <tr>
                                        <td>Tax rate: <span id="tax-rate">0%</span></td>
                                        <td colspan="2" id="tax-amount">$0.00</td>
                                    </tr>
                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td colspan="2" id="totalPrice">${{ number_format($adjustedTotal, 2)}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="payment-methods">
                                <h6 class="mb-2">Choose Your Payment Method</h6>

                                <div class="payment-option">
                                    <input type="radio" id="cod" name="payment_method" value="cod" class="d-none">
                                    <label for="cod" class="payment-label">
                                        <i class="fas fa-truck"></i>
                                        <span>Cash on Delivery</span>
                                    </label>
                                </div>

                                {{-- <div>
                                    <label>
                                        <input type="radio" name="payment_method" value="paypal"> PayPal
                                    </label>
                                </div> --}}

                                <div class="payment-option">
                                    <input type="radio" id="stripe" name="payment_method" value="stripe" class="d-none">
                                    <label for="stripe" class="payment-label">
                                        <i class="fab fa-cc-stripe"></i>
                                        <span>Stripe</span>
                                    </label>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-outline-primary-2 py-4 rounded btn-order btn-block">
                                <span class="btn-text">Place Order</span>
                                <span class="btn-hover-text">Proceed to Checkout</span>
                            </button>
                        </div>
                    </aside>
                </div>
            </form>

        </div>
    </div>

@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // Initialize the intl-tel-input plugin
            var input = document.querySelector("#phone");
            var iti = window.intlTelInput(input, {
                initialCountry: "us",
                preferredCountries: ['us', 'gb', 'ca'],
                separateDialCode: true,
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/js/utils.js"
            });

            $('#checkout_form').submit(function(e) {
                e.preventDefault();

                var fullPhoneNumber = iti.getNumber();
                var countryCode = iti.getSelectedCountryData().dialCode;

                $('input[name="phone"]').val(fullPhoneNumber);
                console.log('Country Code:', countryCode);
                console.log('Phone Number:', fullPhoneNumber);

                this.submit();
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            function calculateTotal() {
                var subtotal = parseFloat($('#subtotalPrice').text().replace('$', '').trim()); // Get the subtotal
                var taxRate = parseFloat($('#tax_rate').val()) || 0; // Get the tax rate
                var shippingFee = parseFloat($('#shipping_fee').val()) || 0; // Get the shipping fee
                var couponDiscount = parseFloat($('#couponDiscountAmount').text().replace('-', '').replace('$', '').trim()) || 0;
                console.log(couponDiscount,subtotal);


                // Calculate the tax
                var taxAmount = subtotal * (taxRate / 100);

                // Calculate the total (subtotal + tax + shipping fee - coupon discount)
                var total = subtotal + taxAmount + shippingFee - couponDiscount;

                // Update the total price in the summary
                $('#totalPrice').text('$' + total.toFixed(2));
                $('#tax-rate').text(taxRate + '%');
                $('#tax-amount').text('$' + taxAmount.toFixed(2));
            }

            $('#country').select2({
                placeholder: 'Select Country',
                allowClear: true
            });

            $('#state').select2({
                placeholder: 'Select State',
                allowClear: true
            });



            $('#country').change(function() {
                var countryId = $(this).val();

                if (countryId) {
                    // Make an AJAX request to fetch states for the selected country
                    $.ajax({
                        url:"{{ route('user.getStates', ':countryId') }}".replace(':countryId', countryId), // Replace with your route
                        method: 'GET',
                        success: function(response) {
                            var stateSelect = $('#state');
                            stateSelect.empty(); // Clear current options
                            stateSelect.append('<option value="" class="d-none">Select State</option>'); // Add default option

                            // Populate the state options
                            $.each(response.states, function(index, state) {
                                stateSelect.append('<option value="' + state.id + '">' + state.name + '</option>');
                            });
                            // Update tax rate for the selected country
                            $('#tax-rate').text(response.tax_rate + '%');
                            $('#tax_rate').val(response.tax_rate);
                            calculateTotal();
                        },
                        error: function() {
                            alert('Could not load states. Please try again.');
                        }
                    });
                } else {
                    $('#state').empty().append('<option value="" class="d-none">Select State</option>');
                    $('#tax-rate').text('0%');
                    $('#tax_rate').val('');
                    calculateTotal(); // Recalculate total if country is cleared
                }
            });

            $('#state').change(function() {
                var stateId = $(this).val();

                if (stateId) {
                    // Fetch the shipping fee for the selected state
                    $.ajax({
                        url: "{{ route('user.getshippingFee', ':stateId') }}".replace(':stateId', stateId),  // Your route to get shipping fee by state
                        method: 'GET',
                        success: function(response) {
                            // Update shipping fee
                            $('#shipping-fee').text('$ ' + response.shipping_fee);
                            $('#shipping_fee').val(response.shipping_fee);
                            calculateTotal();
                        },
                        error: function() {
                            alert('Could not load shipping fee. Please try again.');
                        }
                    });
                } else {
                    $('#shipping-fee').text('$ 0');
                    $('#shipping_fee').val('');
                    calculateTotal(); // Recalculate total if state is cleared
                }
            });

            $('#applyCoupon').on('click', function() {
                var couponCode = $('#coupon_code').val();
                var subtotal = parseFloat($('#subtotalPrice').text().replace('$', '').trim()); // Getting the subtotal

                // Send the coupon code and subtotal to the backend for validation
                $.ajax({
                    url: '{{ route("user.apply.coupon") }}', // Assuming you have a route defined for this
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token for security
                        coupon_code: couponCode,
                        subtotal: subtotal // Sending the subtotal
                    },
                    success: function(response) {
                        if (response.success) {
                            // Hide the coupon form after applying coupon
                            // $('#couponForm').hide();
                            $('#removeCoupon').show();
                            $('#couponMessage').text(response.message).removeClass('text-danger').addClass('text-success').show();

                            // Show the coupon discount row
                            $('#couponDiscountRow').show();
                            $('#couponDiscountAmount').text('- $' + parseFloat(response.discount).toFixed(2));  // Display the discount amount

                            // Update the total price
                            // $('#totalPrice').text('$' + parseFloat(response.new_total).toFixed(2));  // Update total with new amount after applying the coupon
                            calculateTotal();
                        } else {
                            // Show error message if coupon is invalid
                            $('#couponMessage').text(response.message).removeClass('text-success').addClass('text-danger').show();
                        }
                    }
                });
            });
            $(document).on("click", "#removeCoupon", function () {
                $.ajax({
                    url: '{{ route("user.remove.coupon") }}', // Add a new route for removing the coupon
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        if (response.success) {
                            $("#couponDiscountRow").hide();
                            $("#couponDiscountAmount").text("");
                            // $("#totalPrice").text("$" + response.original_total.toFixed(2));

                            // Show coupon form again
                            // $("#couponForm").show();
                            $("#coupon_code").val("");
                            $("#couponMessage").hide();

                            // Hide remove button
                            $("#removeCoupon").hide();

                            calculateTotal();
                        }
                    },
                });
                calculateTotal();
            });

        });
    </script>
@endpush


