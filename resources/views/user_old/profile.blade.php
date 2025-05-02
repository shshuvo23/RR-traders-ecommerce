@extends('user.layouts.app')

@section('title')
    {{ $data['title'] ?? 'Venmeo.de' }}
@endsection

@push('style')
    <style>
        .profile-user-img {
            height: 100px;
            object-fit: cover;
        }
    </style>
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('messages.common.profile') }}</li>
@endsection
@php
    $localLanguage = Session::get('languageName');
@endphp

@section('content')
    <!-- ======================= Profile start  ============================ -->
    <div class="content">
        <div class="container-fluid">
            <div class="row flex-column align-items-center">
                <div class="col-lg-6 col-xl-4">
                    <div class="card card-success card-outline">
                        <div class="card-body box-profile">
                            <a href="{{ route('user.setting') }}" class="position-absolute" style="right: 10px; top: 5px;"
                                title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ getProfile(auth()->user()->image) }}" alt="{{ $user->name }}">
                            </div>
                            <h3 class="profile-username text-center">{{ $user->name }}</h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>{{ __('messages.common.email') }}</b> <a href="mailto:{{ $user->email }}" class="float-right">{{ $user->email }}</a>
                                </li>
                                @if (!empty($user->phone))
                                    <li class="list-group-item">
                                        <b>{{ __('messages.common.phone') }}</b> <a href="tel:{{ $user->phone }}" class="float-right">{{ $user->phone }}</a>
                                    </li>
                                @endif
                                @if (!empty($user->address))
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <b class="mr-3">{{ __('messages.common.address') }}</b>
                                    <span>
                                        {{ $user->address }}
                                    </span>
                                </li>
                            @endif
                            </ul>
                            {{-- <a href="{{route('user.setting')}}" class="btn btn-success btn-block"><b>{{__('messages.common.edit')}}</b></a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('messages.user_dashboard.subscription') }}</h4>
                        </div>
                        @php
                            $today = \Carbon\Carbon::today();
                            $validDate = \Carbon\Carbon::parse($user->current_pan_valid_date);
                            $day = $today->diffInDays($validDate, false);
                            $day = $day < 0 ? 0 : $day;
                        @endphp
                        <div class="card-body">
                            <p>
                                @if ($localLanguage == 'en')
                                    {{ $user->userPlan->name }}
                                @else
                                    {{ $user->userPlan->name_de }}
                                @endif
                                ({{$day}} {{ __('messages.user_dashboard.days_left') }})
                            </p>
                            <a href="{{route('user.upgrade.plan')}}"
                                class="btn btn-primary btn-sm btn-gradient">{{ __('messages.user_dashboard.upgrade_plan') }}</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- ======================= Dashboard end  ============================ -->
@endsection

@push('script')
@endpush
