@extends('admin.layouts.master')

@section('seo', 'active')
@section('title') {{ $data['title'] ?? '' }} @endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$data['title']}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{__('messages.common.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{$data['title']}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h3 class="card-title">{{__('messages.common.edit')}} - {{ $data['seo']->page_slug }}</h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">
                                            <a href="{{ route('admin.seo.index') }}" class="btn btn-primary btn-sm">{{__('messages.common.back')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.seo.update', $data['seo']->page_slug) }}" class="form-horizontal"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="" class="form-label">{{__('messages.seo.meta_title')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ $data['seo']->title }}" id="inputName"
                                            placeholder="{{__('messages.seo.meta_title')}}" required>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="form-label">{{__('messages.seo.meta_keywords')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="keywords" id="meta_keyword"
                                            value="{{ old('keywords', $data['seo']->keywords) }}" class="form-control"
                                            placeholder="{{__('messages.seo.meta_keywords')}}" required>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="form-label">{{__('messages.seo.meta_desc')}} <span class="text-danger">*</span></label>
                                        <textarea class="form-control" cols="4" rows="4" name="description"
                                            id="description" placeholder="{{__('messages.seo.meta_desc')}}" required>{{ $data['seo']->description }}</textarea>
                                    </div>
                                    @if(!empty($data['seo']->image))
                                    <div class="form-group row">
                                        <img width="15%" class="px-1" src="{{ asset($data['seo']->image) }}" alt="image">
                                    </div>
                                    @endif
                                    <div class="form-group row">
                                        <label for="" class="form-label">{{__('messages.seo.meta_image')}}
                                            <br><small class="text-info fw-bold"><strong>({{__('messages.settings_home_content.recommended_size')}} 1200X630px)</strong></small>
                                        </label>
                                        <input type="file" data-default-file="{{ asset($data['seo']->image) }}"
                                            class="form-control dropify" name="image" id="image">
                                    </div>
                                    <div class="row">
                                        <div class="col px-0">
                                            <button type="submit" class="btn btn-info">{{__('messages.common.update')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).on('click', '.view', function() {
        let cat_id = $(this).data('id');
        $.get('seo/'+cat_id+'/view', function(data) {
            console.log(data);
            $('#viewSeoModal').modal('show');
            $('#modal_body').html(data);
        });
    });
</script>
@endpush
