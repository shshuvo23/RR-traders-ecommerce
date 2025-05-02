@extends('user.layouts.app')

@section('title')
{{ $data['title'] ?? 'Venmeo.de' }}
@endsection
@section('setting', 'active')

@push('style')
<style>
    span.input-group-text {
        border-top-left-radius: 0px !important;
        border-bottom-left-radius: 0px !important;
    }
    .profile-user-img {
        height: 100px;
        object-fit: cover;
    }
</style>
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item active">{{__('messages.common.settings')}}</li>
@endsection

@section('content')
    <!-- ======================= Setting start  ============================ -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex aling-item-center justify-content-between">
                                <div>
                                    <h4 class="card-title">{{__('messages.user_profile.profile_update')}}</h4>
                                </div>
                                <div>
                                    <a href="{{route('user.profile')}}" class="btn btn-primary text-right btn-gradient">{{__('messages.common.profile')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('user.profile.update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{getProfile($user->image)}}" alt="{{$user->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">{{__('messages.user_profile.profile_image')}} 
                                        <br><small class="text-info fw-bold"><strong>({{__('messages.settings_home_content.recommended_size')}} 150x150px)</strong></small>
                                    </label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">{{__('messages.common.name')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{$user->name ?? old('name')}}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">{{__('messages.common.email')}} <span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="{{$user->email ?? old('email')}}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">{{__('messages.common.phone')}} <span class="text-danger">*</span></label>
                                    <input type="tel" name="phone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        value="{{$user->phone ?? old('phone')}}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">{{__('messages.common.address')}} <span class="text-danger">*</span></label>
                                    <textarea name="address" class="form-control" required>{{$user->address ?? old('address')}}</textarea>
                                </div>
                                 <button type="submit" class="btn btn-success">{{__('messages.common.submit')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('messages.user_profile.change_password')}}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('user.password.update')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="" class="form-label">{{__('messages.user_profile.new_password')}} <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-flat">
                                        <input type="password" name="newpassword" id="password-field" value="" class="form-control" required>
                                        <span class="input-group-text px-3">
                                            <a href="javascript:void(0)"
                                                class="link-secondary fa fa-fw fa-eye field-icon toggle-password"
                                                toggle="#password-field">
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">{{__('messages.user_profile.confirm_password')}} <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-flat">
                                        <input type="password" name="confirm_password" id="confirm_password" value="" class="form-control" required>
                                        <span class="input-group-text px-3">
                                            <a href="javascript:void(0)"
                                                class="link-secondary fa fa-fw fa-eye field-icon confirm-toggle-password"
                                                toggle="#confirm_password">
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                 <button type="submit" class="btn btn-success">{{__('messages.user_profile.change_password')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ======================= Setting end  ============================ -->
@endsection

@push('script')
<script>
    $(document).ready(function () {

        // password show hide
        $(".toggle-password").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $(".confirm-toggle-password").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

    })
</script>
@endpush
