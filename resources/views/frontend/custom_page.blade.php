@extends('frontend.layouts.app')

@section('title')
{{ $title ?? 'Venmeo.de' }}
@endsection

@section('meta')
    <meta property="og:title" content="{{$row->meta_title ?? $og_title}}" />
    <meta property="og:description" content="{{$row->meta_description ?? $og_description}}" />
    <meta property="og:image" content="{{asset($og_image)}}" />
    <meta name="description" content="{{$row->meta_description ?? $og_description}}">
    <meta name="keywords" content="{{$row->meta_keywords ?? $meta_keywords}}">
@endsection

@push('style')
@endpush
@php
    $localLanguage = session()->get('languageName') ?? geDefaultLanguage()->iso_code;
@endphp
@section('content')
    <!-- ======================= breadcrumb start  ============================ -->
    @section('breadcrumb')
        <li class="breadcrumb-item">{{$row->title}}</li>
    @endsection
    <!-- ======================= breadcrumb end  ============================ -->

    <!-- ======================= content start  ============================ -->
    @if ($row && $row->is_active == 1)

    <div class="page-content pt-4 pb-0">
        <div class="section_gap">
            <div class="container">
                {!! nl2br($row->body) !!}
            </div>
        </div>
    </div>
    @else
        <p class="text-center"><strong>No Data Found</strong></p>
    @endif
    {{-- <div class="custom-section pt-5 pb-5">
        <div class="container">
            <div class="custom-page" style="min-height: 42vh;">
                @if($localLanguage == 'en')

                {!! $row->body !!}
                @else
                {!! $row->body_de !!}

                @endif
            </div>
        </div>
    </div> --}}
    <!-- ======================= content end  ============================ -->
@endsection

@push('script')
@endpush
