@extends('admin.layouts.master')

@section('brands', 'active')
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
                                    <h3 class="card-title">Manage {{ $title ?? '' }} </h3>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <a href="{{ route('admin.brand.create') }}" class="btn btn-primary btn-sm">Add New</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table id="dataTables" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $index => $row)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $row->name }}</td>

                                        <td>
                                            <span class="badge {{ $row->status ? 'badge-success' : 'badge-danger' }}">
                                                {{ $row->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>

                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                                  Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('admin.brand.edit', $row->id) }}">
                                                            <i class="fas fa-edit me-2"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('admin.brand.show', $row->id) }}">
                                                            <i class="fas fa-eye me-2"></i> View
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('admin.product.index', ['brand' => $row->id]) }}">
                                                            <i class="fab fa-product-hunt"></i> Products <span class="text-primary">({{$row->brand->count()}})</span>
                                                        </a>
                                                    </li>
                                                    {{-- <li>
                                                        <a class="dropdown-item" href="{{ route('admin.product.gallery', $product->id) }}">
                                                            Gallery
                                                        </a>
                                                    </li> --}}
                                                    <li>
                                                        <form action="{{ route('admin.brand.delete', $row->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure?')">
                                                                <i class="fas fa-trash-alt"></i>  Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </div>
                                              </div>


                                            {{-- <div class="d-flex align-items-center justify-content-center gap-2">
                                                <a href="{{ route('admin.brand.edit', $row->id) }}" class="btn btn-sm btn-info mx-2">Edit</a>
                                                <a href="{{ route('admin.brand.show', $row->id) }}" class="btn btn-sm btn-success mx-2">Show</a>
                                                <form action="{{ route('admin.brand.delete', $row->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </div> --}}

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
