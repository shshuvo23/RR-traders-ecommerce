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
        </div>
    </div>
    <div class="page-content mt-3">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-4 col-lg-3">
                       @include('user.sidebar')

                    </aside>

                    <div class="col-md-8 col-lg-9">
                        <div class="row">
                            <!-- Total Orders -->
                            <div class="col-md-4">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <p class="text-muted mb-1">Total Orders</p>
                                        <h6 class="font-weight-bold ">{{ $totalOrders }}</h6>
                                    </div>
                                </div>
                            </div>

                            <!-- Join Date -->
                            <div class="col-md-4">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <p class="text-muted mb-1">Join Date</p>
                                        <h6 class="font-weight-bold ">{{date('d M Y',strtotime(auth()->user()->created_at))}}</h6>
                                    </div>
                                </div>
                            </div>

                            <!-- Latest Order -->
                            <div class="col-md-4">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <p class="text-muted mb-1">Latest Order</p>
                                        <h6 class="font-weight-bold ">{{$latestOrder ? '#'.$latestOrder->order_number : 'No Order Found'}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Latest Orders Table -->
                        <div class="card mt-4 shadow-sm border-0">
                            <div class="card-header text-white">
                                <h5 class="mb-0">Latest Orders</h5>
                            </div>
                            <div class="card-body p-2">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>Order Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestOrders as $order)
                                            <tr>
                                                <td>#{{ $order->order_number }}</td>
                                                <td>{{ date('d M Y', strtotime($order->order_date)) }}</td>
                                                <td>${{ number_format($order->grand_total, 2) }}</td>
                                                <td>
                                                    @if ($order->order_status == '1')
                                                        <span class="text-gray">Confirm</span>
                                                    @elseif($order->order_status == '3')
                                                        <span class="text-warning">Shipped</span>
                                                    @elseif($order->order_status == '4')
                                                        <span class="text-success">Delivered</span>
                                                    @elseif($order->order_status == '5')
                                                        <span class="text-danger">Cancel</span>
                                                    @elseif ($order->order_status == '6')
                                                        <span class="text-info">Canceled and Refund</span>
                                                    @else
                                                        <span class="text-primary">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('user.order.details', $order->order_number) }}" class="btn btn-sm btn-info">
                                                        View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
