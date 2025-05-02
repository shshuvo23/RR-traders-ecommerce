@extends('admin.layouts.master')
@section('product', 'active')
@section('title') {{ $title ?? 'Create Product' }} @endsection

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
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Create Product</li>
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
                                        <h3 class="card-title">Create Product</h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">
                                            <a href="{{ route('admin.product.index') }}" class="btn btn-primary btn-gradient btn-sm">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-4">
                                <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="title" class="form-label">Product Title <span class="text-danger">*</span></label>
                                                <input type="text" name="title" id="title" placeholder="Product Title" value="{{old('title')}}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label">Category <span class="text-danger">*</span></label>
                                                <select name="category_id" class="form-control">
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{old('category_id') == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label">Brand <span class="text-danger">*</span></label>
                                                <select name="brand_id" class="form-control">
                                                    <option value="">Select Brand</option>
                                                    @foreach($brands as $brand)
                                                        <option value="{{ $brand->id }}" {{old('brand_id') == $brand->id ? 'selected' : ''}}>{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="price" class="form-label">Price($) <span class="text-danger">*</span></label>
                                                <input type="number" name="price" id="price" value="{{old('price')}}" placeholder="Price" class="form-control" step=".1" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="discount" class="form-label">Discount(percent)</label>
                                                <input type="number" name="discount" id="discount" value="{{old('discount')}}" placeholder="discount" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="stock" class="form-label">Stock <span class="text-danger">*</span></label>
                                                <input type="number" name="stock" id="stock" value="{{old('stock')}}" placeholder="Stock" class="form-control" required>
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label">Trending Product</label>
                                                <select name="is_trending" class="form-control">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label">New Arrival</label>
                                                <select name="new_arraivals" class="form-control">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="short_description" class="form-label">Short Description <span class="text-danger">*</span></label>
                                                <textarea name="short_description" id="short_description" placeholder="Short Description" class="form-control" rows="3" required>{{old('short_description')}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea name="description" id="description" placeholder="Product description" class="form-control">{{old('description')}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="aditional_info" class="form-label">Additional Info</label>
                                                <textarea name="aditional_info" id="aditional_info" placeholder="Additional Info" class="form-control">{{old('aditional_info')}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="thumbnail" class="form-label">Thumbnail Image <span class="text-info">(Preferred size 250 x 250 px)</span> <span class="text-danger">*</span></label>
                                                <input type="file" name="thumbnail" id="thumbnail" class="form-control" required>
                                            </div>
                                        </div>




                                        {{-- <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="demo-upload" class="form-label">Additional Images (Optional)</label>
                                                <div class="dropzone" id="demo-upload"></div>
                                            </div>
                                        </div> --}}




                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <h4>
                                                    Add up to 5 photos <span style="color: green;">
                                                        <small class="fw-normal">( Preferred image size 250x250px ) 2MB</small>
                                                    </span>
                                                    <i class="fa fa-question-circle" data-bs-toggle="tooltip"
                                                       data-bs-placement="top"
                                                       data-bs-custom-class="custom-tooltip"
                                                       data-bs-title="Ads with real photos get 10 times more views than with catalogue images. Images must be JPG or PNG format (max 2MB).Preferred image size 830x520px. Do not upload images with watermarks."></i>
                                                </h4>
                                                <div class="imageUploader"></div>
                                                <p>You must upload at least one photo</p>
                                                @error('images')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="features" class="form-label">Product Features</label>
                                        <div class="row" id="features-container">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" name="features[]" placeholder="Feature" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-primary mb-3" id="add-feature-btn">Add Feature</button>
                                    </div>

                                    <div class="col-lg-12 p-0">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Add Product</button>
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

@push('script')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script> --}}
<script src="{{asset('assets/js/image-uploader.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
   $(document).ready(function () {
        $('.imageUploader').imageUploader({
            maxFiles: 5,
            mimes: ['image/jpeg', 'image/png'],
        });
    })


    $(document).ready(function() {
        $('#description, #aditional_info').summernote({
            height: 400,  // Set editor height
        });
    });

    $(document).ready(function() {
        // Add new feature input field
        $('#add-feature-btn').click(function() {
            var currentFeatureCount = $('#features-container .col-lg-3').length;
            console.log('Current feature count:', currentFeatureCount);

            if (currentFeatureCount < 5) {
                var newFeatureInput = $(`
                    <div class="col-lg-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="features[]" placeholder="Feature" class="form-control">
                                <button type="button" class="remove-feature-btn btn btn-danger input-group-text">Remove</button>
                            </div>
                        </div>
                    </div>
                `);
                $('#features-container').append(newFeatureInput);
            } else {
                alert("You cannot add more than 5 features.");
            }

            if ($('#features-container .col-lg-3').length > 5) {
                $('#add-feature-btn').attr('disabled', true);
            }
        });

        // Remove feature input field
        $(document).on('click', '.remove-feature-btn', function() {
            $(this).closest('.col-lg-3').remove();

            if ($('#features-container .col-lg-3').length < 5) {
                $('#add-feature-btn').attr('disabled', false);
            }
        });
    });

</script>
@endpush
