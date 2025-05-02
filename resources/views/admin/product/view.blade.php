@extends('admin.layouts.master')
@section('product', 'active')
@section('title') View Product @endsection

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
                        <h1 class="m-0">View Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Manage Products</a></li>
                            <li class="breadcrumb-item active">View Product</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="">
                    <div class="row d-flex justify-content-center">
                        <!-- Product Information Section -->
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3>{{ $product->title }}</h3>
                                    <small class="text-muted">Category: {{ $product->category->name }} | Brand:
                                        {{ $product->brand->name }}</small>
                                </div>
                                <div class="card-body">
                                    <!-- Product Image Carousel -->

                                    <div>
                                        <div class="row">
                                            <div class="col-3">
                                                <img src="{{asset($product->thumbnail)}}" alt="" height="200">
                                            </div>
                                            @foreach ($product->images as $image)
                                                <div class="col-3">
                                                    <div class="product-image">
                                                        <img src="{{ asset($image->image) }}" class="" alt="{{ $product->title }}" height="200">
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>

                                    <!-- Product Details -->
                                    <h4 class="mt-4">Price: ${{ number_format($product->price, 2) }}</h4>
                                    @if ($product->discount)
                                        <p><strong>Discount:</strong> {{ $product->discount }}%</p>
                                    @endif
                                    <p><strong>Status:</strong> {{ $product->status == 1 ? 'Available' : 'Out of Stock' }} ||
                                        <strong>Trending :</strong> {{$product->is_trending == 1 ? 'Yes' : 'No'}} ||
                                        <strong>New Arraivals :</strong> {{$product->new_arraivals == 1 ? 'Yes' : 'No'}}
                                    </p>
                                    <p><strong>Stock:</strong> {{ $product->stock }}</p>

                                    <h4 class="mt-4">Short Description:</h4>
                                    <p>{{ $product->short_description }}</p>

                                    <h4 class="mt-4">Full Description:</h4>
                                    <p>{!! $product->description ?? 'No full description available.' !!}</p>

                                    <h4 class="mt-4">Additional Information:</h4>
                                    <p>{!! $product->aditional_info ?? 'No additional information available.' !!}</p>

                                    @if($product->feature->isNotEmpty())
                                        <h4 class="mt-4">Product Features:</h4>
                                        <ul>
                                            @foreach($product->feature as $feature)
                                                <li>{{ $feature->feature }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No features available for this product.</p>
                                    @endif

                                    <!-- Edit and Delete Buttons -->
                                    <div class="mt-4">
                                        <a href="{{ route('admin.product.index') }}"
                                            class="btn btn-primary me-2">
                                            <i class="fa-solid fa-arrow-left"></i> Back
                                        </a>
                                        <a href="{{ route('admin.product.edit', $product->id) }}"
                                            class="btn btn-primary me-2">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="{{ route('admin.product.delete', $product->id) }}" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this product?');">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h3 class="card-title">Product Details</h3>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <a href="{{ route('admin.product.index') }}" class="btn btn-primary btn-gradient btn-sm">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table">
                            <tr>
                                <td style="width:10%;">Product Title :</td>
                                <td>Sample Product Title</td>
                            </tr>
                            <tr>
                                <td>Short Description :</td>
                                <td>This is a sample product description.</td>
                            </tr>
                            <tr>
                                <td>Additional Info :</td>
                                <td>This is additional product information.</td>
                            </tr>
                            <tr>
                                <td>Size :</td>
                                <td>M</td>
                            </tr>
                            <tr>
                                <td>Return Info :</td>
                                <td>30-day return policy.</td>
                            </tr>
                            <tr>
                                <td>Price :</td>
                                <td>$99.99</td>
                            </tr>
                            <tr>
                                <td>Thumbnail Image :</td>
                                <td>
                                    <img src="{{ asset('images/sample-thumbnail.jpg') }}" alt="Thumbnail Image" style="width: 100px; height: auto;">
                                </td>
                            </tr>

                            <tr>
                                <td>Stock :</td>
                                <td>150</td>
                            </tr>
                        </table> --}}


            </div>
        </div>
    </div>
@endsection
