@extends('user.layouts.app')

@section('title')
{{ $title ?? 'Venmeo.de' }}
@endsection
@section('card', 'active')

@push('style')
<style>
    .btn-group-sm>.btn, .btn-sm {
        padding: .25rem .5rem !important;
        font-size: .875rem !important;
    }
</style>
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item active">{{$title}}</li>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between aling-item-center">
                    <div>
                        <h4 class="card-title m-0">{{__('messages.card.choose_your_theme')}}</h4>
                    </div>
                    <div>
                        <a href="{{route('user.card.create', ['theme' => '1'])}}" class="btn btn-sm btn-primary btn-gradient" id="applyDesignLink">{{__('messages.card.apply_design')}}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="card_theme card_sec">
                    <div class="row">
                        <div class="col-sm-6 col-lg-4 col-xl-3 mb-3">
                            <label class="form-selectgroup-item flex-fill" for="theme1">
                                <input class="form-input" type="radio" name="theme_id" id="theme1" value="1" checked>
                                <div class="form-selectgroup-label d-flex align-items-center">
                                    <div>
                                        <img src="{{asset('assets/images/theme1.png')}}" class="img-fluid" alt="theme">
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="col-sm-6 col-lg-4 col-xl-3 mb-3">
                            <label class="form-selectgroup-item flex-fill" for="theme2">
                                <input class="form-input" type="radio" name="theme_id" id="theme2" value="2">
                                <div class="form-selectgroup-label d-flex align-items-center">
                                    <div>
                                        <img src="{{asset('assets/images/theme2.png')}}" class="img-fluid" alt="theme">
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
document.querySelectorAll('input[name="theme_id"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        var selectedValue = this.value;
        var applyDesignLink = document.getElementById('applyDesignLink');
        var originalHref = applyDesignLink.getAttribute('href');
        var newHref = originalHref.replace(/theme=\d+/, 'theme=' + selectedValue);
        applyDesignLink.setAttribute('href', newHref);
    });
});

</script>
@endpush
