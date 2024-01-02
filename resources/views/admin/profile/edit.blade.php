@extends('layouts.master')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-6 pb-2">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <!--begin::Toolbar wrapper-->
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                            Account Overview</h1>
                        <!--end::Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">My Profile</li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Edit Profile</li>
                            <!--end::Item-->
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <div class="float-end">
                        <a class="btn btn-light-primary mt-3 mt-md-8" href="{{ route('admin.dashboard') }}"> Back</a>
                    </div>
                    <!--end::Page title-->

                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Navbar-->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">
                        <!--begin::Details-->
                        <div class="d-flex flex-wrap flex-sm-nowrap">
                            <!--begin: Pic-->
                            <div class="me-7 mb-4">
                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                    @if(isset($admin->avatar))
                                        <img
                                            src="{{ asset('public/avatars/' . $admin->avatar) }}"
                                            alt="image"/>
                                    @else
                                        <img src="{{ asset('public/assets') }}/media/avatars/blank.png" alt="image"/>
                                    @endif
                                    <div
                                        class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                                </div>
                            </div>
                            <!--end::Pic-->
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <!--begin::User-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Name-->
                                        <div class="d-flex align-items-center mb-2">
                                            <span
                                                class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span>
                                            <small>
                                                <i class="ki-outline ki-verify fs-1 text-primary"></i>
                                            </small>
                                        </div>
                                        <!--end::Name-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
{{--                                            <span--}}
{{--                                                class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">--}}
{{--                                                <i class="ki-outline ki-profile-circle fs-4 me-1"></i>@if(!empty($admin->getRoleNames()))--}}
{{--                                                    @foreach($admin->getRoleNames() as $v)--}}
{{--                                                        <label class="badge badge-success" style="margin-right: 5px">{{ $v }}</label>--}}
{{--                                                    @endforeach--}}
{{--                                                @endif</span>--}}
                                            <span
                                                class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                                <i class="ki-outline ki-sms fs-4 me-1"></i>{{ \Illuminate\Support\Facades\Auth::user()->email }}
                                            </span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Title-->
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap flex-stack">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column flex-grow-1 pe-8">
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap">
                                            <!--begin::Stat-->
                                            {{--                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">--}}
                                            {{--                                                <!--begin::Number-->--}}
                                            {{--                                                <div class="d-flex align-items-center">--}}
                                            {{--                                                    <i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i>--}}
                                            {{--                                                    <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="4500" data-kt-countup-prefix="$">0</div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                                <!--end::Number-->--}}
                                            {{--                                                <!--begin::Label-->--}}
                                            {{--                                                <div class="fw-semibold fs-6 text-gray-400">Earnings</div>--}}
                                            {{--                                                <!--end::Label-->--}}
                                            {{--                                            </div>--}}
                                            <!--end::Stat-->
                                            <!--begin::Stat-->
                                            {{--                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">--}}
                                            {{--                                                <!--begin::Number-->--}}
                                            {{--                                                <div class="d-flex align-items-center">--}}
                                            {{--                                                    <i class="ki-outline ki-arrow-down fs-3 text-danger me-2"></i>--}}
                                            {{--                                                    <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="80">0</div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                                <!--end::Number-->--}}
                                            {{--                                                <!--begin::Label-->--}}
                                            {{--                                                <div class="fw-semibold fs-6 text-gray-400">Projects</div>--}}
                                            {{--                                                <!--end::Label-->--}}
                                            {{--                                            </div>--}}
                                            <!--end::Stat-->
                                            <!--begin::Stat-->
                                            {{--                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">--}}
                                            {{--                                                <!--begin::Number-->--}}
                                            {{--                                                <div class="d-flex align-items-center">--}}
                                            {{--                                                    <i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i>--}}
                                            {{--                                                    <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="60" data-kt-countup-prefix="%">0</div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                                <!--end::Number-->--}}
                                            {{--                                                <!--begin::Label-->--}}
                                            {{--                                                <div class="fw-semibold fs-6 text-gray-400">Success Rate</div>--}}
                                            {{--                                                <!--end::Label-->--}}
                                            {{--                                            </div>--}}
                                            <!--end::Stat-->
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Progress-->
                                    {{--                                    <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">--}}
                                    {{--                                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">--}}
                                    {{--                                            <span class="fw-semibold fs-6 text-gray-400">Profile Compleation</span>--}}
                                    {{--                                            <span class="fw-bold fs-6">50%</span>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="h-5px mx-3 w-100 bg-light mb-3">--}}
                                    {{--                                            <div class="bg-success rounded h-5px" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    <!--end::Progress-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Details-->
                        <!--begin::Navs-->
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{Request::is('admin/my-profile*') ?'active':''}}"
                                   href="{{ route('admin.profile') }}">Overview</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{Request::is('admin/edit-profile*') ?'active':''}}"
                                   href="{{ route('admin.profile.edit') }}">Settings</a>
                            </li>
                            <!--end::Nav item-->

                        </ul>
                        <!--begin::Navs-->
                    </div>
                </div>
                <!--end::Navbar-->
                <!--begin::Basic info-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                         data-bs-target="#kt_account_profile_details" aria-expanded="true"
                         aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Edit Profile</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        <form method="post" action="{{ route('admin.profile.update') }}" id="kt_account_profile_details_form"
                              class="form" enctype="multipart/form-data">
                            @csrf
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                             style="background-image: url('{{ asset('public/assets') }}/media/avatars/blank.png')">
                                            <!--begin::Preview existing avatar-->
                                            @if(isset($admin->avatar))
                                                <div class="image-input-wrapper w-125px h-125px"
                                                     style="background-image: url('{{ asset('public/avatars/' . $admin->avatar) }}')"></div>
                                            @else
                                                <div class="image-input-wrapper w-125px h-125px"
                                                     style="background-image: url('{{ asset('public/assets') }}/media/avatars/blank.png')"></div>
                                            @endif
                                            <!--end::Preview existing avatar-->
                                            <!--begin::Label-->
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="Change avatar">
                                                <i class="ki-outline ki-pencil fs-7"></i>
                                                <!--begin::Inputs-->
                                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg"/>
                                                <input type="hidden" name="avatar_remove"/>
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Cancel-->
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                title="Cancel avatar">
																	<i class="ki-outline ki-cross fs-2"></i>
																</span>
                                            <!--end::Cancel-->
                                            <!--begin::Remove-->
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                title="Remove avatar">
																	<i class="ki-outline ki-cross fs-2"></i>
																</span>
                                            <!--end::Remove-->
                                        </div>
                                        <!--end::Image input-->
                                        <!--begin::Hint-->
                                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                        <!--end::Hint-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Full Name</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="name"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="Full name" value="{{ $admin->name }}"/>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Email</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="email"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="Email" value="{{ $admin->email }}"/>
                                    </div>
                                    <!--end::Col-->
                                </div>

                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                {{--                                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>--}}
                                <button type="submit" class="btn btn-light-primary mt-3 mt-md-8" id="kt_account_profile_details_submit">
                                    Save Changes
                                </button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Basic info-->
                <!--begin::Sign-in Method-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                         data-bs-target="#kt_account_signin_method">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Sign-in Method</h3>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_signin_method" class="collapse show">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <div class="d-flex flex-wrap align-items-center mb-10">
                                <!--begin::Label-->
                                <div id="kt_signin_password">
                                    <div class="fs-6 fw-bold mb-1">Password</div>
                                    <div class="fw-semibold text-gray-600">************</div>
                                </div>
                                <!--end::Label-->
                                <!--begin::Edit-->
                                <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                    <!--begin::Form-->
                                    <form method="POST" action="{{ route('admin.profile.update-password') }}" id="kt_signin_change_password" class="form" novalidate="novalidate">
                                        @csrf
                                        <div class="row mb-1">
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="currentpassword" class="form-label fs-6 fw-bold mb-3">Current
                                                        Password</label>
                                                    <input type="password"
                                                           class="form-control form-control-lg form-control-solid"
                                                           name="currentpassword" id="currentpassword"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="newpassword" class="form-label fs-6 fw-bold mb-3">New
                                                        Password</label>
                                                    <input type="password"
                                                           class="form-control form-control-lg form-control-solid"
                                                           name="newpassword" id="newpassword"/>
                                                    <span>Password contain one Capital letter, one small letter, one special character, one number and a minimum of 8 characters</span>
                                                    @error('newpassword')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="confirmpassword" class="form-label fs-6 fw-bold mb-3">Confirm
                                                        New Password</label>
                                                    <input type="password"
                                                           class="form-control form-control-lg form-control-solid"
                                                           name="confirmpassword" id="confirmpassword"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-text mb-5">Password must be at least 8 character and contain
                                            symbols
                                        </div>
                                        <div class="d-flex">
                                            <button id="kt_password_submit" type="submit"
                                                    class="btn btn-light-primary me-2 px-6">Update Password
                                            </button>
                                            <button id="kt_password_cancel" type="button"
                                                    class="btn btn-color-gray-400 btn-active-light-primary px-6">Cancel
                                            </button>
                                        </div>
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Edit-->
                                <!--begin::Action-->
                                <div id="kt_signin_password_button" class="ms-auto">
                                    <button class="btn btn-light btn-active-light-primary">Reset Password</button>
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Password-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Sign-in Method-->

            </div>
            <!--end::Content container-->

        </div>
        <!--end::Content-->


    </div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        $('#kt_signin_password_button').on('click', function() {
            $('#kt_signin_password_edit').removeClass('d-none');
            $('#kt_signin_password').addClass('d-none');
            $('#kt_signin_password_button').addClass('d-none');
        });



        $('#kt_password_cancel').on('click', function() {
            $('#kt_signin_password_edit').addClass('d-none');
            $('#kt_signin_password').removeClass('d-none');
            $('#kt_signin_password_button').removeClass('d-none');
        });
    });


</script>
