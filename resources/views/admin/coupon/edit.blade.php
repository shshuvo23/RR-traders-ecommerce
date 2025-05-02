@extends('admin.layouts.master')

@section('coupon', 'active')
@section('title') {{ isset($coupon) ? 'Edit Coupon' : 'Create Coupon' }} @endsection
@php
    use Carbon\Carbon;
@endphp
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ isset($coupon) ? 'Edit Coupon' : 'Create Coupon' }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ isset($coupon) ? 'Edit Coupon' : 'Create Coupon' }}</li>
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
                                        <h3 class="card-title">{{ isset($coupon) ? 'Edit Coupon' : 'Create Coupon' }}</h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">
                                            <a href="{{ route('admin.coupon.index') }}" class="btn btn-primary btn-gradient btn-sm">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-4">
                                <form action="{{ isset($coupon) ? route('admin.coupon.update', $coupon->id) : route('admin.coupon.store') }}"
                                    method="post">
                                    @csrf
                                    @if(isset($coupon))
                                        @method('PUT')
                                    @endif

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="code" class="form-label">Coupon Code</label>
                                                <input type="text" name="code" id="code" class="form-control" placeholder="Enter Coupon Code"
                                                    value="{{ old('code', $coupon->code ?? '') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="discount" class="form-label">Discount Amount</label>
                                                <input type="number" name="discount" id="discount" class="form-control" placeholder="Enter Discount"
                                                    value="{{ old('discount', $coupon->discount ?? '') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="discount_type" class="form-label">Discount Type</label>
                                                <select name="discount_type" id="discount_type" class="form-control">
                                                    <option value="percentage" {{ (isset($coupon) && $coupon->discount_type == 'percentage') ? 'selected' : '' }}>Percentage</option>
                                                    <option value="fixed" {{ (isset($coupon) && $coupon->discount_type == 'fixed') ? 'selected' : '' }}>Fixed Amount</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="used_count" class="form-label">Usage Limit</label>
                                                <input type="number" name="used_count" id="used_count" class="form-control" placeholder="Enter Usage Limit"
                                                    value="{{ old('used_count', $coupon->used_count ?? '') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="expiry_date" class="form-label">Expiration Date</label>
                                                <input type="date" name="expiry_date" id="expiry_date" class="form-control"
                                                    value="{{ old('expiry_date', isset($coupon->expiry_date) ? Carbon::parse($coupon->expiry_date)->format('Y-m-d') : '') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="status" class="form-label">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1" {{ (isset($coupon) && $coupon->status == 1) ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ (isset($coupon) && $coupon->status == 0) ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success">
                                                    {{ isset($coupon) ? 'Update Coupon' : 'Add Coupon' }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
