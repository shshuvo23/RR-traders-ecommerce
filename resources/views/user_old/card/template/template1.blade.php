<link rel="stylesheet" href="{{asset('assets/css/theme1.css')}}?v=1">
<style>
    .template {
        height: 700px;
        overflow: hidden;
        overflow-y: auto;
        max-width: 360px;
        border-radius: 20px;
        box-shadow: 0px 24px 60px rgb(0 0 0 / 10%);
        border: 4px solid #E0E0E0;
    }

    .template::-webkit-scrollbar {
        width: 0;
        height: 0
    }

    .template .social_list .icon svg {
        width: 19px;
        background: transparent !important;
    }

    .template .social_list .icon {
        font-size: 38px;
        width: 70px;
        height: 70px;
    }

    .template .icon-wrap .fa_icon {
        font-size: 22px;
    }

    .template .profile_info h2 {
        font-size: 20px;
    }

    .template .profile_info h4 {
        font-size: 16px;
    }

    .template .btn {
        font-size: 14px;
    }
</style>
<div class="template mb-3">
    <div class="banner mb-4 position-relative" style="background-image: url('{{asset($card->cover_image ?? 'assets/images/temmplate-bg2.jpg')}}');">
        <div class="user_pic" id="preview_profile">
            <img src="{{asset($card->profile_image ?? 'assets/images/avatar.png')}}" width="120" class="rounded-pill img-fluid" alt="Profile Image">
        </div>
    </div>

    <div class="px-4 pt-4 pb-2">
        <div class="profile_info mt-5 text-center">
            <h2 id="preview_name">{{$card->first_name ?? 'Anneliese'}}&nbsp;{{$card->last_name ?? ''}}</h2>
            <h4><span id="preview_designation">{{$card->job_title ?? 'UI/UX Designer'}}</span>  <span id="preview_company">{{$card->company ?? 'Venmeo.de'}}</span></h4>
            <h4 id="preview_address">{{$card->location ?? 'Hammerstatt 3, 91637 Wörnitz'}}</h4>
        </div>
        <div class="social_list mt-5 mb-5">
            <div class="row row-cols-3 row-cols-sm-4 gy-4">
                <div class="col mb-4">
                    <div class="content text-center">
                        <a href="javascript:void(0)">
                            <div class="icon">
                                <i class="fa fa-link"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col mb-4 icon-wrapper" data-icon="website">
                    <div class="content text-center">
                        <a href="javascript:void(0)">
                            <div class="icon">
                                <i class="fa fa-globe"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col mb-4 icon-wrapper" data-icon="website_2">
                    <div class="content text-center">
                        <a href="javascript:void(0)">
                            <div class="icon">
                                <i class="fa fa-globe"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col mb-4 icon-wrapper" data-icon="facebook">
                    <div class="content text-center">
                        <a href="javascript:void(0)">
                            <div class="icon facebook">
                                <i class="fab fa-facebook"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col mb-4 icon-wrapper" data-icon="twitter">
                    <div class="content text-center">
                        <a href="javascript:void(0)">
                            <div class="icon twitter">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15"
                                    height="15" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-brand-x">
                                    <path stroke="none" d="M0 0h24v24H0z"
                                        fill="none" />
                                    <path d="M4 4l11.733 16h4.267l-11.733 -16z" />
                                    <path
                                        d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col mb-4 icon-wrapper" data-icon="linkedin">
                    <div class="content text-center">
                        <a href="javascript:void(0)">
                            <div class="icon linkedin">
                                <i class="fab fa-linkedin"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col mb-4 icon-wrapper" data-icon="whatsapp">
                    <div class="content text-center">
                        <a href="javascript:void(0)">
                            <div class="icon whatsapp">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col mb-4 icon-wrapper" data-icon="pinterest">
                    <div class="content text-center">
                        <a href="javascript:void(0)">
                            <div class="icon pinterest">
                                <i class="fab fa-pinterest"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col mb-4 icon-wrapper" data-icon="instagram">
                    <div class="content text-center">
                        <a href="javascript:void(0)">
                            <div class="icon instagram">
                                <i class="fab fa-instagram"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col mb-4 icon-wrapper" data-icon="calendly">
                    <div class="content text-center">
                        <a href="javascript:void(0)">
                            <div class="icon" style="background-color : #0ae1e854">
                                <img src="{{asset('assets/images/calendly.svg')}}" alt="calendly" height="40px">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col mb-4 icon-wrapper" data-icon="spotify">
                    <div class="content text-center">
                        <a href="javascript:void(0)">
                            <div class="icon spotify">
                                <i class="fab fa-spotify"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col mb-4 icon-wrapper" data-icon="twitch">
                    <div class="content text-center">
                        <a href="javascript:void(0)">
                            <div class="icon twitch">
                                <i class="fab fa-twitch"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col mb-4 icon-wrapper" data-icon="xing">
                    <div class="content text-center">
                        <a href="javascript:void(0)">
                            <div class="icon xing">
                                <i class="fab fa-xing"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col mb-4 icon-wrapper" data-icon="telegram">
                    <div class="content text-center">
                        <a href="javascript:void(0)">
                            <div class="icon telegram">
                                <i class="fab fa-telegram"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="save_contact mt-4 mb-4 text-center">
                <a href="javascript:void(0)" class="btn btn-dark text-white  rounded-pill w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
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
                            <div class="fa_icon mr-3">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="">
                                <div class="title">{{__('messages.common.company')}}</div>
                                <div class="description" id="preview_company">{{$card->company ?? 'Venmeo.de'}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="icon-wrap position-relative shadow-sm">
                    <a href="javascript:void(0)" class="stretched-link">
                        <div class="d-flex flex-row align-items-center">
                            <div class="fa_icon mr-3">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="">
                                <div class="title">{{__('messages.common.email')}}</div>
                                <div class="description" id="preview_email">{{$card->email ?? 'info@gmail.com'}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="icon-wrap position-relative shadow-sm">
                    <a href="javascript:void(0)" class="stretched-link">
                        <div class="d-flex flex-row align-items-center">
                            <div class="fa_icon mr-3">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="">
                                <div class="title">{{__('messages.common.phone')}}</div>
                                <div class="description" id="preview_phone">{{$card->phone ?? '+4998683819705'}}</div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="icon-wrap position-relative shadow-sm">
                    <a href="javascript:void(0)" class="stretched-link">
                        <div class="d-flex flex-row align-items-center">
                            <div class="fa_icon mr-3">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="">
                                <div class="title">{{__('messages.order.telephone')}}</div>
                                <div class="description" id="preview_phone_2">{{$card->phone_2 ?? '+4998683819705'}}</div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="icon-wrap position-relative shadow-sm">
                    <a href="javascript:void(0)" class="stretched-link">
                        <div class="d-flex flex-row align-items-center">
                            <div class="fa_icon mr-3">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="">
                                <div class="title">{{__('messages.common.website')}}</div>
                                <div class="description" id="preview_website">{{$card->icons->website ?? 'https://www.venmeo.de'}}</div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="icon-wrap position-relative shadow-sm">
                    <a href="javascript:void(0)" class="stretched-link">
                        <div class="d-flex flex-row align-items-center">
                            <div class="fa_icon mr-3">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="">
                                <div class="title">{{__('messages.common.website')}}</div>
                                <div class="description" id="preview_website_2">{{$card->icons->website_2 ?? 'https://www.venmeo.de'}}</div>
                            </div>
                        </div>
                    </a>
                </div>

                @if(isset($card) && !empty($card->icons->paypal))
                <div class="icon-wrap position-relative shadow-sm">
                    <a href="javascript:void(0)" class="stretched-link">
                        <div class="d-flex flex-row align-items-center">
                            <div class="fa_icon mr-3">
                                <i class="fa-brands fa-paypal"></i>
                            </div>
                            <div class="">
                                <div class="title">{{__('messages.card.paypal')}}</div>
                                <div class="description" id="preview_paypal">{{$card->paypal ?? 'https://www.paypal.com'}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                @elseif(!isset($card))
                <div class="icon-wrap position-relative shadow-sm">
                    <a href="javascript:void(0)" class="stretched-link">
                        <div class="d-flex flex-row align-items-center">
                            <div class="fa_icon mr-3">
                                <i class="fa-brands fa-paypal"></i>
                            </div>
                            <div class="">
                                <div class="title">{{__('messages.card.paypal')}}</div>
                                <div class="description" id="preview_paypal">https://www.paypal.com</div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                <div class="icon-wrap position-relative shadow-sm">
                    <a href="javascript:void(0)" class="stretched-link"
                        data-bs-toggle="modal" data-bs-target="#exchangeModal">
                        <div class="d-flex flex-row align-items-center">
                            <div class="fa_icon mr-3">
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
            {{-- <p>venmeo.de</p> --}}
            <div class="language mb-3">
                <form method="get" action="javascript:void(0)">
                    <select class="form-control form-select" name="locale" style="margin:auto;">
                        @foreach (getAllLanguageWithFullData() as $key => $language)
                        <option value="{{ $language->iso_code }}" {{geDefaultLanguage()->iso_code == $language->iso_code ? 'selected' : ''}}>
                            {{ strtoupper($language->name) }}
                        </option>
                        @endforeach
                    </select>
                </form>
            </div>
            <p class="m-0">
                <a href="javascript:void(0)">{{__('messages.card.login_create')}}</a>
            </p>
            <p> <a href="javascript:void(0)">{{__('messages.card.imprint_privacy_policy')}}</a></p>
            <small class="footer"> © {{ date('Y') }} <span id="preview_branding">{{$card->self_branding ?? 'venmeo.de'}}</span> {{__('messages.footer.rights_reserved')}} </small>
        </div>
    </div>
</div>
