@extends('user.layouts.app')

@section('title')
    {{ $data['title'] ?? 'Venmeo.de' }}
@endsection
@section('card', 'active')

@push('style')
    <style>
        .st-btn {
            display: inline-block !important;
            margin: 5px 0px;
        }

        div[data-network="sharethis"],
        div[data-network="copy"] {
            display: none !important;
        }
    </style>
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('messages.common.cards') }}</li>
@endsection
@php
    $user = auth()->user()->current_pan_id;
    $plan = DB::table('plans')->find($user);
    // dd($activeCardCount <= $plan->no_of_vcards, $plan->no_of_vcards, $activeCardCount);
@endphp

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="card-title">{{ __('messages.common.cards') }}</h4>
                                </div>
                                <div>
                                    <a href="{{ route('user.card.theme') }}"
                                        class="btn btn-sm btn-primary btn-gradient">{{ __('messages.user_dashboard.add_new_card') }} <i
                                            class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="dataTables" class="table table-bordered table-striped" style="min-width:1000px;">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>{{ __('messages.user_dashboard.card_name') }}</th>
                                        <th>{{ __('messages.common.image') }}</th>
                                        <th>{{ __('messages.common.link') }}</th>
                                        <th>{{ __('messages.common.views') }}</th>
                                        <th>{{ __('messages.common.date') }}</th>
                                        <th>{{ __('messages.common.status') }}</th>
                                        <th>{{ __('messages.common.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cards as $key => $row)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $row->first_name ?? '' }}&nbsp;{{ $row->last_name ?? '' }}</td>
                                            <td>
                                                <img src="{{ getProfile($row->profile_image) }}" width="50"
                                                    class="rounded-pill" alt="">
                                            </td>
                                            <td><a href="{{ route('card.preview', $row->url_alias) }}"
                                                    class="text-info plan-check" target="_blank">{{ $row->url_alias }}</a>
                                            </td>
                                            <td>{{ $row->total_view }}</td>
                                            <td>
                                   
                                                <div>{{ date('d M, Y', strtotime($row->created_at)) }}</div>
                                                <div>{{ date('h:i A', strtotime($row->created_at)) }}</div>
                                            
                                            </td>
                                            <td>
                                                <span class="text-{{ $row->status == '1' ? 'success' : 'danger' }}">
                                                    {{ $row->status == '1' ? __('messages.common.active') : __('messages.common.inactive') }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle btn-sm btn-gradient" type="button"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        {{ __('messages.common.actions') }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a href="{{ route('card.preview', $row->url_alias) }}"
                                                            target="_blank"
                                                            class="dropdown-item plan-check"><i class="fa fa-eye"></i> {{ __('messages.common.preview') }}</a>
                                                        <a data-toggle="modal" href="#shareModalToggle" role="button"
                                                            class="dropdown-item plan-check"
                                                            data-url="{{ route('card.preview', $row->url_alias) }}"><i class="fa fa-share"></i> 
                                                            {{ __('messages.common.share') }}
                                                        </a>
                                                        @if ($plan->no_of_vcards > $activeCardCount )
                                                        <a href="{{route('user.card.status',['id'=>$row->id])}}"
                                                            onclick="return confirm('Are you sure to change status?')"
                                                            class="dropdown-item"><i class="fa fa-rainbow"></i> 
                                                            @if($row->status == '1')
                                                                {{__('messages.common.deactive')}}
                                                            @else
                                                                {{__('messages.common.active')}}
                                                            @endif

                                                        </a>
                                                        @endif
                                                        {{-- <a href="#" class="dropdown-item text-success">{{__('messages.common.set_as_live')}}</a> --}}
                                                        <a href="{{ route('user.card.edit', $row->id) }}"
                                                            class="dropdown-item text-primary"><i class="fa fa-pencil"></i> {{ __('messages.common.edit') }}</a>
                                                        <a href="{{ route('user.card.delete', $row->id) }}" id="deleteData"
                                                            class="dropdown-item text-danger"><i class="fa fa-trash"></i> {{ __('messages.common.delete') }}</a>
                                                    </div>
                                                </div>
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

    <!-- ======================= Modal Start  ============================ -->
    <div class="modal fade" id="shareModalToggle" role="dialog" aria-labelledby="shareModalToggleLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shareModalToggleLabel">{{ __('messages.common.share_options') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ShareThis BEGIN -->
                    <div class="sharethis-inline-share-buttons" id="sharethis-inline-share-buttons"></div>
                    <!-- ShareThis END -->
                </div>
            </div>
        </div>
    </div>
    <!-- ======================= Modal End  ============================ -->
@endsection

@push('script')
    <script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=65b78fd51d58d50012137494&product=inline-share-buttons'
        async='async'></script>
    <script>
        $('#shareModalToggle').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var url = button.data('url');
            var shareThisDiv = $('.sharethis-inline-share-buttons.st-center.st-inline-share-buttons.st-animated');
            shareThisDiv.attr('data-url', url);
            if (window.__sharethis__) {
                window.__sharethis__.load('inline-share-buttons', {
                    url: url
                });
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            var planValid = '{{ checkPlanValidity() }}';

            document.querySelectorAll('.plan-check').forEach(function(link) {
                link.addEventListener('click', function(event) {
                    if (!planValid) {
                        event.preventDefault();
                        event.stopPropagation();
                        toastr.warning('{{ __('messages.toastr.please_upgrade_plan') }}',
                            '{{ __('messages.toastr.warning') }}', {
                                positionClass: "toast-top-right"
                            });
                    }
                });
            });
        });
    </script>
@endpush
