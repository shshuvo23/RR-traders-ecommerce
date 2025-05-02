@extends('frontend.layouts.app')

@section('title')
    {{ $title ?? '' }}
@endsection

@section('meta')
    <meta property="og:title" content="{{ $row->meta_title ?? $og_title }}" />
    <meta property="og:description" content="{{ $row->meta_description ?? $og_description }}" />
    <meta property="og:image" content="{{ asset($og_image) }}" />
    <meta name="description" content="{{ $row->meta_description ?? $og_description }}">
    <meta name="keywords" content="{{ $row->meta_keywords ?? $meta_keywords }}">
@endsection

@push('style')
@endpush
@php
    $localLanguage = session()->get('languageName') ?? geDefaultLanguage()->iso_code;
@endphp
@section('content')
    <!-- ======================= breadcrumb start  ============================ -->
@section('breadcrumb')
    <li class="breadcrumb-item">{{ $title }}</li>
@endsection
<!-- ======================= breadcrumb end  ============================ -->

<!-- ======================= about start  ============================ -->
<div class="section_gap">
    <div class="container">
        <div class="row justify-content-center">
            {{-- <div class="col-lg-12 mb-3 mb-lg-0">
                    <h2 class="title">{{ $row->title }}</h2>
                    <p>{!! nl2br($row->body) !!} </p>
                </div> --}}
            @if ($row && $row->is_active == 1)
                <div class="col-lg-12 mb-3 mb-lg-0">
                    <h2 class="title">{{ $row->title }}</h2>
                    <p>{!! nl2br($row->body) !!}</p>
                </div>
            @else
                <p class="text-center">No Data Available</p>
            @endif


        </div>
    </div>
</div>
{{-- <div class="bg-light-2 pt-5 pb-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <h2 class="title">Who We Are</h2>
                    <p class="lead text-primary">Pellentesque odio nisi, euismod pharetra a ultricies <br>in diam. Sed arcu. Cras consequat</p>
                    <p class="mb-2">Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Suspendisse potenti. Sed egestas, ante et vulputate volutpat, uctus metus libero eu augue. </p>
                </div>

            </div>
        </div>
    </div> --}}
<div class="about-testimonials section_gap">
    <div class="container">
        <h2 class="title text-center section_heading">What Customer Say About Us</h2>
        <div class="owl-carousel owl-simple owl-testimonials-photo owl-loaded owl-drag" data-toggle="owl">
            <div class="owl-stage-outer">
                <div class="owl-stage">
                    @foreach ($testimonial as $item)
                        <div class="owl-item">
                            <blockquote class="testimonial text-center">
                                <img src="{{ asset($item->image) }}" alt="{{ $item->name }}">
                                <p>“ {{ $item->details }} ”</p>
                                <cite>
                                    {{ $item->name }}
                                    <span>{{ $item->designation }}</span>
                                </cite>
                            </blockquote>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ======================= about end  ============================ -->
@endsection

@push('script')
@endpush
