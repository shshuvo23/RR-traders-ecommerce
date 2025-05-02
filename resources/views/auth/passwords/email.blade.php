
@extends('frontend.layouts.app')

@section('title')
{{ $data['title'] ?? __('auth.forget_pass') }}
@endsection

@php
    $setting = getSetting();
@endphp

@section('meta')
    <meta property="og:title" content="Forgot Password | Venmeo.de" />
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
        <li class="breadcrumb-item">{{__('auth.forget_pass')}}</li>
    @endsection
    <!-- ======================= breadcrumb end  ============================ -->

    <!-- ======================= Forgot password start  ============================ -->

    <div class="page-content pt-0 pb-0">
        <div class="login-page pt-4 pb-7">
            <div class="container-fluid">
                <div class="form-box">
                    <div class="form-tab">
                        <div class="text-center">
                            <h4 class="section_heading mb-4">Forgot Password</h4>
                        </div>
                        <div class="tab-content">
                            <form action="{{ route('password.email') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="email" class="form-label"><strong>Email <span class="text-danger">*</span></strong></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required="">
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary rounded mr-0 py-4 w-100">
                                        <span>Forgot Password</span>
                                    </button>
                                </div>
                            </form>

                            <p class="text-center text-sm">
                                <a href="{{route('login')}}">Back to Login Page</a>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="login-section pt-8 pb-8" style="min-height: 82vh;">
        <div class="container">
            <div class="card login_form p-2 p-lg-4 shadow-sm">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">{{__('auth.forget_pass')}}?</h2>
                    <p class="mb-4">{{__('auth.forgot_password.reset_and_email')}}.</p>
                    <form method="POST" action="{{ route('password.email') }}" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">{{__('auth.registration.email_address')}} <span class="text-danger">*</span></label>
                            <input type="email" name="email" autofocus class="form-control" placeholder="{{__('auth.registration.your_mail')}}"
                                autocomplete="off" required>
                        </div>
                        <div class="form-footer mt-4">
                            <button type="submit" class="btn btn-primary w-100">{{__('auth.send')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class=" text-center mt-4 send_back">
                <p class="m-0">{{__('auth.forgot_password.send_me_back')}} <a href="{{route('login')}}">{{__('auth.sign_in')}}</a> {{__('auth.forgot_password.screen')}}.</p>
            </div>
        </div>
    </div> --}}
    <!-- ======================= Forgot password end  ============================ -->
@endsection

@push('script')
@endpush
