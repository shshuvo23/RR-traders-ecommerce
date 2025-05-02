@php
    $setting = getSetting();
    $localLanguage = Session::get('languageName');
@endphp

<head>
    <style>
        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: 15px;
            margin-left: 15px;
        }

        .col-sm-6 {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
            display: inline-block;
            /* margin-left: 10px;
            margin-right: 10px; */
        }

        .text-sm-right {
            text-align: right !important;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table-transparent {
            background-color: transparent;
        }

        .table-responsive {
            /* display: block; */
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table td,
        .table th {
            padding: .75rem;
            vertical-align: top;
            /* border-top: 1px solid #dee2e6; */
        }

        .text-center {
            text-align: center !important;
        }

        .text-end {
            text-align: right !important;
        }

        .text-secondary {
            color: #6c757d !important;
        }

        .text-uppercase {
            text-transform: uppercase !important;
        }

        .font-weight-bold {
            font-weight: bold !important;
        }

        .strong {
            font-weight: 700 !important;
        }

        .mt-5 {
            margin-top: 3rem !important;
        }
    </style>
</head>
<div class="container-xl">
    <div class="card card-lg" style="margin-top: 5px;">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <p class="h3" style="font-size: 20px;">{{ $setting->site_name }}</p>
                    <address style="font-size: 17px;">
                        {{ $setting->office_address }} <br>
                        {{ $setting->email }} <br>
                        {{ $setting->phone_no }} <br>
                        Invoice #{{ $row->transaction_number }}
                    </address>
                </div>
                <div class="col-sm-6 text-sm-right" style="float: right; font-size: 17px;">
                    <p class="h3"></p>
                    <address style="margin-top: 71px;">
                        {{ $row->user->name ?? '' }} <br>
                        @if ($row->user->phone)
                            {{ $row->user->phone }} <br>
                        @endif
                        {{ $row->user->email }}
                    </address>
                    {{ __('messages.transaction.purchase_date') }}: {{ date('d F Y',strtotime($row->pay_date)) }}
                </div>

            </div>
            <table class="table table-transparent table-responsive" style="margin-top: 50px;">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 1%">{{ __('messages.transaction.plan_name') }}</th>
                        <th class="text-center" style="width: 1%">{{ __('messages.transaction.plan_validity') }}</th>
                        <th class="text-end" style="width: 1%">{{ __('messages.common.amount') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">
                            {{ $localLanguage == 'en' ? $row->plan->name : $row->plan->name_de }}
                        </td>
                        <td class="text-center">
                            {{ $row->plan->day }} {{__('messages.common.days')}}
                        </td>
                        <td class="text-end"> {{ $row->amount }} {{getDefaultCurrencySymbol()}}</td>
                    </tr>

                    <tr>
                        <td colspan="2" class="font-weight-bold text-uppercase text-end">
                            {{ __('messages.common.total_amount') }}</td>
                        <td class="font-weight-bold text-end"> {{ $row->amount }} {{getDefaultCurrencySymbol()}}</td>
                    </tr>
                </tbody>
            </table>
            <p class="text-secondary text-center mt-5">{{$setting->invoice_footer}}</p>
        </div>
    </div>
</div>
