@extends('admin.layouts.master')
@section('slider', 'active')
@section('title') {{ $title ?? 'View Slider' }} @endsection

@push('style')
<style>
    td {
        width: 0;
    }
</style>
@endpush

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title ?? 'View Slider' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.slider.index') }}">Manage Sliders</a></li>
                        <li class="breadcrumb-item active">{{ $title ?? 'View Slider' }}</li>
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
                                    <h3 class="card-title">Slider Details</h3>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <a href="{{ route('admin.slider.index') }}" class="btn btn-primary btn-gradient btn-sm">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table">
                            <tr>
                                <td style="width:10%;">Slider Name :</td>
                                <td>{{ $row->name }}</td>
                            </tr>
                            <tr>
                                <td>Slider Image :</td>
                                <td>
                                    @if ($row->image)
                                        <img src="{{ asset($row->image) }}" alt="Slider Image" style="width: 100px; height: auto;">
                                    @else
                                        <span>No Image Available</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Link :</td>
                                <td><a href="{{ $row->link }}" target="_blank">{{ $row->link }}</a></td>
                            </tr>
                            <tr>
                                <td>Sorting Order :</td>
                                <td>{{ $row->sorting_order }}</td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
