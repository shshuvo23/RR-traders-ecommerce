@extends('admin.layouts.master')
@section('dashboard', 'active')

@section('title') {{ $data['title'] ?? '' }} @endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $data['title'] ?? __('messages.common.dashboard') }}</h1>
                        <div>{{ __('messages.Welcome_Back') }}, {{ Auth::user()->name }}</div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.dashboard') }}">{{ __('messages.common.dashboard') }}</a></li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    {{-- <div class="col-lg-3 col-6">

                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $data['plan'] }}</h3>
                                <p>{{ __('messages.user_dashboard.total_package') }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('admin.plan.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div> --}}

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $data['users']->count() }}</h3>
                                <p>{{ __('messages.common.total_users') }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('admin.customer.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $data['categories']}}</h3>
                                <p>Total Active Categories</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('admin.category.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $data['products']}}</h3>
                                <p>Total Active Products</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('admin.product.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>


                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ number_format($data['totalTransaction'], 2, ',', '') }} $</h3>
                                <p>{{ __('messages.user_dashboard.total_transaction') }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('admin.order.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                </div>
                <div class="clearfix hidden-md-up"></div>
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="">
                                        <h4 class="card-title">Latest Order </h4>
                                    </div>
                                    <div class="">
                                        <a href="{{route('admin.order.index')}}"
                                            class="btn btn-sm btn-primary btn-gradient">{{ __('messages.common.view_all') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0 table-responsive">
                                <table id="dataTables" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th width="15%">Order Number</th>
                                            <th width="15%">Customer Name</th>
                                            <th width="15%">Total Price</th>
                                            <th width="15%">Order Date</th>
                                            <th width="10%">Payment Status</th>
                                            <th width="10%">Payment Method</th>
                                            <th width="10%">Status</th>
                                            <th width="5%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['orders'] as $index => $order)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>#{{ $order->order_number }}</td>
                                            <td>{{ $order->customer_name }}</td>
                                            <td>${{ number_format($order->grand_total, 2) }}</td>
                                            <td>{{ date('d M Y',strtotime($order->order_date)) }}</td>
                                            <td>
                                                <span class="badge {{ $order->payment_status == 1 ? 'badge-success' : 'badge-danger' }}">
                                                    {{ $order->payment_status == 1 ? 'PAID' : 'DUE' }}
                                                </span>
                                            </td>

                                            <td>
                                                {{ $order->payment_method == 'cod' ? 'COD':'Stripe'}}
                                            </td>
                                            <td>

                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                                        @switch($order->order_status)
                                                            @case(0)
                                                            @case(null)
                                                                Pending
                                                                @break
                                                            @case(1)
                                                                Confirmed
                                                                @break
                                                            @case(3)
                                                                Shipped
                                                                @break
                                                            @case(4)
                                                                Delivered
                                                                @break
                                                            @case(5)
                                                                Canceled
                                                                @break
                                                            @default
                                                                Pending
                                                        @endswitch
                                                    </button>

                                                    <div class="dropdown-menu">
                                                        @if($order->order_status == 0 || $order->order_status == null)
                                                            <form action="{{ route('admin.order.statusUpdate', $order->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="order_status" value="1">
                                                                <li>
                                                                    <button type="submit" class="dropdown-item" onclick="return confirmStatusChange('Confirm')">
                                                                        <i class="fas fa-check-circle me-2"></i> Confirm
                                                                    </button>
                                                                </li>
                                                            </form>

                                                            <form action="{{ route('admin.order.statusUpdate', $order->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="order_status" value="3">
                                                                <li>
                                                                    <button type="submit" class="dropdown-item" onclick="return confirmStatusChange('Ship')">
                                                                        <i class="fas fa-shipping-fast me-2"></i> Ship
                                                                    </button>
                                                                </li>
                                                            </form>

                                                            <form action="{{ route('admin.order.statusUpdate', $order->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="order_status" value="4">
                                                                <li>
                                                                    <button type="submit" class="dropdown-item" onclick="return confirmStatusChange('Delivery')">
                                                                        <i class="fas fa-truck me-2"></i> Delivery
                                                                    </button>
                                                                </li>
                                                            </form>

                                                            <form action="{{ route('admin.order.statusUpdate', $order->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="order_status" value="5">
                                                                <li>
                                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirmStatusChange('Cancel')">
                                                                        <i class="fas fa-times-circle me-2"></i> Cancel
                                                                    </button>
                                                                </li>
                                                            </form>

                                                        @else
                                                            @if($order->order_status != 1 && $order->order_status != 3 && $order->order_status != 4)
                                                                <form action="{{ route('admin.order.statusUpdate', $order->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="order_status" value="1">
                                                                    <li>
                                                                        <button type="submit" class="dropdown-item" onclick="return confirmStatusChange('Confirm')">
                                                                            <i class="fas fa-check-circle me-2"></i> Confirm
                                                                        </button>
                                                                    </li>
                                                                </form>
                                                            @endif

                                                            @if($order->order_status == 1)
                                                                <form action="{{ route('admin.order.statusUpdate', $order->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="order_status" value="3">
                                                                    <li>
                                                                        <button type="submit" class="dropdown-item" onclick="return confirmStatusChange('Ship')">
                                                                            <i class="fas fa-shipping-fast me-2"></i> Ship
                                                                        </button>
                                                                    </li>
                                                                </form>
                                                            @endif

                                                            @if($order->order_status == 3)
                                                                <form action="{{ route('admin.order.statusUpdate', $order->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="order_status" value="4">
                                                                    <li>
                                                                        <button type="submit" class="dropdown-item" onclick="return confirmStatusChange('Delivery')">
                                                                            <i class="fas fa-truck me-2"></i> Delivery
                                                                        </button>
                                                                    </li>
                                                                </form>
                                                            @endif

                                                            @if($order->order_status == 4)
                                                                <li class="dropdown-item text-success">
                                                                    <i class="fas fa-check-circle me-2"></i> Delivered
                                                                </li>
                                                            @endif

                                                            @if($order->order_status != 4 && $order->order_status != 3)
                                                                <form action="{{ route('admin.order.statusUpdate', $order->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="order_status" value="5">
                                                                    <li>
                                                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirmStatusChange('Cancel')">
                                                                            <i class="fas fa-times-circle me-2"></i> Cancel
                                                                        </button>
                                                                    </li>
                                                                </form>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>


                                            {{-- <td>
                                                <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-sm btn-success">View</a>


                                            </td> --}}

                                            <td>

                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                                      Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        {{-- <li>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fas fa-edit me-2"></i> Edit
                                                            </a>
                                                        </li> --}}
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.order.show', $order->id) }}">
                                                                <i class="fas fa-eye me-2"></i> View
                                                            </a>
                                                        </li>
                                                        {{-- <li>
                                                            <a class="dropdown-item" href="{{ route('admin.product.gallery', $product->id) }}">
                                                                Gallery
                                                            </a>
                                                        </li> --}}
                                                        <li>
                                                            {{-- <a href="{{route('admin.product.delete', $product->id)}}" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this product?');">
                                                                <i class="fas fa-trash me-2"></i> Delete
                                                            </a> --}}
                                                        </li>
                                                    </div>
                                                  </div>
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
