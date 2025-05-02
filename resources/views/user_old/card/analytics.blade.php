@extends('user.layouts.app')

@section('title')
{{ $data['title'] ?? 'Venmeo.de' }}
@endsection
@section('analytics', 'active')

@push('style')
<style>
.progress {
    height: 10px;
    border-radius: 100px;
}
.progress-bar {
    
    color: #fff;
    flex-direction: column;
    justify-content: center;
    text-align: center;
    transition: width 0.6s ease;
    white-space: nowrap;
    border-radius: 100px;
    height: 10px;
}
</style>
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item active">{{__('messages.common.analytics')}}</li>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1">
                        <img src="{{asset('assets/images/icons/card.svg')}}" alt="Cards">
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{__('messages.analytics.your_connection')}}</span>
                        <span class="info-box-number">
                            {{$totalConnection}}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1">
                        <i class="fa-solid fa-eye" style="font-size: 20px;"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{__('messages.analytics.card_view_click')}} </span>
                        <span class="info-box-number">{{$totalView}}</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1">
                        <i class="fa-solid fa-address-book" style="font-size: 22px;"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{__('messages.analytics.contact_saved')}}</span>
                        <span class="info-box-number">{{$totalSavedContact}}</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1">
                        <i class="fa-regular fa-credit-card" style="font-size: 22px;"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{__('messages.analytics.total_card')}}</span>
                        <span class="info-box-number">{{$totalCards}}</span>
                    </div>
                </div>
            </div>
            @if(isset($data) && !empty($data))
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @if(isset($data['country']) && count($data['country']) > 0)
                                <div class="col-12 col-lg-6 my-3">
                                    <div class="card border">
                                        <div class="card-body pb-4">
                                            <h3 class="h5">{{__('messages.analytics.countries')}}</h3>
                                            @foreach($data['country'] as $name => $country)
                                                    <div class="mt-4">
                                                        <div class="d-flex justify-content-between mb-1">
                                                            <div class="text-truncate">
                                                                <span class="align-middle">{{$name}}</span>
                                                            </div>
                                                            <div>
                                                                <small class="text-muted">{{round($country['per'])}}
                                                                    %</small>
                                                                <span class="ml-3">{{$country['count']}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="progress mb-3">
                                                            <div class="progress-bar bg-primary"
                                                                    role="progressbar" style="width: {{$country['per']}}%;"
                                                                    aria-valuenow="{{$country['per']}}" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(isset($data['device']) && count($data['device']) > 0)
                                <div class="col-12 col-lg-6 my-3">
                                    <div class="card h-100 border">
                                        <div class="card-body pb-3">
                                            <h3 class="h5">{{__('messages.analytics.devices')}}</h3>
                                            <p></p>
                                            @foreach($data['device'] as $name => $device)
                                                <div class="mt-4">
                                                    <div class="d-flex justify-content-between mb-1">
                                                        <div class="text-truncate">
                                                            <span>{{(ucfirst($name))}}</span>
                                                        </div>

                                                        <div>
                                                            <small class="text-muted">{{round($device['per'])}}
                                                                %</small>
                                                            <span class="ml-3">{{$device['count']}}</span>
                                                        </div>
                                                    </div>

                                                    <div class="progress mb-3">
                                                        <div class="progress-bar bg-primary"
                                                                role="progressbar" style="width: {{$device['per']}}%;"
                                                                aria-valuenow="{{$device['per']}}" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(isset($data['operating_system']) && count($data['operating_system']) > 0)
                                <div class="col-12 col-lg-6 my-3">
                                    <div class="card h-100 border">
                                        <div class="card-body pb-4">
                                            <h3 class="h5">{{__('messages.analytics.os')}}</h3>
                                            <p></p>
                                            @foreach($data['operating_system'] as $name => $os)
                                                <div class="mt-4">
                                                    <div class="d-flex justify-content-between mb-1">
                                                        <div class="text-truncate">
                                                            <span>{{$name}}</span>
                                                        </div>
                                                        <div>
                                                            <small class="text-muted">{{round($os['per'])}}%</small>
                                                            <span class="ml-3">{{$os['count']}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress mb-3">
                                                        <div class="progress-bar bg-primary"
                                                                role="progressbar" style="width: {{$os['per']}}%;"
                                                                aria-valuenow="{{$os['per']}}" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(isset($data['browser']) && count($data['browser']) > 0)
                                <div class="col-12 col-lg-6 my-3">
                                    <div class="card h-100 border">
                                        <div class="card-body pb-4">
                                            <h3 class="h5">{{__('messages.analytics.browsers')}}</h3>
                                            <p></p>
                                            @foreach($data['browser'] as $name => $browser)
                                                <div class="mt-4">
                                                    <div class="d-flex justify-content-between mb-1">
                                                        <div class="text-truncate">
                                                            <span>{{$name}}</span>
                                                        </div>

                                                        <div>
                                                            <small class="text-muted">{{round($browser['per'])}}
                                                                %</small>
                                                            <span class="ml-3">{{$browser['count']}}</span>
                                                        </div>
                                                    </div>

                                                    <div class="progress mb-3">
                                                        <div class="progress-bar bg-primary"
                                                                role="progressbar" style="width: {{$browser['per']}}%;"
                                                                aria-valuenow="{{$browser['per']}}" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(isset($data['language']) && count($data['language']) > 0)
                                <div class="col-12 col-lg-6 my-3">
                                    <div class="card h-100 border">
                                        <div class="card-body pb-4">
                                            <h3 class="h5">{{__('messages.analytics.languages')}}</h3>
                                            @foreach($data['language'] as $name => $language)
                                                <div class="mt-4">
                                                    <div class="d-flex justify-content-between mb-1">
                                                        <div class="text-truncate">
                                                            <span>{{ $name }}</span>
                                                        </div>

                                                        <div>
                                                            <small class="text-muted">{{round($language['per'])}}
                                                                %</small>
                                                            <span class="ml-3">{{$language['count']}}</span>
                                                        </div>
                                                    </div>

                                                    <div class="progress mb-3">
                                                        <div class="progress-bar bg-primary"
                                                                role="progressbar"
                                                                style="width: {{$language['per']}}%;"
                                                                aria-valuenow="{{$language['per']}}" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('script')
@endpush
