@extends('admin.layouts.master')
@section('coupon', 'active')
@section('title') {{ $data['title'] ?? 'Create Coupon' }} @endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create Coupon</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Create Coupon</li>
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
                                        <h3 class="card-title">Create Coupon</h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">
                                            <a href="{{ route('admin.coupon.index') }}" class="btn btn-primary btn-gradient btn-sm">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-4">
                                <form action="{{ route('admin.coupon.store') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="code" class="form-label">Coupon Code</label>
                                                <input type="text" name="code" id="code" placeholder="Enter Coupon Code" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="discount" class="form-label">Discount Amount</label>
                                                <input type="number" name="discount" id="discount" class="form-control" placeholder="Enter Discount" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="discount_type" class="form-label">Discount Type</label>
                                                <select name="discount_type" id="discount_type" class="form-control">
                                                    <option value="percentage">Percentage</option>
                                                    <option value="fixed">Fixed Amount</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="used_count" class="form-label">Usage Limit</label>
                                                <input type="number" name="used_count" id="used_count" class="form-control" placeholder="Enter Usage Limit" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="expiry_date" class="form-label">Expiration Date</label>
                                                <input type="date" name="expiry_date" id="expiry_date" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="status" class="form-label">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success">Add Coupon</button>
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
