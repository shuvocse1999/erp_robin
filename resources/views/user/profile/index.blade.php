@extends('layouts.user.master')
@section('content')
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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Account Overview</h1>
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
                            <li class="breadcrumb-item text-muted">Account</li>
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
                                            <span class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ \Illuminate\Support\Facades\Auth::user()->vorname }} {{ \Illuminate\Support\Facades\Auth::user()->nachname }}</span>
                                            <small>
                                                <i class="ki-outline ki-verify fs-1 text-primary"></i>
                                            </small>
                                        </div>
                                        <!--end::Name-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                            <span class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                                <i class="ki-outline ki-sms fs-4 me-1"></i>{{ \Illuminate\Support\Facades\Auth::user()->email }}</span>
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
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{Request::is('user/my-profile*') ?'active':''}}" href="{{ route('user.profile') }}">Overview</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{Request::is('user/edit-profile*') ?'active':''}}" href="{{ route('user.profile.edit') }}">Settings</a>
                            </li>
                            <!--end::Nav item-->

                        </ul>
                        <!--begin::Navs-->
                    </div>
                </div>
                <!--end::Navbar-->
                <!--begin::details View-->
                <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                    <!--begin::Card header-->
                    <div class="card-header cursor-pointer">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Profile Details</h3>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Action-->
                        <a href="{{ route('user.profile.edit') }}" class="btn btn-light-primary mt-3 mt-md-8">Edit Profile</a>
                        <!--end::Action-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body p-9">
                        <!--begin::Row-->
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Vorname</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{ $admin->vorname }}</span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Nachname</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{ $admin->nachname }}</span>
                            </div>
                        </div>
                        <!--end::Row-->
                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-semibold text-muted">Email</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <span class="fw-semibold text-gray-800 fs-6">{{ $admin->email }}</span>
                            </div>
                            <!--end::Col-->
                        </div>


                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Strasse</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{ $admin->strasse }}</span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Hausnr.</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{ $admin->hasunr }}</span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">PLZ</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{ $admin->plz }}</span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Wohnort</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{ $admin->wohnort }}</span>
                            </div>
                        </div>


                        <!--end::Input group-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::details View-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
@endsection
