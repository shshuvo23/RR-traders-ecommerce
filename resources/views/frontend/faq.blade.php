@extends('frontend.layouts.app')

@section('title')
{{ $title ?? '' }}
@endsection

@section('meta')
    <meta property="og:title" content="{{ $seo->title ?? $og_title }}" />
    <meta property="og:description" content="{{ $seo->description ?? $og_description }}" />
    <meta property="og:image" content="{{ asset($seo->image ?? $og_image) }}" />
    <meta name="description" content="{{$seo->meta_description ?? $og_description}}">
    <meta name="keywords" content="{{$seo->keywords ?? $meta_keywords}}">
@endsection
@push('style')
@endpush
@php
    $localLanguage = Session::get('languageName');
@endphp
@section('content')
    <!-- ======================= breadcrumb start  ============================ -->
    @section('breadcrumb')
        <li class="breadcrumb-item"> {{$title}}</li>
    @endsection
    <!-- ======================= breadcrumb end  ============================ -->
    <!-- ======================= faq start  ============================ -->
    <div class="page-content">
        <div class="container">
            <h2 class="title text-center mb-3">{{ $title }}</h2>

            <div class="accordion accordion-rounded" id="accordion-1">
            @foreach ($faqs as $index => $faq)
                <div class="card card-box card-sm bg-light">
                    <div class="card-header" id="heading-{{ $index + 1 }}">
                        <h2 class="card-title">
                            <a class="{{ $index == 0 ? 'collapsed' : '' }}" role="button" data-toggle="collapse" href="#collapse-{{ $index + 1 }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="collapse-{{ $index + 1 }}">
                                {{ $faq->title }}
                            </a>
                        </h2>
                    </div><!-- End .card-header -->

                    <div id="collapse-{{ $index + 1 }}" class="collapse {{ $index == 0 ? 'show' : '' }}" aria-labelledby="heading-{{ $index + 1 }}" data-parent="#accordion-1">
                        <div class="card-body">
                            {!! nl2br(e($faq->body)) !!}
                        </div><!-- End .card-body -->
                    </div><!-- End .collapse -->
                </div><!-- End .card -->
            @endforeach
        </div>


        </div><!-- End .container -->
    </div>
    <!-- ======================= faq end  ============================ -->
@endsection

@push('script')
@endpush
