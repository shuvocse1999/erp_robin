@extends('layouts.user.master')
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
                                <a href="{{ route('user.dashboard') }}" class="text-muted text-hover-primary">Home</a>
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
                        <a class="btn btn-light-primary mt-3 mt-md-8" href="{{ route('user.dashboard') }}"> Back</a>
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
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <!--begin::User-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Name-->
                                        <div class="d-flex align-items-center mb-2">
                                            <span
                                                class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ \Illuminate\Support\Facades\Auth::user()->vorname }} {{ \Illuminate\Support\Facades\Auth::user()->nachname }}</span>
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

                                        </div>
                                        <!--end::Stats-->
                                    </div>
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
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{Request::is('user/my-profile*') ?'active':''}}"
                                   href="{{ route('user.profile') }}">Overview</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{Request::is('user/edit-profile*') ?'active':''}}"
                                   href="{{ route('user.profile.edit') }}">Settings</a>
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
                        <form method="post" action="{{ route('user.profile.update') }}" id="kt_account_profile_details_form"
                              class="form" enctype="multipart/form-data">
                            @csrf
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Firmenname</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="firmenname"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="Firmenname" value="{{ $admin->firmenname }}"/>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Standort</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="standort"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="Standort" value="{{ $admin->standort }}"/>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Abteilung</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="abteilung"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="Abteilung" value="{{ $admin->abteilung }}"/>
                                    </div>
                                </div>


                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Vorname</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="vorname"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="Vorname" value="{{ $admin->vorname }}"/>
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nachname</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="nachname"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="Nachname" value="{{ $admin->nachname }}"/>
                                    </div>
                                </div>

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

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Strasse</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="strasse"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="Strasse" value="{{ $admin->strasse }}"/>
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Hausnr.</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="hasunr"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="Hausnr." value="{{ $admin->hasunr }}"/>
                                    </div>
                                </div>


                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">PLZ</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="plz"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="PLZ" value="{{ $admin->plz }}"/>
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Wohnort</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="wohnort"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="Wohnort" value="{{ $admin->wohnort }}"/>
                                    </div>
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
                                    <form method="POST" action="{{ route('user.profile.update-password') }}" id="kt_signin_change_password" class="form" novalidate="novalidate">
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
                                                    <span>Password contain one capital letter, one small letter, one special character, one number and a minimum of 8 characters</span>
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
