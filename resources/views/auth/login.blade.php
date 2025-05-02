@extends('frontend.layouts.app')

@section('title')
{{ $data['title'] ?? __('auth.sign_in') }}
@endsection

@php
    $setting = getSetting();
@endphp

@section('meta')
    <meta property="og:title" content="Sign In | Venmeo.de" />
    <meta property="og:description" content="{{$setting->seo_meta_description}}" />
    <meta property="og:image" content="{{ asset($setting->site_logo) }}" />
    <meta name="description" content="{{$setting->seo_meta_description}}">
    <meta name="keywords" content="{{$setting->seo_keywords}}">
@endsection

@push('style')
@endpush

@section('content')
    <!-- ======================= breadcrumb start  ============================ -->
    @section('breadcrumb')
        <li class="breadcrumb-item">{{__('auth.sign_in')}}</li>
    @endsection
    <!-- ======================= breadcrumb end  ============================ -->

    <!-- ======================= login start  ============================ -->
    <div class="page-content pt-0 pb-0">
        <div class="login-page pt-4 pb-7">
            <div class="container-fluid">
                <div class="form-box">
                    <div class="form-tab">
                        <div class="text-center">
                            <h4 class="section_heading mb-4">Login</h4>
                        </div>
                        <div class="tab-content">
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="email" class="form-label mb-0"><strong>Email <span class="text-danger">*</span></strong></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required="">
                                </div>
                                <div class="form-group">
                                    <label for="password" class=" mb-0"><strong>Password <span class="text-danger">*</span></strong></label>
                                    {{-- <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required=""> --}}
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                                        <div class="input-group-append m-0">
                                            <span class="input-group-text toggle-password border-0 px-4">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="remember">
                                        <label class="custom-control-label" for="remember">Remember Me</label>
                                    </div>
                                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot Your Password?</a>
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary rounded mr-0 py-4 w-100">
                                        <span>LOG IN</span>
                                    </button>
                                </div>
                            </form>

                            {{-- <div class="form-choice">
                                <p class="text-center">or sign in with</p>
                                <div class="row">
                                    <a href="#" class="btn btn-login btn-g w-100 py-4">
                                        <i class="icon-google"></i>
                                        Login With Google
                                    </a>
                                </div>
                            </div> --}}

                            <p class="text-center mt-2 text-sm">
                                <a href="{{ route('register') }}">Don't have an account? Register</a>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="login-section pt-5 pb-5" style="min-height: 82vh;">
        <div class="container mt-5">
            <div class="card login_form p-2 p-lg-4">
                <div class="card-body">
                    <h2 class="h2 text-center mb-5">{{__('auth.login.login_your_account')}}</h2>
                    <form method="POST" action="{{ route('login') }}" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">{{__('auth.registration.email_address')}} <span class="text-danger">*</span></label>
                            <input type="email" name="email" autofocus class="form-control" placeholder="john@gmail.com" autocomplete="off" required value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block w-100">
                                {{__('auth.registration.password')}} <span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password" id="password-field" class="form-control"
                                    placeholder="{{__('auth.registration.your_password')}}" autocomplete="off" required>
                                <span class="input-group-text p-0">
                                    <a href="javascript:void(0)" class="link-secondary fa fa-fw fa-eye field-icon toggle-password"
                                        toggle="#password-field">
                                    </a>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="remember">
                                <span class="form-check-label">{{__('auth.login.remember_me')}}</span>
                            </label>
                        </div>
                        <div class="form-footer mt-4 text-center">
                            <button type="submit" class="btn btn-primary w-100">{{__('auth.sign_in')}}</button>
                            <span class="form-label-description mt-3 d-block">
                                <a href="{{ route('password.request') }}">{{__('auth.login.forget_password')}}?</a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-4 send_back">
                <p class="m-0">{{__('auth.login.dont_have_account')}}? <a href="{{ route('register') }}">{{__('auth.sign_up')}}</a></p>
            </div>
        </div>
    </div> --}}
    <!-- ======================= login end  ============================ -->
@endsection

@push('script')
<script>
    $(document).ready(function(){
    $(".toggle-password").click(function(){
        let input = $("#password");
        let icon = $(this).find("i");

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
