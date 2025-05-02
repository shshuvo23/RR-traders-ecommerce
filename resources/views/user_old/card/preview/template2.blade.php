@extends('user.card.preview.app')

@section('title')
    {{$card->first_name ?? ''}}&nbsp;{{$card->last_name ?? ''}}
@endsection

@section('meta')
@endsection

@push('style')
<link rel="stylesheet" href="{{asset('assets/css/theme2.css')}}?v=3">
<style>
    .st-btn {
        margin: 5px 0px;
    }
    
</style>
@endpush
@php
    $setting = getSetting();
@endphp
@section('content')
<div class="template">
    <div class="banner mb-4 position-relative" style="background-image: url('{{asset($card->cover_image ?? 'assets/images/temmplate-bg.jpg')}}');">
        <div class="user_pic">
            <img src="{{asset(getProfile($card->profile_image))}}" width="120" class="rounded-pill img-fluid" alt="">
        </div>
    </div>

    <div class="px-4 pt-4 pb-2">
        <div class="profile_info mt-5 text-center">
            <h2 id="preview_name">{{$card->first_name}}&nbsp;{{$card->last_name}}</h2>
            <h4><span id="preview_designation">{{$card->job_title}}</span>  <span id="preview_company">{{$card->company}}</span></h4>
            <h4 id="preview_address">{{$card->location}}</h4>
        </div>

        <div class="social_list mt-5 mb-5">
            <div class="row row-cols-4 row-cols-sm-4 gy-4">
                <div class="col mb-4">
                    <div class="content text-center">
                        <a href="javascript:void(0)" id="copyLink">
                            <div class="icon">
                                <i class="fa fa-link"></i>
                            </div>
                        </a>
                    </div>
                </div>
                @if(isset($icons->website))
                    <div class="col mb-4 icon-wrapper" data-icon="website">
                        <div class="content text-center">
                            <a href="{{$icons->website}}" target="_blank">
                                <div class="icon">
                                    <i class="fa fa-globe"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif

                @if(isset($icons->facebook))
                    <div class="col mb-4 icon-wrapper" data-icon="facebook">
                        <div class="content text-center">
                            <a href="{{$icons->facebook}}" target="_blank">
                                <div class="icon facebook">
                                    <i class="fab fa-facebook"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif

                @if(isset($icons->twitter))
                    <div class="col mb-4 icon-wrapper" data-icon="twitter">
                        <div class="content text-center">
                            <a href="{{$icons->twitter}}" target="_blank">
                                <div class="icon twitter">
                                    <i class="fab fa-x-twitter"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif

                @if(isset($icons->linkedin))
                    <div class="col mb-4 icon-wrapper" data-icon="linkedin">
                        <div class="content text-center">
                            <a href="{{$icons->linkedin}}" target="_blank">
                                <div class="icon linkedin">
                                    <i class="fab fa-linkedin"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif

                @if(isset($icons->whatsapp))
                    <div class="col mb-4 icon-wrapper" data-icon="whatsapp">
                        <div class="content text-center">
                            <a href="https://wa.me/{{$icons->whatsapp}}" target="_blank">
                                <div class="icon whatsapp">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif

                @if(isset($icons->pinterest))
                    <div class="col mb-4 icon-wrapper" data-icon="pinterest">
                        <div class="content text-center">
                            <a href="{{$icons->pinterest}}" target="_blank">
                                <div class="icon pinterest">
                                    <i class="fab fa-pinterest"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif

                @if(isset($icons->instagram))
                    <div class="col mb-4 icon-wrapper" data-icon="instagram">
                        <div class="content text-center">
                            <a href="{{$icons->instagram}}" target="_blank">
                                <div class="icon instagram">
                                    <i class="fab fa-instagram"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif

                @if(isset($icons->spotify))
                    <div class="col mb-4 icon-wrapper" data-icon="spotify">
                        <div class="content text-center">
                            <a href="{{$icons->spotify}}" target="_blank">
                                <div class="icon spotify">
                                    <i class="fab fa-spotify"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
                
                @if(isset($icons->calendly))
                    <div class="col mb-4 icon-wrapper" data-icon="spotify">
                        <div class="content text-center">
                            <a href="https://calendly.com/{{$icons->calendly}}" target="_blank">
                                <div class="icon" style="background-color : #0ae1e854; padding-top: 0.15rem !important;">
                                    <img src="{{asset('assets/images/calendly.svg')}}" alt="calendly" height="40px">
                                </div>
                            </a>
                        </div>
                    </div>
                @endif

                @if(isset($icons->twitch))
                    <div class="col mb-4 icon-wrapper" data-icon="twitch">
                        <div class="content text-center">
                            <a href="{{$icons->twitch}}" target="_blank">
                                <div class="icon twitch">
                                    <i class="fab fa-twitch"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif

                @if(isset($icons->xing))
                    <div class="col mb-4 icon-wrapper" data-icon="xing">
                        <div class="content text-center">
                            <a href="{{$icons->xing}}" target="_blank">
                                <div class="icon xing">
                                    <i class="fab fa-xing"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif

                @if(isset($icons->telegram))
                    <div class="col mb-4 icon-wrapper" data-icon="telegram">
                        <div class="content text-center">
                            <a href="{{$icons->telegram}}" target="_blank">
                                <div class="icon telegram">
                                    <i class="fab fa-telegram"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <div class="save_contact mt-5 mb-4 text-center">
                <a href="javascript:void(0)" class="btn btn-dark text-white rounded" onclick="saveContacts()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon-tabler icons-tabler-outline icon-tabler-download">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                        <path d="M7 11l5 5l5 -5" />
                        <path d="M12 4l0 12" />
                    </svg>
                    {{__('messages.common.add_contact')}}
                </a>
            </div>
            <div class="">
                <div class="icon-wrap position-relative shadow-sm">
                    <a href="javascript:void(0)" class="stretched-link">
                        <div class="d-flex flex-row align-items-center">
                            <div class="fa_icon me-3">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="">
                                <div class="title">{{__('messages.common.company')}}</div>
                                <div class="description" id="preview_company">{{$card->company}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="icon-wrap position-relative shadow-sm">
                    <a href="mailto:{{ $card->email }}" class="stretched-link">
                        <div class="d-flex flex-row align-items-center">
                            <div class="fa_icon me-3">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="">
                                <div class="title">{{__('messages.common.email')}}</div>
                                <div class="description" id="preview_email">{{$card->email}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="icon-wrap position-relative shadow-sm">
                    <a href="tel:{{ $card->phone }}" class="stretched-link">
                        <div class="d-flex flex-row align-items-center">
                            <div class="fa_icon me-3">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="">
                                <div class="title">{{__('messages.common.phone')}}</div>
                                <div class="description" id="preview_phone">{{$card->phone}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                @if(!empty($card->phone_2))
                <div class="icon-wrap position-relative shadow-sm">
                    <a href="tel:{{ $card->phone_2 }}" class="stretched-link">
                        <div class="d-flex flex-row align-items-center">
                            <div class="fa_icon me-3">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="">
                                <div class="title">{{__('messages.order.telephone')}}</div>
                                <div class="description" id="preview_phone_2">{{$card->phone_2}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                <div class="icon-wrap position-relative shadow-sm">
                    <a href="javascript:void(0)" class="stretched-link">
                        <div class="d-flex flex-row align-items-center">
                            <div class="fa_icon me-3">
                                <i class="fas fa-location-dot"></i>
                            </div>
                            <div class="">
                                <div class="title">{{__('messages.common.address')}}</div>
                                <div class="description" id="preview_address">{{$card->location}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                @if(isset($icons->website))
                <div class="icon-wrap position-relative shadow-sm">
                    <a href="{{$icons->website}}" target="_blank" class="stretched-link">
                        <div class="d-flex flex-row align-items-center">
                            <div class="fa_icon me-3">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="">
                                <div class="title">{{__('messages.common.website')}}</div>
                                <div class="description" id="preview_website">{{$icons->website}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @if(isset($icons->website_2))
                <div class="icon-wrap position-relative shadow-sm">
                    <a href="{{$icons->website_2}}" target="_blank" class="stretched-link">
                        <div class="d-flex flex-row align-items-center">
                            <div class="fa_icon me-3">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="">
                                <div class="title">{{__('messages.common.website')}}</div>
                                <div class="description" id="preview_website_2">{{$icons->website_2}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @if(isset($card->paypal_account))
                <div class="icon-wrap position-relative shadow-sm">
                    <a href="javascript:void(0)" class="stretched-link">
                        <div class="d-flex flex-row align-items-center">
                            <div class="fa_icon me-3">
                                <i class="fa-brands fa-paypal"></i>
                            </div>
                            <div class="">
                                <div class="title">{{__('messages.card.paypal')}}</div>
                                <div class="description" id="preview_paypal">{{$card->paypal_account}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                <div class="icon-wrap position-relative shadow-sm">
                    <a href="javascript:void(0)" class="stretched-link" data-bs-toggle="modal"
                        data-bs-target="#exchangeModal">
                        <div class="d-flex flex-row align-items-center">
                            <div class="fa_icon me-3">
                                <i class="fa fa-people-arrows"></i>
                            </div>
                            <div class="">
                                <div class="title">{{__('messages.card.exchange_contact')}}</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="share-profile text-center mb-5">
            <button class="btn btn-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
            aria-controls="offcanvasBottom">
                <i class="fa fa-share"></i>
            </button>
        </div>

        <div class="copyright text-center">
            {{-- <p>{{$setting->site_name}}</p> --}}
            <div class="language mb-3">
                <form method="post" action="{{route('change.card.language')}}">
                    @csrf
                    <select class="form-control form-select" name="locale" style="margin:auto;" onchange="this.form.submit()">
                        @foreach (getAllLanguageWithFullData() as $key => $language)
                            <option value="{{ $language->iso_code }}" {{checkCardLanguageSession() == $language->iso_code ? 'selected' : ''}}>
                                {{ strtoupper($language->name) }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
            <p class="m-0">
                <a href="{{route('login')}}">{{__('messages.card.login_create')}}</a>
            </p>
            <p> <a href="{{route('frontend.privacy-policy')}}">{{__('messages.card.imprint_privacy_policy')}}</a></p>
            <small class="footer"> © {{ date('Y') }} {{$card->self_branding ?? $setting->site_name}} {{__('messages.footer.rights_reserved')}} </small>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="contact_modal modal fade" id="exchangeModal" tabindex="-1" aria-labelledby="exchangeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exchangeModalLabel">{{__('messages.card.exchange_contact')}} </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="connect-form" action="{{route('user.card.query.submit')}}" method="post">
                    @csrf
                    <input type="hidden" name="vcard_id" id="vcard_id" value="{{$card->id}}">
                    <div class="mb-3">
                        <label for="name" class="form-label">{{__('messages.card.full_name')}} <span class="text-danger">*</span></label>
                        <input class="form-control" id="name" name="name" type="text"
                            placeholder="{{__('messages.placeholder.enter_name')}}" required value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{__('messages.card.email_address')}} <span
                                class="text-danger">*</span></label>
                        <input class="form-control" id="email" name="email" type="email"
                            placeholder="{{__('messages.placeholder.enter_email')}}" required value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">{{__('messages.card.phone_number')}} <span
                                class="text-danger">*</span></label>
                        <input class="form-control" id="phone" name="phone" type="tel" required
                            placeholder="{{__('messages.placeholder.enter_phone')}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" value="{{old('phone')}}" value="{{ old('phone') }}">
                    </div>
                    <div class="mb-3">
                        <label for="job_title" class="form-label">{{__('messages.card.job_title')}}</label>
                        <input class="form-control" id="job_title" name="job_title" type="text"
                            placeholder="{{__('messages.placeholder.enter_job_title')}}" value="{{ old('job_title') }}">
                    </div>
                    <div class="mb-3">
                        <label for="company_name" class="form-label">{{__('messages.card.company_name')}}</label>
                        <input class="form-control" id="company_name" name="company_name" type="text"
                            placeholder="{{__('messages.placeholder.enter_company')}}" value="{{ old('company_name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">{{__('messages.common.message')}} <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="message" name="message" style="height:80px;" cols="30" rows="5" placeholder="{{__('messages.placeholder.enter_question')}}" required="">{{ old('message') }}</textarea>
                    </div>
                    <button class="btn btn-dark w-100  contactBtn" type="submit">
                        <span class="btn-txt">{{__('messages.common.submit')}}</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- share  -->
<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small">
        <div class="text-center">
            {{-- <img src="assets/images/qrcode.svg" class="mb-3" width="150" alt=""> --}}
            <div id="qrcode" class="mb-3 qrcode" width="150"></div> <br>
            <a data-bs-toggle="modal" href="#shareModalToggle" role="button" class="btn btn-dark rounded-pill px-5">
                {{__('messages.card.share_profile')}}
            </a>
        </div>
    </div>
</div>

<div class="modal fade" id="shareModalToggle" role="dialog" aria-labelledby="shareModalToggleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="exchangeModalLabel">{{ __('messages.common.share_options') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- ShareThis BEGIN -->
                <div class="sharethis-inline-share-buttons" id="sharethis-inline-share-buttons"></div>
                <!-- ShareThis END -->
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script type='text/javascript'
src='https://platform-api.sharethis.com/js/sharethis.js#property=65b78fd51d58d50012137494&product=inline-share-buttons'
async='async'></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery-qrcode.min.js') }}"></script>
<script>
    document.getElementById('copyLink').addEventListener('click', function() {
        var tempInput = document.createElement('input');
        tempInput.value = window.location.href;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        toastr.success('URL copied to clipboard');
    });

    const qr_text = window.location.href;

    qrparams = {
        render:'image',
        minVersion:3,
        mode: Number(0),
        fill: "#292b2e",
        background: "#ffffff",
        size: 150,
        left: 0,
        text: qr_text,
        top: 0,
        radius: 0.5,
        label:'QR Code',
        quiet: 3,
    };
    $(document).ready(function () {
        $(".qrcode").qrcode(qrparams);
    });

    document.addEventListener('DOMContentLoaded', function() {
        var downloadBtn = document.querySelector('.download-qr');
        downloadBtn.addEventListener('click', function() {
            var currentUrl = window.location.href;

            var qrImageSrc = document.getElementById('qrcode').querySelector('img').src;
            downloadQR(qrImageSrc, 'qr_code.png');
        });

        function downloadQR(url, filename) {
            var link = document.createElement('a');
            link.href = url;
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    });
</script>
<script>
function saveContacts() {
    var name = '{{ ucwords($card->first_name . ' ' . $card->last_name) }}';
    var filename = '{{ strtolower($card->first_name . '-' . $card->last_name) }}';
    var email = '{{ $card->email }}';
    var phone = '{{ $card->phone }}';
    var phone_2 = '{{ $card->phone_2 }}';
    var jobTitle = '{{ $card->job_title }}';
    var company = '{{ $card->company }}';
    var location = '{{ $card->location }}';
    var website = '{{ $icons->website }}';
    var website_2 = '{{ $icons->website_2 }}';
    var card_id = '{{ $card->id }}';
    var profilePicture = '{{ asset($card->profile_image) }}';

    var vCardData = [
        'BEGIN:VCARD',
        'VERSION:3.0',
        'FN:' + name,
        'EMAIL;TYPE=Email:' + email,
        'TEL;TYPE=Mobile:' + phone,
    ];

    if (phone_2) {
        vCardData.push('TEL;TYPE=Telephone:' + phone_2);
    }

    vCardData.push(
        'TITLE:' + jobTitle,
        'ORG:' + company,
        'ADR;TYPE=Address:' + location,
        'URL:' + website
    );

    if (website_2) {
        vCardData.push('URL:' + website_2);
    }

    vCardData.push(
        'PHOTO;VALUE=URL:' + profilePicture,
        'END:VCARD'
    );

    var blob = new Blob([vCardData.join('\n')], {
        type: 'text/vcard;charset=utf-8'
    });
    var link = document.createElement('a');
    link.href = window.URL.createObjectURL(blob);
    link.download = filename + '.vcf';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);

    // Add social links to vCard
    // var socialLinks = [
    //     '{{ $card->social_link1 }}',
    //     '{{ $card->social_link2 }}',
    // ];
    // socialLinks.forEach(function(link, index) {
    //     if (link) {
    //         vCardData.splice(vCardData.length - 1, 0, 'X-SOCIALPROFILE;TYPE=social' + (index + 1) + ':' + link);
    //     }
    // });

    fetch('/update-contact/' + card_id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('contact saved successfully.');
        } else {
            console.log('Failed to save contact.');
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endpush
