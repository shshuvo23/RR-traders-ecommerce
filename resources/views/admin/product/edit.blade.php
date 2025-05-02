@extends('admin.layouts.master')
@section('product', 'active')
@section('title') {{ $data['title'] ?? 'Edit Product' }} @endsection
@push('style')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"> --}}
<link rel="stylesheet" href="{{asset('assets/css/image-uploader.min.css ')}}">

<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
    .dropzone {
        background: white;
        border-radius: 5px;
        border: 2px dashed rgb(0, 135, 247);
        /* max-width: 500px; */
        margin-left: auto;
        margin-right: auto;
        position: relative;
    }

    .dz-message {
        text-align: center;
    }

    .fa-upload {
        font-size: 50px;
        color: rgb(0, 135, 247);
    }
</style>

@php

    $preloadedImages = [];
    foreach ($product->images as $gallery) {
        $preloadedImages[] = [
            'id'   => $gallery->id,
            'src'  => asset($gallery->image)
        ];
    }
@endphp
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
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
                                        <h3 class="card-title">Edit Product</h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">
                                            <a href="{{ route('admin.product.index') }}" class="btn btn-primary btn-gradient btn-sm">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-4">

                                <form action="{{route('admin.product.update', $product->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="title" class="form-label">Product Title <span class="text-danger">*</span></label>
                                                <input type="text" name="title" id="title" placeholder="Product Title" value="{{ old('title', $product->title) }}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label">Category <span class="text-danger">*</span></label>
                                                <select name="category_id" class="form-control" required>
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label">Brand <span class="text-danger">*</span></label>
                                                <select name="brand_id" class="form-control" required>
                                                    <option value="">Select Brand</option>
                                                    @foreach($brands as $brand)
                                                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                                            {{ $brand->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="price" class="form-label">Price($) <span class="text-danger">*</span></label>
                                                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" placeholder="Price" class="form-control" step=".1" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="discount" class="form-label">Discount(percent)</label>
                                                <input type="number" name="discount" id="discount" value="{{ old('discount', $product->discount) }}" placeholder="Discount" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="stock" class="form-label">Stock <span class="text-danger">*</span></label>
                                                <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" placeholder="Stock" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label">Trending Product</label>
                                                <select name="is_trending" class="form-control">
                                                    <option value="1" {{ old('is_trending', $product->is_trending) == 1 ? 'selected' : '' }}>Yes</option>
                                                    <option value="0" {{ old('is_trending', $product->is_trending) == 0 ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label">New Arrival</label>
                                                <select name="new_arraivals" class="form-control">
                                                    <option value="1" {{ old('new_arraivals', $product->new_arraivals) == 1 ? 'selected' : '' }}>Yes</option>
                                                    <option value="0" {{ old('new_arraivals', $product->new_arraivals) == 0 ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="short_description" class="form-label">Short Description <span class="text-danger">*</span></label>
                                                <textarea name="short_description" id="short_description" placeholder="Short Description" class="form-control" rows="3" required>{{ old('short_description', $product->short_description) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea name="description" id="description" placeholder="Product description" class="form-control description">{{ old('description', $product->description) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="aditional_info" class="form-label">Additional Info</label>
                                                <textarea name="aditional_info" id="aditional_info" placeholder="Additional Info" class="form-control aditional_info">{{ old('aditional_info', $product->aditional_info) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="thumbnail" class="form-label">Thumbnail Image <span class="text-info">(Preferred size 250 x 250 px)</span> <span class="text-danger">*</span></label>
                                                <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                                                @if($product->thumbnail)
                                                    <img src="{{ asset($product->thumbnail) }}" alt="Product Thumbnail" width="100" height="100">
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Add other images section --}}
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <h4>
                                                    Add up to 5 pictures
                                                    <i class="fa fa-question-circle" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                        data-bs-title="Ads with real photos get 10 times more views than with catalogue images. Images must be JPG or PNG format (max 2MB). Do not upload images with watermarks."></i>
                                                </h4>
                                                <p class="text-primary">You must upload at least one photo <span>(Recommended Size : 250x250px)</span></p>
                                                <div class="imageUploader"></div>
                                                <input type="hidden" name="deleted_images" id="deletedImages">
                                            </div>
                                        </div>

                                        {{-- @dd($product->feature) --}}
                                        <div class="col-lg-12">
                                            <label for="features" class="form-label">Product Features</label>
                                            <div class="row" id="features-container">
                                                @forelse($product->feature as $feature)
                                                    <div class="col-lg-3 feature-input">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input type="text" name="features[]" value="{{ old('features[]', $feature->feature) }}" placeholder="Feature" class="form-control">
                                                                <button type="button" class="btn btn-danger remove-feature-btn">Remove</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <!-- Default input field if no features exist in the database -->
                                                    <div class="col-lg-3 feature-input">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input type="text" name="features[]" placeholder="Feature" class="form-control">
                                                                {{-- <button type="button" class="btn btn-danger remove-feature-btn" style="visibility: hidden;">Remove</button> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforelse
                                            </div>

                                            <button type="button" class="btn btn-primary mb-3" id="add-feature-btn">Add Feature</button>
                                        </div>

                                        <div class="col-lg-12 p-0">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success">Update Product</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                                {{-- <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="title" class="form-label">Product Title</label>
                                                <input type="text" name="title" id="title" value="{{ $row->title }}" placeholder="Product Title" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="price" class="form-label">Price</label>
                                                <input type="number" name="price" id="price" value="{{ $row->price }}" placeholder="Price" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="stock" class="form-label">Stock</label>
                                                <input type="number" value="{{ $row->stock }}"  name="stock" id="stock" placeholder="Stock" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="status" class="form-label">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="short_description" class="form-label">Short Description</label>
                                                <textarea name="short_description" id="short_description" placeholder="Short Description" class="form-control" rows="3" required>{{ $row->short_description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="return_info" class="form-label">Return Info</label>
                                                <textarea name="return_info" value="{{ $row->return_info }}" id="return_info" placeholder="Return Info" class="form-control" required></textarea>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="product_info" class="form-label">Product Info</label>
                                                <textarea name="product_info" id="product_info" value="{{ $row->product_info }}" placeholder="Product Info" class="form-control" required>{{ $row->product_info }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="additional_info" class="form-label">Additional Info</label>
                                                <textarea name="additional_info" value="{{ $row->additional_info }}"  id="additional_info" placeholder="Additional Info" class="form-control" required>{{ $row->additional_info }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="size" class="form-label">Size</label>
                                                <input type="text" name="size" id="size" placeholder="Size" class="form-control" required>
                                            </div>
                                        </div>



                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="thumbnail" class="form-label">Thumbnail Image</label>
                                                <input type="file" name="thumbnail" id="thumbnail" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="demo-upload" class="form-label">Product Image</label>
                                                <!-- Remove the traditional file input and use the dropzone container -->
                                                <div class="dropzone" id="demo-upload"></div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success">Edit Product</button>
                                            </div>
                                        </div>
                                    </div>
                                </form> --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script> --}}
<script src="{{asset('assets/js/image-uploader.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    // Image uploader
    let preloaded = @json($preloadedImages);

    $('.imageUploader').imageUploader({
        preloaded: preloaded,
        imagesInputName: 'images',
        preloadedInputName: 'old',
        maxSize: 2 * 1024 * 1024,
        maxFiles: 5,
        onAddImage: function (image) {
            var currentUploaded = $('.uploaded-image').length + preloadedCount;
            if (currentUploaded >= 5) {
                alert("You cannot upload more than " + '5' + " images.");
                $('.imageUploader input[type="file"]').val(''); // Clear file input
                return false;
            }
        },
        onRemoveImage: function (image) {
            let deletedImages = $('#deletedImages').val() ? JSON.parse($('#deletedImages').val()) : [];
            deletedImages.push(image.id);
            $('#deletedImages').val(JSON.stringify(deletedImages));
        }
    });


    $(document).ready(function() {
        $('.description, .aditional_info').summernote({
            height: 400,  // Set editor height
        });
    });

    $(document).ready(function () {
        // Check if the current number of features is less than 5
        function checkFeatureLimit() {
            const featureCount = $('#features-container .feature-input').length;
            return featureCount < 5;
        }

        // Add new feature input
        $('#add-feature-btn').on('click', function () {
            // Check if the current number of features is less than 5
            if (checkFeatureLimit()) {
                const featureInputHTML = `
                    <div class="col-lg-3 feature-input">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="features[]" placeholder="Feature" class="form-control" >
                                <button type="button" class="btn btn-danger remove-feature-btn">Remove</button>
                            </div>
                        </div>
                    </div>`;

                $('#features-container').append(featureInputHTML);
            } else {
                alert('You can only add up to 5 features.');
            }
        });

        // Remove feature input
        $(document).on('click', '.remove-feature-btn', function () {
            $(this).closest('.feature-input').remove();
        });
    });

</script>
@endpush
