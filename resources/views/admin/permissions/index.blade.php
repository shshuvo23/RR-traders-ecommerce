@extends('admin.layouts.master')

@section('admin-permissions', 'active')
@section('title') Admin| permissions @endsection

@push('style')
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Admin permissions') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Admin permissions') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="m-0">{{ __('Admin permissions list') }}
                                    <span class="float-right">
                                    <a href="{{ route('admin.permissions.create') }}" class="btn btn-sm btn-primary btn-gradient">+ Add new</a>
                                    </span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col" width="15%">Name</th>
                                        <th scope="col">Guard</th>
                                        <th scope="col" colspan="3" width="10%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($permissions as $permission)
                                            <tr>
                                                <td>{{ $permission->name }}</td>
                                                <td>{{ $permission->guard_name }}</td>


                                                <td>
                                                    <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-info btn-xs">Edit</a>
                                                    {!! Form::open(['method' => 'POST','route' => ['admin.permissions.destroy', $permission->id],'style'=>'display:inline', 'class' => 'delete-form']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                                    {!! Form::close() !!}
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

@push('script')
<script>
$(document).on("submit", ".delete-form", function(e) {
    var form = this;
    e.preventDefault();
    Swal.fire({
        title: "{{__('messages.common.want_to_delete')}}",
        text: "{{__('messages.common.permanently_delete')}}",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#8bc34a',
        cancelButtonColor: '#d33',
        cancelButtonText: "{{__('messages.common.cancel')}}",
        confirmButtonText: "{{__('messages.common.yes_delete')}}",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
});
</script>
@endpush
