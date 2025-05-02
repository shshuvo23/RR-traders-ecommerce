@extends('frontend.layouts.app')
@section('title')
    {{ $title ?? $setting->site_title }}
@endsection

@push('style')
<style>
    body {
        background: #eee;
    }

    .invoice {
        padding: 30px;
    }

    .invoice h2 {
        margin-top: 0px;
        line-height: 0.8em;
    }

    .invoice .small {
        font-weight: 300;
    }

    .invoice hr {
        margin-top: 10px;
        border-color: #ddd;
    }

    .invoice .table tr.line {
        border-bottom: 1px solid #ccc;
    }

    .invoice .table td {
        border: none;
    }

    .invoice .identity {
        margin-top: 10px;
        font-size: 1.1em;
        font-weight: 300;
    }

    .invoice .identity strong {
        font-weight: 600;
    }


    .grid {
        position: relative;
        width: 100%;
        background: #fff;
        color: #666666;
        border-radius: 2px;
        margin-bottom: 25px;
        box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush
@php
    $setting = getSetting();
    $localLanguage = session()->get('languageName') ?? geDefaultLanguage()->iso_code;
@endphp
@section('content')
    <div class="container">
        <div class="">
            <!-- BEGIN INVOICE -->
            <div class="col-xs-12">
                <div class="grid invoice">
                    <div class="grid-body">
                        <div class="invoice-title">
                            <div class="">
                                <div class="text-center">
                                    <img src="{{getIcon($setting->site_logo)}}" alt=""
                                        height="35" class="bg-dark p-1">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-12">
                                    <h3>{{ __('messages.common.invoice') }}<br>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-5">
                            <div class="d-flex justify-content-between aling-item-center">
                                <div class="">
                                    <address>
                                        <strong class="fs-4">{{ $setting->site_name }}</strong><br>
                                        {{ $setting->office_address }} <br>
                                        {{ $setting->email }} <br>
                                        {{ $setting->phone_no }} <br>
                                        Invoice #{{ $row->transaction_number }}
                                    </address>
                                </div>
                                <div class="text-right">
                                    <address>
                                        {{ $row->user->name ?? '' }} <br>
                                        @if ($row->user->phone)
                                            {{ $row->user->phone }} <br>
                                        @endif
                                        {{ $row->user->email }} <br>
                                    {{ __('messages.transaction.purchase_date') }}: {{ date('d F Y',strtotime($row->pay_date)) }}
                                    </address>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="d-flex justify-content-between align-item-center">
                            <div class="">
                                <address>
                                    <strong>Payment Method:</strong><br>
                                    Visa ending **** 1234<br>
                                    h.elaine@gmail.com<br>
                                </address>
                            </div>
                            <div class="text-right">
                                <address>
                                    <strong>Order Date:</strong><br>
                                    17/06/14
                                </address>
                            </div>
                        </div> --}}
                        <div class="row mt-3">
                            <div class="col-md-12">
                                {{-- <h3>ORDER SUMMARY</h3> --}}
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="line">
                                            <td class="text-center"><strong>{{ __('messages.transaction.plan_name') }}</strong></td>
                                            <td class="text-right"><strong>{{ __('messages.transaction.plan_validity') }}</strong></td>
                                            <td class="text-right"><strong>{{ __('messages.common.amount') }}</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><strong> {{ $localLanguage == 'en' ? $row->plan->name : $row->plan->name_de }}</strong></td>
                                            <td class="text-right">{{ $row->plan->day }} {{__('messages.common.days')}}</td>
                                            <td class="text-right">{{ number_format($row->amount, 2, ',', '') }} {{getDefaultCurrencySymbol()}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="">
                                            </td>
                                            <td class="text-right"><strong>{{ __('messages.common.total_amount') }}</strong></td>
                                            <td class="text-right"><strong>{{ number_format($row->amount, 2, ',', '') }} {{getDefaultCurrencySymbol()}}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center identity mt-5">
                                <p>{{$setting->invoice_footer}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END INVOICE -->
        </div>
    </div>
@endsection
