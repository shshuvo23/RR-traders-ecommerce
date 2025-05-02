@extends('frontend.layouts.app')

@section('title')
{{ $title ?? '' }}
@endsection

@section('meta')
    {{-- <meta property="og:title" content="{{ $seo->title ?? $og_title }}" />
    <meta property="og:description" content="{{ $seo->description ?? $og_description }}" />
    <meta property="og:image" content="{{ asset($seo->image ?? $og_image) }}" />
    <meta name="description" content="{{$seo->meta_description ?? $og_description}}">
    <meta name="keywords" content="{{$seo->keywords ?? $meta_keywords}}"> --}}
@endsection
@push('style')
<style>
</style>
@endpush
{{-- @php
    $localLanguage = Session::get('languageName');
@endphp --}}
@section('content')
    <!-- ======================= breadcrumb start  ============================ -->
    @section('breadcrumb')
        <li class="breadcrumb-item"> {{$title}}</li>
    @endsection
    <!-- ======================= breadcrumb end  ============================ -->

    <div class="page-header text-center d-print-none">
        <div class="container">
            <h1 class="page-title">{{$title}}</h1>
        </div><!-- End .container -->
    </div>
    <div class="page-content mt-3">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-4 col-lg-3 d-print-none">
                       @include('user.sidebar')

                    </aside>
                    <div class="col-md-8 col-lg-9 d-print-none">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h3>Invoice</h3>
                            <div>
                                <button class="btn btn-primary btn-sm" onclick="printInvoice()" style="min-width: 50px !important;">
                                    <i class="fas fa-print"></i> Print Invoice
                                </button>
                                <a href="{{ route('user.order.list') }}" class="btn btn-primary btn-sm" style="min-width: 50px !important;">Back</a>
                            </div>
                        </div>
                        <div id="invoiceSection">
                            <div class="card card-lg">
                                <div class="card-body">
                                    <div class="row d-flex justify-content-between">
                                        <div class="pt-2">
                                            <p class="h3">{{$order->customer_name}}</p>
                                            {{-- @dd($order->state->name) --}}
                                            <address>
                                                {{ $order->customer_email ?? '' }}<br>
                                                {{ $order->customer_phone ?? '' }}<br>
                                                {{ $order->company_name }} <br>
                                                {{ $order->city ?? '' }}, {{ $order->apartment_suite ?? '' }} <br>
                                                {{ $order->state->name ?? '' }}, {{ $order->country->name ?? '' }}
                                                {{-- {{ $order->customer_email ?? '' }}<br> --}}

                                            </address>
                                        </div>
                                        <div class="pt-2 text-right">
                                            <p class="h3">{{getSetting()->site_name}}</p>
                                            <address>
                                                {{ $order->email ?? '' }} <br>
                                                {{ $company_data->phone_no ?? '' }}<br>
                                                {{-- {{ $order->street ?? 'Street Address' }}<br> --}}
                                                {{ $company_data->office_address ?? '' }}<br>
                                                {{-- {{ $order->zipcode ?? 'Postal Code' }}<br> --}}
                                            </address>
                                        </div>
                                        <div class="col-6 p-0">
                                            <h3 class="">Invoice: #{{ $order->order_number }}</h3>
                                            <h5 class="">Order Status :
                                                @if ($order->order_status == '1')
                                                    Confirm
                                                @elseif ($order->order_status == '3')
                                                    Shipped
                                                @elseif ($order->order_status == '4')
                                                    Delivered
                                                @elseif ($order->order_status == '5')
                                                    Canceled
                                                @elseif($order->order_status == '6')
                                                    Canceled and Refund
                                                @else
                                                    Pending
                                                @endif
                                            </h5>
                                        </div>
                                        <div class="col-6 text-right">
                                            <h5>Payment Info</h5>
                                            <p>Invoice Date: {{ date('d M Y',strtotime($order->order_date))}}</p>
                                            <p>Payment Method: {{ $order->payment_method == 'stripe' ? 'Stripe' : 'Cash on Delivery' }}</p>
                                            <p>Payment Status: {{ $order->payment_status == '1' ? 'Paid' : 'Due' }}</p>

                                        </div>
                                    </div>
                                    <table class="table table-transparent table-responsive">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 5%">#</th>
                                                <th style="width: 10%">Product</th>
                                                <th class="text-center" style="width: 5%">Qnt</th>
                                                <th class="text-right" style="width: 10%">Unit Price</th>
                                                <th class="text-right" style="width: 5%">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php
                                            $totalAmount = $order->orderDetails->sum(function ($detail) {
                                                return $detail->product_quantity * $detail->product_price;
                                            });
                                            @endphp

                                            @foreach ($order->orderDetails as $key => $detail)

                                                <tr>
                                                    <td class="text-center">{{ $key + 1 }}</td>
                                                    <td>
                                                        {{-- @dd($detail) --}}
                                                        <p class="strong mb-1"><a href="{{route('productDetails', $detail->product->slug)}}">{{ $detail->product_title ?? '' }}</a> </p>
                                                        {{-- <div class="text-secondary">{{ $detail->product->short_description ?? 'No description available' }}</div> --}}
                                                    </td>
                                                    <td class="text-center">{{ $detail->product_quantity }}</td>
                                                    <td class="text-right">${{ number_format($detail->product_price, 2) }}</td>
                                                    <td class="text-right">
                                                        ${{ number_format($detail->product_quantity * $detail->product_price, 2) }}
                                                    </td>

                                                </tr>
                                            @endforeach

                                            <tr>
                                                <td colspan="4" class="strong text-right">Sub Total</td>
                                                <td class="text-right" colspan="1">${{ number_format($totalAmount ?? 0, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="strong text-right">Tax</td>
                                                <td class="text-right" colspan="1">${{ number_format($order->vat ?? 0, 2) }}</td>
                                            </tr>

                                            <tr>
                                                <td colspan="4" class="strong text-right">Shipping Charge</td>
                                                <td class="text-right" colspan="1">${{ number_format($order->shipping_charge, 2) }}</td>
                                            </tr>


                                            @if ($order->coupon_discount > 0)
                                            <tr>
                                                <td colspan="4" class="strong text-right">Coupon Discount</td>
                                                <td class="text-right" colspan="1">${{ number_format($order->coupon_discount, 2) }}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td colspan="4" class="font-weight-bold text-uppercase text-right">Total</td>
                                                <td class="font-weight-bold text-right" colspan="1">
                                                    ${{ number_format($order->grand_total ?? 0,2) }}
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>


                                    <p class="text-secondary text-center mt-5">Thank you very much for doing shopping with us. We look
                                        forward to working with
                                        you again!</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .col-md-8 -->

                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
<script>
    function printInvoice() {
        var printContents = $("#invoiceSection").html();
        var originalContents = $("body").html();

        $("body").html(printContents);
        window.print();
        $("body").html(originalContents);
        location.reload(); // Refresh to restore page functionality
    }
</script>
@endpush
