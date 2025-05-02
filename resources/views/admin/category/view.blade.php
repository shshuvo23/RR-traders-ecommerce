@extends('admin.layouts.master')
@section('category', 'active')
@section('title') {{ $title ?? 'View Category' }} @endsection



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
                    <h1 class="m-0">{{ $title ?? 'View Category' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Manage Categories</a></li>
                        <li class="breadcrumb-item active">{{ $title ?? 'View Category' }}</li>
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
                                    <h3 class="card-title">Category Details</h3>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <a href="{{ route('admin.category.index') }}" class="btn btn-primary btn-gradient btn-sm">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table">
                            <tr>
                                <td style="width:10%;">Category Name :</td>
                                <td>{{ $row->name }}</td>
                            </tr>
                            <tr>
                                <td>Category Image :</td>
                                <td>
                                    @if ($row->category_image)
                                        <img src="{{ asset($row->category_image) }}" alt="Category Image" style="width: 100px; height: auto;">
                                    @else
                                        <span>No Image Available</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Order Number :</td>
                                <td>{{ $row->orderby }}</td>
                            </tr>
                            <tr>
                                <td>Published Status :</td>
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
