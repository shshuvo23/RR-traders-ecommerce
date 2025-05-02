@extends('admin.layouts.master')
@section('product', 'active')
@section('title') Product Gallery @endsection

@push('style')
<style>
    .gallery-image {
        width: 100px;
        height: auto;
        margin-right: 10px;
    }
</style>
@endpush

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product Gallery</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Manage Products</a></li>
                        <li class="breadcrumb-item active">Product Gallery</li>
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
                                    <h3 class="card-title">Gallery Images</h3>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <a href="{{ route('admin.product.index') }}" class="btn btn-primary btn-gradient btn-sm">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ asset('images/gallery1.jpg') }}" alt="Gallery Image 1" class="gallery-image">
                                </div>
                                <div class="col-md-3">
                                    <img src="{{ asset('images/gallery2.jpg') }}" alt="Gallery Image 2" class="gallery-image">
                                </div>
                                <div class="col-md-3">
                                    <img src="{{ asset('images/gallery3.jpg') }}" alt="Gallery Image 3" class="gallery-image">
                                </div>
                                <div class="col-md-3">
                                    <img src="{{ asset('images/gallery4.jpg') }}" alt="Gallery Image 4" class="gallery-image">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
