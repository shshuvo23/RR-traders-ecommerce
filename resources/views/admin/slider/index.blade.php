@extends('admin.layouts.master')

@section('slider', 'active')
@section('title') {{ $title ?? '' }} @endsection

@push('style')

@endpush

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title ?? '' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $title ?? '' }}</li>
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
                                    <h3 class="card-title">Manage Sliders</h3>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        {{-- @if (Auth::user()->can('admin.slider.create')) --}}
                                        <a href="{{ route('admin.slider.create') }}"
                                            class="btn btn-primary btn-sm">Add New Slider</a>
                                        {{-- @endif --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table id="dataTables" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">SL</th>
                                        <th style="width: 10%;">Image</th>
                                        <th style="width: 10%;">Name</th>
                                        <th style="width: 10%;">Link</th>
                                        <th style="width: 10%;">Order</th>
                                        <th style="width: 10%;">Status</th>
                                        <th style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $index => $row)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if($row->image)
                                            <img src="{{ asset($row->image) }}" alt="Slider Image" class="img-thumbnail" width="250" height="150">
                                            @else
                                            No Image
                                            @endif
                                        </td>
                                        <td>{{ $row->name }}</td>
                                        <td><a href="{{ $row->link }}" target="_blank">{{ $row->link }}</a></td>
                                        <td>{{ $row->sorting_order }}</td>
                                        <td>
                                            <span class="badge {{ $row->status ? 'badge-success' : 'badge-danger' }}">
                                                {{ $row->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.slider.edit', $row->id) }}" class="btn btn-sm btn-info">Edit</a>
                                            <a href="{{ route('admin.slider.show', $row->id) }}" class="btn btn-sm btn-info">View</a>
                                            <form action="{{ route('admin.slider.delete', $row->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
