@extends('frontend.layouts.app')

@section('title')
    {{ $title ?? '' }}
@endsection

@section('meta')
    {{-- <meta property="og:title" content="{{ $seo->title ?? $og_title }}" />
    <meta property="og:description" content="{{ $seo->description ?? $og_description }}" />
    <meta property="og:image" content="{{ asset($seo->image ?? $og_image) }}" />
    <meta name="description" content="{{$seo->meta_description ?? $og_description}}">
    <meta name="keywords" content="{{$seo->keywords ?? $meta_keywords}}"> --}}
@endsection
@push('style')
<style>
    span.input-group-text.toggle-password {
        height: 47px;
    }
</style>
@endpush
{{-- @php
    $localLanguage = Session::get('languageName');
@endphp --}}
@section('content')
    <!-- ======================= breadcrumb start  ============================ -->
@section('breadcrumb')
    <li class="breadcrumb-item"> {{ $title }}</li>
@endsection
<!-- ======================= breadcrumb end  ============================ -->

<div class="page-header text-center">
    <div class="container">
        <h1 class="page-title">{{ $title }}</h1>
    </div><!-- End .container -->
</div>
<div class="page-content mt-3">
    <div class="dashboard">
        <div class="container">
            <div class="row">
                <aside class="col-md-4 col-lg-3">
                    @include('user.sidebar')

                </aside>

                <div class="col-md-8 col-lg-9">
                    <div class="">
                        <div class="card p-3 border-0">
                            <div class="card-header ml-3">
                                <h3 class="card-title"> Update Profile</h3>
                            </div>
                            <div class="card-body">
                                <div class="" >
                                    <form action="{{route('user.profile.update')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-12">
                                                {{-- <label>Current Profile Image</label> --}}
                                                <div class="image-preview">
                                                    <img id="preview" src="{{ getPhoto($user->image) }}"
                                                         alt="Profile Image" class="img-thumbnail" style="max-width: 150px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Profile Image</label>
                                                <input type="file" name="image" id="profile_image" class="form-control" accept="image/*">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Name *</label>
                                                <input type="text" name="name" value="{{ $user->name ?? '' }}"
                                                    class="form-control" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Email *</label>
                                                <input type="email" class="form-control" name="email" value="{{ $user->email ?? '' }}"
                                                    required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Phone Number *</label>
                                                <input type="number" class="form-control" name="phone" value="{{ $user->phone ?? '' }}"
                                                    required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Address *</label>
                                                <input type="text" class="form-control" name="address" value="{{ $user->address ?? '' }}">
                                            </div>
                                        </div>


                                        <button type="submit" class="btn btn-outline-primary-2 btn-sm mt-1">
                                            <span>Update</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card p-3 border-0">
                            <div class="card-header ml-3">
                                <h3 class="card-title">Change Password</h3>
                            </div>
                            <div class="card-body">
                                <div class="" >
                                    <form action="{{route('user.password.update')}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Password *</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="newpassword" id="newpassword" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text toggle-password px-4 border-0" toggle="#newpassword">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Confirm Password *</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text toggle-password px-4 border-0" toggle="#confirm_password">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-outline-primary-2 btn-sm mt-1">
                                            <span>Update</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                    </form>
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


@push('script')
<script>
    $(document).ready(function() {
    $(".toggle-password").click(function() {
        var input = $($(this).attr("toggle"));
        var icon = $(this).find("i");

        if (input.attr("type") === "password") {
            input.attr("type", "text");
            icon.removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            input.attr("type", "password");
            icon.removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
});

</script>
@endpush
