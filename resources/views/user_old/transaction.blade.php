@extends('user.layouts.app')

@section('title')
{{ $data['title'] ?? 'Venmeo.de' }}
@endsection
@section('transaction', 'active')

@push('style')
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item active">{{__('messages.common.transactions')}}</li>
@endsection

@php
    $localLanguage = Session::get('languageName');
@endphp

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('messages.common.transactions')}}</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="dataTables" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>{{__('messages.transaction.plan_name')}}</th>                      
                                    <th>{{__('messages.transaction.trans_id')}}</th>                     
                                    <th>{{__('messages.common.amount')}}</th>
                                    <th>{{__('messages.common.validity')}}</th>
                                    <th>{{__('messages.transaction.transactions_date')}}</th>
                                    <th>{{__('messages.common.status')}}</th>
                                    <th>{{__('messages.common.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($transactions) && count($transactions) > 0)
                                @foreach ($transactions as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $localLanguage == 'en' ? $item->plan->name : $item->plan->name_de}}</td>
                                    <td>{{$item->transaction_number}}</td>
                                    <td> {{ number_format($item->amount, 2, ',', '') }} {{getDefaultCurrencySymbol()}}</td>
                                    <td>{{date('d F, Y',strtotime($item->user->current_pan_valid_date))}}</td>
                                    <td>{{date('d F, Y',strtotime($item->pay_date))}}</td>
                                
                                    <td>
                                        @if ($item->status == '1')
                                        <span class="text-success">{{__('messages.common.paid')}}</span>
                                        @else
                                        <span class="text-warning">{{__('messages.common.due')}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('user.transaction.invoice.download', $item->id)}}" class="btn btn-sm btn-primary btn-gradient">{{__('messages.common.invoice')}} <i class="fa fa-download"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
@endpush
