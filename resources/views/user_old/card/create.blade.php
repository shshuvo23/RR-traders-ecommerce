@extends('user.layouts.app')

@section('title')
{{ $data['title'] ?? 'Venmeo.de' }}
@endsection
@section('card', 'active')

@push('style')
<link href="{{ asset('assets/css/croppie.css') }}" rel="stylesheet" />
<style>
    body {
        background: #fff !important;
    }
    .card-font {
        font-family: Roboto, sans-serif !important;
    }
    .btn-group-sm>.btn, .btn-sm {
        padding: 0.5rem 1rem !important;
        font-size: .875rem !important;
    }

    @media only screen and (min-width: 960px) {
        .img-crop-modal {
            max-width: 650px!important;
        }
        .img-crop-modal .modal-body {
            padding-top: 15px!important;
        }
    }
    @media only screen and (max-device-width: 480px) {
    }
</style>
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item active">{{__('messages.common.create_card')}}</li>
@endsection
@php
  $user = auth()->user();
@endphp
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8">
                <div class="card card-font">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="">
                                <h4 class="card-title">{{__('messages.common.create_your_card')}}</h4>
                            </div>
                            <div class="">
                                <a href="{{route('user.card.theme')}}" class="btn btn-sm btn-primary btn-gradient">{{__('messages.common.back')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('user.card.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="template_id" id="template_id" value="{{request()->theme ?? '1'}}">
                            <input id="upload_image_url" name="upload_image_url" type="hidden"
                                value="{{ route('user.card.upload.image') }}" />
                            <input id="upload_cover_url" name="upload_cover_url" type="hidden"
                                value="{{ route('user.card.upload.cover') }}" />
                            <p><strong>{{__('messages.card.basic_info')}}</strong></p>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">{{__('messages.common.card_url')}} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="url_alias" class="form-control" placeholder="{{__('messages.common.card_url')}}" value="{{ uniqid() }}" 
                                        oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/g, '')" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">{{__('messages.card.cover_image')}} <span
                                                class="text-danger">*</span>
                                                <br><small class="text-info fw-bold"><strong>({{__('messages.settings_home_content.recommended_size')}} 500x200px)</strong></small>
                                        </label>
                                        <input type="file" name="cover_image" id="upload_cover" class="form-control" accept="image/*" required>
                                        <input type="hidden" name="cover_image_path" id="cover_image_path" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">{{__('messages.card.profile_image')}} <span
                                                class="text-danger">*</span> 
                                                <br><small class="text-info fw-bold"><strong>({{__('messages.settings_home_content.recommended_size')}} 150x150px)</strong></small>
                                        </label>
                                        <input type="file" name="profile_image" id="upload_image" class="form-control" accept="image/*" required>
                                        <input type="hidden" name="profile_image_path" id="profile_image_path" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">{{__('messages.common.first_name')}} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="first_name" class="form-control cin preview_name" data-preview="preview_name"
                                        data-concat="preview_name" placeholder="{{__('messages.common.first_name')}}" value="{{ $user->name ?? old('first_name')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">{{__('messages.common.last_name')}} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="last_name" class="form-control cin preview_name" data-preview="preview_name"
                                        data-concat="preview_name" placeholder="{{__('messages.common.last_name')}}" value="{{ old('last_name')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">{{__('messages.common.email')}} <span
                                                class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control cin preview_email" data-preview="preview_email"
                                            placeholder="{{__('messages.common.email')}}" value="{{ $user->email ?? old('email')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">{{__('messages.common.phone')}} <span
                                                class="text-danger">*</span></label>
                                        <input type="tel" name="phone" class="form-control cin preview_phone" data-preview="preview_phone"
                                            placeholder="{{__('messages.common.phone')}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" 
                                            value="{{ $user->phone ?? old('phone')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">{{__('messages.order.telephone')}}</label>
                                        <input type="tel" name="phone_2" class="form-control cin preview_phone_2" data-preview="preview_phone_2"
                                            placeholder="{{__('messages.order.telephone')}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" 
                                            value="{{ old('phone_2')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">{{__('messages.common.designation')}} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="designation" class="form-control cin preview_designation" data-preview="preview_designation"
                                            placeholder="{{__('messages.common.designation')}}" value="{{old('designation')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">{{__('messages.common.company_name')}} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="company_name" class="form-control cin preview_company" data-preview="preview_company"
                                            placeholder="{{__('messages.common.company_name')}}" value="{{old('company_name')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">{{__('messages.common.address')}} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="address" class="form-control cin preview_address" data-preview="preview_address"
                                            placeholder="{{__('messages.common.address')}}" value="{{ $user->address ?? old('address')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">{{__('messages.common.website')}}</label>
                                        <input type="url" name="website" value="{{old('website')}}" class="form-control cin preview_website icon_in" 
                                            data-preview="preview_website" placeholder="{{__('messages.common.website')}}" data-icon="website">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">{{__('messages.common.website')}}</label>
                                        <input type="url" name="website_2" value="{{old('website_2')}}" class="form-control cin preview_website_2 icon_in" 
                                            data-preview="preview_website_2" placeholder="{{__('messages.common.website')}}" data-icon="website_2">
                                    </div>
                                </div>
                                @if(checkPlanFeature('self_branding'))
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">{{__('messages.user_dashboard.self_branding')}}</label>
                                        <input type="text" name="self_branding" value="{{old('self_branding')}}" class="form-control cin preview_branding" 
                                            data-preview="preview_branding" placeholder="{{__('messages.user_dashboard.self_branding')}}">
                                    </div>
                                </div>
                                @endif
                                <div class="col-12">
                                    <hr>
                                    <p><strong>{{__('messages.card.social_media')}}</strong></p>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label for="facebook" class="form-label">{{__('messages.card.facebook')}}</label>
                                    <input type="url" name="facebook" value="{{old('facebook')}}" placeholder="ex: https://www.facebook.com/venmeo.de"
                                        class="form-control icon_in" data-icon="facebook">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="twitter" class="form-label">{{__('messages.card.twitter')}}</label>
                                    <input type="url" name="twitter" value="{{old('twitter')}}" placeholder="ex: https://www.twitter.com/venmeo.de"
                                        class="form-control icon_in" data-icon="twitter">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="linkedin" class="form-label">{{__('messages.card.linkedin')}}</label>
                                    <input type="url" name="linkedin" value="{{old('linkedin')}}" placeholder="ex: https://www.linkedin.com/venmeo.de"
                                        class="form-control icon_in" data-icon="linkedin">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="whatsapp" class="form-label">{{__('messages.card.whatsapp')}}</label>
                                    <input type="tel" name="whatsapp" value="{{old('whatsapp')}}" oninput="this.value = this.value.replace(/[^0-9.+]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        placeholder="ex: +491733910844" class="form-control icon_in" data-icon="whatsapp">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="pinterest" class="form-label">{{__('messages.card.pinterest')}}</label>
                                    <input type="url" name="pinterest" value="{{old('pinterest')}}" placeholder="ex: https://www.pinterest.com/venmeo.de"
                                        class="form-control icon_in" data-icon="pinterest">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="instagram" class="form-label">{{__('messages.card.instagram')}}</label>
                                    <input type="url" name="instagram" value="{{old('instagram')}}" placeholder="ex: https://www.instagram.com/venmeo.de"
                                        class="form-control icon_in" data-icon="instagram">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="calendly" class="form-label">{{__('messages.card.calendly')}}</label>
                                    <input type="text" name="calendly" value="{{old('calendly')}}" placeholder="ex: {{__('messages.common.username')}}"
                                        class="form-control icon_in" data-icon="calendly">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="spotify" class="form-label">{{__('messages.card.spotify')}}</label>
                                    <input type="url" name="spotify" value="{{old('spotify')}}" placeholder="ex: http://open.spotify.com/user/venmeo.de"
                                        class="form-control icon_in" data-icon="spotify">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="twitch" class="form-label">{{__('messages.card.twitch')}}</label>
                                    <input type="url" name="twitch" value="{{old('twitch')}}" placeholder="ex: https://www.twitch.com/venmeo.de"
                                        class="form-control icon_in" data-icon="twitch">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="xing" class="form-label">{{__('messages.card.xing')}}</label>
                                    <input type="url" name="xing" value="{{old('xing')}}" placeholder="ex: https://www.xing.com/venmeo.de"
                                        class="form-control icon_in" data-icon="xing">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="telegram" class="form-label">{{__('messages.card.telegram')}}</label>
                                    <input type="url" name="telegram" value="{{old('telegram')}}" placeholder="ex: https://t.me/{{__('messages.common.username')}}"
                                        class="form-control icon_in" data-icon="telegram">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="paypal" class="form-label">{{__('messages.card.paypal')}}</label>
                                    <input type="text" name="paypal" value="{{old('paypal')}}" placeholder="{{__('messages.placeholder.your_paypal')}}"
                                        class="form-control cin preview_paypal icon_in"
                                        data-preview="preview_paypal" data-icon="paypal">
                                </div>
                            </div>
                            <div class="col-12 text-center mt-4 mb-2">
                                <button type="submit" class="btn btn-success btn-sm">{{__('messages.card.save_card')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="">
                    <div class="p-0">
                        @if(request()->theme == '1')
                            @include('user.card.template.template1')
                        @elseif(request()->theme == '2')
                            @include('user.card.template.template2')
                        @else
                            @include('user.card.template.template1')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- profile image upload modal --}}
<div id="uploadimageModal" class="modal" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered img-crop-modal">
        <div class="modal-content">
            <div class="modal-body img-crop-modal-body">
                <div id="image_demo" style="margin-top:30px"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success crop_image btn-sm">
                    <span class="btn-txt">{{ __('messages.common.upload_file') }}</span>
                </button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">{{ __('messages.common.cancel')}}</button>
            </div>
        </div>
    </div>
</div>
{{-- cover image upload modal --}}
<div id="uploadcoverModal" class="modal" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered img-crop-modal">
        <div class="modal-content">
            <div class="modal-body img-crop-modal-body">
                <div id="cover_demo" style="margin-top:30px"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success crop_cover btn-sm">
                    <span class="btn-txt">{{ __('messages.common.upload_file') }}</span>
                </button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">{{ __('messages.common.cancel')}}</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
        <script src="{{ asset('assets/js/card.js') }}?v=1.0.3"></script>
        <script src="{{ asset('assets/js/croppie.js') }}?v=1.0.3"></script>
        @include('user.card.image_crop')
@endpush
