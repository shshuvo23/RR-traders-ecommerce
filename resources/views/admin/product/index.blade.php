@extends('admin.layouts.master')

@section('product', 'active')
@section('title') {{ $title ?? '' }} @endsection

@push('style')
<style>
    .custom-btn .form-control {
    height: calc(31px + 2px) !important;
}

.custom-btn .form-control {
    height: auto;
    padding-top: 4px;}

.custom-btn .syle-btn{
    padding: 2px 15px !important;
}
</style> 
@endpush

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $data['title'] ?? '' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $data['title'] ?? '' }}</li>
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
                        <div class="card-header custom-btn">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div>
                                        
                                    </div>
                                    <form class="d-flex w-100 justify-content-between align-items-center" method="GET">
                                        <div class="row w-100">
                                            <div class="col-auto d-flex align-items-center">
                                                <h3 class="card-title">Manage Products</h3>
                                            </div>
                                    
                                            <!-- Category Filter (Dynamic) -->
                                            <div class="col-auto">
                                                <select data-placeholder="Select Category" name="category" class="form-control" id="category_filter">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                    
                                                    @endforeach
                                                </select>
                                            </div>
                                    
                                            <!-- Brand Filter (Dynamic) -->
                                            <div class="col-auto">
                                                <select data-placeholder="Select Brand" name="brand" class="form-control" id="brand_filter">
                                                    <option value="">Select Brand</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}" {{ (request('brand') == $brand->id) ? 'selected' : '' }}>
                                                            {{ $brand->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    
                                            <!-- Filter and Reset Buttons -->
                                            <div class="col-auto d-flex align-items-center">
                                                <button class="btn btn-info mr-2 syle-btn">Filter</button>
                                                <a href="{{ route('admin.product.index') }}" class="btn btn-danger syle-btn">Reset</a>
                                            </div>
                                            
                                        </div>
                                    </form>
                                    
                                    
                                    
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        {{-- @if (Auth::user()->can('admin.product.create')) --}}
                                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-sm">Add New</a>
                                        {{-- @endif --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table id="dataTables" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">SL</th>
                                        <th style="width: 10%;">Thumbnail</th>
                                        <th style="width: 20%;">Title</th>
                                        <th style="width: 20%;">Category</th>
                                        <th style="width: 20%;">Brand</th>
                                        <th style="width: 15%;">Price</th>
                                        <th style="width: 10%;">Stock</th>
                                        <th style="width: 15%;">Discount</th>
                                        <th style="width: 10%;">Trending</th>
                                        <th style="width: 10%;">New Arrivals</th>
                                        <th style="width: 10%;">Status</th>
                                        <th style="width: 10%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset($product->thumbnail) }}" alt="Product Thumbnail" class="img-thumbnail" height="50">
                                        </td>
                                        <td>{{Str::limit($product->title, 100) }}</td>
                                        <td>{{ $product->category->name ?? '' }}</td>
                                        <td>{{ $product->brand->name ?? ''}}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->discount ?? 'N/A' }}</td>
                                        <td>
                                            @if ($product->is_trending == '1')
                                            <span class="text-success">Yes</span>
                                            @else
                                            <span class="text-danger">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($product->new_arraivals == '1')
                                            <span class="text-success">Yes</span>
                                            @else
                                            <span class="text-danger">No</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($product->status == '1')
                                             <span class="text-success">Active</span>
                                            @else
                                             <span class="text-danger">No</span>
                                            @endif
                                        </td>
                                        <td>

                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                                  Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('admin.product.edit', $product->id) }}">
                                                            <i class="fas fa-edit me-2"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('admin.product.show', $product->id) }}">
                                                            <i class="fas fa-eye me-2"></i> View
                                                        </a>
                                                    </li>
                                                    {{-- <li>
                                                        <a class="dropdown-item" href="{{ route('admin.product.gallery', $product->id) }}">
                                                            Gallery
                                                        </a>
                                                    </li> --}}
                                                    <li>
                                                        <a href="{{route('admin.product.delete', $product->id)}}" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this product?');">
                                                            <i class="fas fa-trash me-2"></i> Delete
                                                        </a>
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
