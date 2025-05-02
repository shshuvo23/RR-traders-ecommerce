@extends('admin.layouts.master')

@section('coupon', 'active')
@section('title') {{ $data['title'] ?? 'Coupons' }} @endsection

@push('style')
@endpush

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $data['title'] ?? 'Coupons' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $data['title'] ?? 'Coupons' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h3 class="card-title">Manage {{ $data['title'] ?? 'Coupons' }}</h3>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <a href="{{ route('admin.coupon.create') }}" class="btn btn-primary btn-sm">Add New</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table id="dataTables" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">SL</th>
                                        <th width="20%">Code</th>
                                        <th width="15%">Discount</th>
                                        <th width="15%">Type</th>
                                        {{-- <th width="15%">Usage Limit</th> --}}
                                        <th width="10%">Usage Limit</th>
                                        <th width="10%">Status</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $index => $coupon)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $coupon->code }}</td>
                                        <td>{{ $coupon->discount }}</td>
                                        <td>{{ ucfirst($coupon->discount_type) }}</td>
                                        {{-- <td>{{ $coupon->usage_limit ?? 'Unlimited' }}</td> --}}
                                        <td>{{ $coupon->used_count }}</td>
                                        <td>
                                            <span class="badge {{ $coupon->status ? 'badge-success' : 'badge-danger' }}">
                                                {{ $coupon->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.coupon.edit', $coupon->id) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form action="{{ route('admin.coupon.delete', $coupon->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
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
