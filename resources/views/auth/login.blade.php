<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <base href="../../../"/>
    <title>Login | Faißt</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="shortcut icon" href="{{ asset('public/assets') }}/media/logos/Faibt-logo.png"/>
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('public/assets') }}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/assets') }}/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat"
      style="background: #15731F;">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }</script>
<!--end::Theme mode setup on page load-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Page bg image-->
    {{--    <style>body { background-image: url('{{ asset('public/assets') }}/media/auth/bg6.jpg'); } [data-bs-theme="dark"] body { background-image: url('{{ asset('public/assets') }}/media/auth/bg4-dark.jpg'); }</style>--}}
    <style>
        @media screen and (max-width: 992px) {
            img {
                height: 60px;
                width: 140px;
            }
        }
    </style>

    <!--end::Page bg image-->
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-center w-lg-100 pt-15 pt-lg-0 px-10">
            <!--begin::Aside-->
            <div class="d-flex flex-center flex-column">
                <!--begin::Logo-->
                <a href="../../demo39/dist/index.html" class="mb-7">
                    <img class="logo" alt="Logo" src="{{ asset('public/assets') }}/media/logos/Faibt-logo-1.png"
                         width="180" height="80"/>
                </a>
                <h1 class="fw-normal m-0 text-white">Ihr Schutz ist unsere Priorität!</h1>
                <!--end::Logo-->
                <!--begin::Title-->
                {{--                <h2 class=" fw-normal m-0 text-white">Ihre Vision, unsere Programmierung!</h2>--}}
                <!--end::Title-->
            </div>
            <!--begin::Aside-->
        </div>
        <!--begin::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center p-12 p-lg-20">
            <!--begin::Card-->
            <div class="d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                <!--begin::Wrapper-->
                <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                    <!--begin::Form-->
                    <form class="form w-100" method="POST" action="{{ route('users.login.post') }}">
                        @csrf
                        <!--begin::Heading-->
                        {{--                        <div class="text-center mb-11">--}}
                        {{--                            <!--begin::Title-->--}}
                        {{--                            <h1 class="text-dark fw-bolder mb-3">Sign In</h1>--}}
                        {{--                            <!--end::Title-->--}}
                        {{--                            <!--begin::Subtitle-->--}}
                        {{--                            <div class="text-gray-500 fw-semibold fs-6">Your Social Campaigns</div>--}}
                        {{--                            <!--end::Subtitle=-->--}}
                        {{--                        </div>--}}
                        <!--begin::Heading-->
                        <!--begin::Login options-->
                        <div class="row g-3 mb-9">
                            <!--begin::Col-->
                            <div class="col-md-6">

                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6">
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Login options-->
                        <!--begin::Separator-->
                        <div class="separator separator-content my-14">
                            <span class="w-125px text-gray-500 fw-semibold fs-7">mit Email</span>
                        </div>
                        <!--end::Separator-->
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8 form-floating">
                            <!--begin::Email-->
                            <input type="text" placeholder="Email" name="email" id="floatingInput" autocomplete="off"
                                   class="form-control"/>
                            <label for="floatingInput">Email</label>
                            <!--end::Email-->
                        </div>
                        <!--end::Input group=-->
                        <div class="fv-row mb-3 form-floating position-relative" data-kt-password-meter="true">
                            <input type="password" placeholder="Password" id="floatingInput" name="password"
                                   autocomplete="off"
                                   class="form-control"/>
                            <label for="floatingInput">Password</label>
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                  data-kt-password-meter-control="visibility">
                                    <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span
                                            class="path2"></span><span
                                            class="path3"></span><span class="path4"></span></i>
                                    <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span
                                            class="path2"></span><span
                                            class="path3"></span></i>
                            </span>
                        </div>
                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                            <div></div>
                            <!--begin::Link-->
                            <a href="{{ route("forget.password.get") }}"
                               style="color: #F49738; text-decoration: underline">Passwort vergessen ?</a>
                            <!--end::Link-->
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                            <div></div>
                            <!--begin::Link-->
                            {{--                            <a href="../../demo39/dist/authentication/layouts/creative/reset-password.html" class="link-primary">Forgot Password ?</a>--}}
                            <!--end::Link-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Submit button-->
                        <div class="mb-10" style="text-align: center">
                            <button type="submit" class="btn text-white"
                                    style="background-color: #AAC1A7; padding: 10px 50px 10px 50px; border-radius: 20px;">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">LOGIN</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                        </div>
                        <!--end::Submit button-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->

            </div>
            <!--end::Card-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->
<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('public/assets') }}/plugins/global/plugins.bundle.js"></script>
<script src="{{ asset('public/assets') }}/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('public/assets') }}/js/custom/authentication/sign-in/general.js"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
