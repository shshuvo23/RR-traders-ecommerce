@extends('admin.layouts.master')
@section('brands', 'active')
@section('title') {{ $title ?? 'View Brand' }} @endsection

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
                    <h1 class="m-0">{{ $title ?? 'View Brand' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.brand.index') }}">Manage Brands</a></li>
                        <li class="breadcrumb-item active">{{ $title ?? 'View Brand' }}</li>
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
                                    <h3 class="card-title">Brand Details</h3>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <a href="{{ route('admin.brand.index') }}" class="btn btn-primary btn-gradient btn-sm">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table">
                            <tr>
                                <td style="width:10%;">Brand Name :</td>
                                <td>{{ $row->name }}</td>
                            </tr>
                            
                            <tr>
                                <td>Status :</td>
                                <td>
                                    @if ($row->status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
