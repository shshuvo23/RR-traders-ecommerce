@extends('admin.layouts.master')
@section('order', 'active')
@section('title') {{ $title ?? 'View Order Details' }} @endsection

@push('style')
    <style>
        td {
            width: 0;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? 'View Order Details' }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.order.index') }}">Manage Orders</a></li>
                            <li class="breadcrumb-item active">{{ $title ?? 'View Order Details' }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page header -->
        <div class="page-header d-print-none pb-3">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Invoice
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                            <!-- Download SVG icon from http://tabler.io/icons/icon/printer -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-1">
                                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                            </svg>
                            Print Invoice
                        </button>
                        <a href="{{route('admin.order.index')}}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->

        <div class="page-body">
            <div class="container-xl">
                <div class="card card-lg">
                    <div class="card-body">
                        <div class="row d-flex justify-content-between">
                            <div class="pt-2">
                                <p class="h3">{{$order->customer_name}}</p>
                                {{-- @dd($order->state->name) --}}
                                <address>
                                    
                                    {{ $order->customer_email ?? '' }}<br>
                                    {{ $order->customer_phone ?? '' }}<br>
                                    {{ $order->company_name ?? '' }}<br>
                                    {{ $order->city ?? '' }},{{ $order->apartment_suite ?? '-' }} <br>
                                    {{ $order->state->name ?? '' }},{{ $order->country->name ?? '' }}<br>
                                    {{ $order->zipcode ?? '' }}<br>

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
                            <div class="col-6">
                                <h3>Invoice: #{{ $order->order_number }}</h3>
                                <h5>Order Status :
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
											<p class="strong mb-1"><a href="{{route('admin.product.show', $detail->product_id)}}">{{ $detail->product_title ?? '' }}</a> </p>
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
                                    <td colspan="4" class="strong text-end">Tax</td>
                                    <td class="text-end">${{ number_format($order->vat ?? 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="strong text-end">Shipping Charge</td>
                                    <td class="text-end">${{ number_format($order->shipping_charge) }}</td>
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
        </div>

    </div>
@endsection
