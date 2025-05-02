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

    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">{{$title}}</h1>
        </div><!-- End .container -->
    </div>
    <div class="page-content mt-3">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-4 col-lg-3">
                       @include('user.sidebar')

                    </aside>
                    <div class="col-md-8 col-lg-9">
                        <div class="table-responsive">
                            @if ($orders->isNotEmpty())
                            <table class="table table-bordered text-center" style="border: 1px solid #dee2e6;">
                                <thead class="text-white">
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="10%">Order ID</th>
                                        <th width="10%">Order Date</th>
                                        <th width="10%">Payment Method</th>
                                        <th width="10%">Payment Status</th>
                                        <th width="10%">Order Status</th>
                                        <th width="5%">Total Price</th>
                                        <th width="5%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($orders as $item)
                                    <tr>

                                    <td style="padding: 18px !important;">{{$loop->iteration}}</td>
                                    <td>#{{ $item->order_number }}</td>
                                    <td>{{ date('d M Y',strtotime($item->order_date)) }}</td>

                                    <td>
                                        @if ($item->payment_method == 'stripe')
                                            <span class="text-primary">Stripe</span>
                                        @else
                                            <span class="text-info">Cash on Delivery</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->payment_status == '1')
                                            <span class="text-success">Paid</span>
                                        @else
                                            <span class="text-danger">Due</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->order_status == '1')
                                            <span class="text-gray">Confirm</span>
                                        @elseif($item->order_status == '3')
                                            <span class="text-warning">Shipped</span>
                                        @elseif($item->order_status == '4')
                                            <span class="text-success">Delivered</span>
                                        @elseif($item->order_status == '5')
                                            <span class="text-danger">Cancel</span>
                                        @elseif ($item->order_status == '6')
                                            <span class="text-info">Canceled and Refund</span>
                                        @else
                                            <span class="text-primary">Pending</span>
                                        @endif
                                    </td>

                                    <td>${{ number_format($item->grand_total, 2) }}</td>

                                    <td>
                                        <a href="{{route('user.order.details', $item->order_number)}}" class="btn btn-sm btn-info" style="padding: 5px !important; min-width: 50px; border-radius: 3px;">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                                </tbody>

                            </table>
                            @else
                            <div class="text-center mt-5">
                                <strong>No Order Found</strong>
                            </div>

                        @endif
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $orders->links() }}
                        </div>

                    </div><!-- End .col-md-8 -->

                </div>
            </div>
        </div>
    </div>

@endsection
