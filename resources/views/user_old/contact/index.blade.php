@extends('user.layouts.app')

@section('title')
{{ $data['title'] ?? 'Venmeo.de' }}
@endsection
@section('contact', 'active')

@push('style')
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item active">{{__('messages.common.contacts')}}</li>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('messages.common.contacts')}}</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="dataTables" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>{{__('messages.common.name')}}</th>
                                    <th>{{__('messages.common.email')}}</th>
                                    <th>{{__('messages.common.phone')}}</th>
                                    <th>{{__('messages.common.job_title')}}</th>
                                    <th>{{__('messages.common.company_name')}}</th>
                                    <th>{{__('messages.common.message')}}</th>
                                    <th>{{__('messages.common.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inquiries as $key => $row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{\Illuminate\Support\Str::limit($row->name, 35)}} </td>
                                    <td><a href="mailto:{{$row->email}}">{{$row->email}}</a></td>
                                    <td><a href="tel:{{$row->phone ? '+'.$row->phone : ''}}">{{$row->phone ? '+'.$row->phone : ''}}</a></td>
                                    <td>{{\Illuminate\Support\Str::limit($row->job_title, 35)}} </td>
                                    <td>{{\Illuminate\Support\Str::limit($row->company_name, 35)}} </td>
                                    <td>{{\Illuminate\Support\Str::limit($row->message, 35)}}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-gradient view" data-id="{{$row->id}}">{{__('messages.common.view')}}</a>
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

<!-- Contact View -->
<div class="modal fade" id="viewContactModal" tabindex="-1" aria-labelledby="viewContactModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-sm">
            <div class="modal-header">
                <h5 class="modal-title" id="viewContactModalLabel">{{__('messages.common.contact_view')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_body">
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).on('click', '.view', function() {
        let id = $(this).data('id');
        $.get('contact/'+id+'/view', function(data) {
            console.log(data);
            $('#viewContactModal').modal('show');
            $('#modal_body').html(data);
        });
    });
</script>
@endpush
