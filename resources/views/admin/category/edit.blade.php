@extends('admin.layouts.master')
@section('category', 'active')
@section('title') {{ $title ?? 'Edit Category' }} @endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Category</a></li>
                            <li class="breadcrumb-item active">Edit Category</li>
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
                                        <h3 class="card-title">Edit Category</h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">
                                            <a href="{{ route('admin.category.index') }}" class="btn btn-primary btn-gradient btn-sm">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-4">
                                <form action="{{ route('admin.category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if($category->category_image)
                                                <img src="{{ asset($category->category_image) }}" alt="Category Image" width="100" height="100">
                                            @endif
                                            <div class="form-group">
                                                <label for="category_image" class="form-label">Category Image <span class="text-danger">*</span></label>
                                                <input type="file" name="category_image" id="category_image" class="form-control">
                                                <small id="image_size_info" class="form-text text-muted">Recommended size will appear here.</small>

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                                                <input type="text" name="name" id="name" placeholder="Category Name" class="form-control" value="{{ old('name', $category->name) }}" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="is_home" class="form-label">Is Home</label>
                                                <select name="is_home" id="is_home" class="form-control" onchange="showRecommendedSize()">
                                                    <option value="0" {{ $category->is_home == 0 ? 'selected' : '' }}>No</option>
                                                    <option value="1" {{ $category->is_home == 1 ? 'selected' : '' }}>Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="is_highlighted" class="form-label">Is Highlighted</label>
                                                <select name="is_highlighted" id="is_highlighted" class="form-control" onchange="showRecommendedSize()">
                                                    <option value="0" {{ $category->is_highlighted == 0 ? 'selected' : '' }}>No</option>
                                                    <option value="1" {{ $category->is_highlighted == 1 ? 'selected' : '' }}>Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="status" class="form-label">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="orderby" class="form-label">Order Number</label>
                                                <input type="number" name="orderby" id="orderby" class="form-control" placeholder="Order Number" value="{{ old('orderby', $category->orderby) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success">Update Category</button>
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

@push('script')
<script>
    function showRecommendedSize() {
        let isHome = document.getElementById('is_home').value;
        let isHighlighted = document.getElementById('is_highlighted').value;
        let imageSizeInfo = document.getElementById('image_size_info');

        if (isHome == '1') {
            imageSizeInfo.innerHTML = "Recommended size: 54 × 86 px";
        } else if (isHighlighted == '1') {
            imageSizeInfo.innerHTML = "Recommended size: 398 × 203 px";
        } else {
            imageSizeInfo.innerHTML = "Recommended size: (No specific size)";
        }
    }

    // Initialize recommended size on page load
    window.onload = function() {
        showRecommendedSize();
    };
</script>
@endpush
