@extends('user.layouts.app')

@section('title')
    {{ $data['title'] ?? 'Venmeo.de' }}
@endsection
@section('plan', 'active')

@push('style')
    <style>
        .pricing-section .top_shape {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }

        .pricing-section svg {
            height: 3rem;
            width: 100%;
        }

        .pricing h4 {
            font-size: 24px;
            font-family: 'Pridi', sans-serif;
            font-weight: 500;
            color: #212121;
        }

        .pricing-price {
            font-size: 20px;
            background: #f0f0f0;
            display: inline-block;
            padding: 7px 20px;
            border-radius: 50px;
            font-family: 'Pridi', sans-serif;
            font-weight: 400;
            margin-bottom: 20px;
        }

        .pricing-price-period {
            font-size: 15px;
            font-family: 'Roboto', sans-serif;
        }

        .pricing-list li {
            list-style: disc;
            font-size: 16px;
            padding: 5px 0px;
            font-family: 'Roboto', sans-serif;
            color: #333;
        }
        /* @media (max-width: 768px) {
            .fa-ul {
                margin-left: 0 !important;
            }
        } */
    </style>
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ $title ?? '' }}</li>
@endsection
@php
    $localLanguage = Session::get('languageName');
@endphp

@section('content')
    <!-- ======================= Plan start  ============================ -->
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">{{ __('messages.common.plan') }}</h4>
                        </div>
                        <div>
                            <a href="{{ route('user.profile') }}"
                                class="btn btn-sm btn-primary btn-gradient">{{ __('messages.common.back') }} </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gy-4 gy-lg-0">
                @foreach ($plans as $plan)
                    <div class="col-lg-4 mb-4 mb-lg-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="text-center">
                                    <h4 class="mb-4">
                                        @if ($localLanguage == 'en')
                                            {{ $plan->name }}
                                        @else
                                            {{ $plan->name_de }}
                                        @endif
                                        @if ($userPlan == $plan->id)
                                            <span class="text-success">({{ __('messages.common.current') }})</span>
                                        @endif
                                    </h4>
                                    <div class="pricing-price">
                                        <sup>{{ $plan->currency }}</sup>
                                        {{ number_format($plan->price, 2, ',', '') }}
                                        <span class="pricing-price-period">/ {{ $plan->day }} Days</span>
                                    </div>
                                </div>
                                <ul class="fa-ul pricing-list mt-4">
                                    <li>{{ __('messages.user_dashboard.no_of_vcards') }} {{ $plan->no_of_vcards }}</li>
                                    
                                    <li>{{ __('messages.user_dashboard.self_branding') }}
                                        {{ $plan->self_branding == '1' ? '(Yes)' : '(No)' }}</li>
                                    @foreach ($plan->features as $item)
                                        <li> {{ $localLanguage == 'en' ? $item->feature_name : $item->feature_name_de }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            @php
                                $current_plan = DB::table('plans')->find($userPlan);
                                $current_plan_card = $current_plan->no_of_vcards;
                                $new_plan_card = $plan->no_of_vcards;
                                $card_difference = $current_plan_card - $new_plan_card;
                            @endphp
                            <div class="card-footer">
                                <div class="choose-plan text-center">
                                    <a href="{{ route('user.processTransaction', ['planId' => $plan->id]) }}"
                                        class="btn btn-primary btn-gradient"
                                        onclick="return {{ $current_plan_card > $new_plan_card ? "confirm('" . __("messages.plan.buy_plan_confirmation", ['card_difference' => $card_difference]) . "')" : 'true' }};">{{ __('messages.user_dashboard.upgrade_plan') }}</a>
                                </div>
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- ======================= plan end  ============================ -->
@endsection

@push('script')
@endpush
