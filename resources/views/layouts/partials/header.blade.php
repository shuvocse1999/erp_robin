<style>
    @media only screen and (max-width: 600px) {
        .app-navbar {
            flex-grow: 0 !important;
        }
        .header_img {
            display: block !important;
            padding: 0 10px 0 10px;
            background-color: transparent !important;
        }
        #german-time {
            color: #fff;
        }
        #kt_app_header {
            background-color: #2B6123;
        }
    }
</style>
<div id="kt_app_header" class="app-header d-flex flex-column flex-stack">
    <!--begin::Header main-->
    <div class="d-flex flex-stack flex-grow-1">
        <div class="app-header-logo d-flex align-items-center ps-lg-12" id="kt_app_header_logo">
            <!--begin::Sidebar toggle-->
            <div id="kt_app_sidebar_toggle"
                 class="app-sidebar-toggle btn btn-sm btn-icon bg-body btn-color-gray-500 btn-active-color-primary w-30px h-30px ms-n2 me-4 d-none d-lg-flex"
                 data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                 data-kt-toggle-name="app-sidebar-minimize">
                <i class="fas fa-align-left fs-3 mt-1" style="color: #2B6123"></i>
                {{--                <i class="ki-outline ki-abstract-14 fs-3 mt-1"></i> --}}
            </div>

            <!--end::Sidebar toggle-->
            <!--begin::Sidebar mobile toggle-->
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px ms-3 me-2 d-flex d-lg-none"
                 id="kt_app_sidebar_mobile_toggle">
                <i class="fas fa-align-left"></i>
                {{--                <i class="ki-outline ki-abstract-14 fs-2"></i> --}}
            </div>

            {{--            <div class="app-sidebar-header d-flex flex-stack d-none d-lg-flex pt-8 pb-2" id="kt_app_sidebar_header"> --}}
            {{--                <a href="{{ route('admin.dashboard') }}" class="app-sidebar-logo"> --}}
            {{--                    <img alt="Logo" src="{{ asset('public/assets') }}/media/logos/Faibt-logo-1.png" --}}
            {{--                         class="h-40px theme-light-show"/> --}}
            {{--                    <img alt="Logo" src="{{ asset('public/assets') }}/media/logos/Faibt-logo-1.png" --}}
            {{--                         class="h-40px theme-dark-show"/> --}}
            {{--                </a> --}}
            {{--            </div> --}}
            <!--end::Sidebar mobile toggle-->
            <!--begin::Logo-->

            <!--<a href="{{ route('admin.dashboard') }}" class="app-sidebar-logo">-->
            <!--    <img alt="Logo" src="{{ asset('public/assets') }}/media/logos/demo39.png" class="h-40px theme-light-show"/>-->
            <!--    <img alt="Logo" src="{{ asset('public/assets') }}/media/logos/demo39.png" class="h-40px theme-dark-show"/>-->
            <!--</a>-->
            <!--end::Logo-->
            <div style="display: flex; align-self: flex-end;">
                <p id="german-time" style="margin-top: 13px;"></p>
            </div>
        </div>

        <div style="background-color: #000" class="header_img d-none">
            <a href="{{ route('admin.dashboard') }}" class="app-sidebar-logo text-center">
                <img alt="Logo" src="{{ asset('public/assets') }}/media/logos/Faibt-logo-1.png"
                     class="h-40px theme-light-show"/>
                <img alt="Logo" src="{{ asset('public/assets') }}/media/logos/Faibt-logo-1.png"
                     class="h-40px theme-dark-show"/>
            </a>
        </div>
        <!--begin::Navbar-->
        <div class="app-navbar  justify-content-end" id="kt_app_header_navbar">
            <div class="app-navbar-item d-flex align-items-stretch flex-lg-grow-1">

            </div>

            <!--begin::User menu-->
            <div class="app-navbar-item ms-2 ms-lg-6" id="kt_header_user_menu_toggle">
                <!--begin::Menu wrapper-->
                <div class="cursor-pointer symbol symbol-circle symbol-30px symbol-lg-45px"
                     data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                     data-kt-menu-placement="bottom-end">
                    @if (isset(auth()->user()->avatar))
                        <img src="{{ asset('public/avatars/' . auth()->user()->avatar) }}"
                             alt="{{ auth()->user()->name }}"/>
                    @else
                        <img alt="Default" src="{{ asset('public/assets') }}/media/logos/default.jpg"/>
                    @endif
                </div>
                <!--begin::User account menu-->
                <div
                    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                    data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-50px me-5">
                                @if (auth()->user()->avatar)
                                    <img alt="Logo" src="{{ asset('public/avatars/' . auth()->user()->avatar) }}"
                                         alt="{{ auth()->user()->name }}"/>
                                @else
                                    <img alt="Default" src="{{ asset('public/assets') }}/media/logos/default.jpg"/>
                                @endif
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Username-->
                            <div class="d-flex flex-column">
                                <div class="fw-bold d-flex align-items-center fs-5">
                                    {{ @\Illuminate\Support\Facades\Auth::user()->name }}
                                </div>
                                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">
                                    {{ @\Illuminate\Support\Facades\Auth::user()->email }}</a>
                            </div>
                            <!--end::Username-->
                        </div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <a href="{{ route('admin.profile') }}" class="menu-link px-5">Mein Profil</a>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    {{--                    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" --}}
                    {{--                         data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0"> --}}
                    {{--                        <a href="#" class="menu-link px-5"> --}}
                    {{--											<span class="menu-title position-relative">Mode --}}
                    {{--											<span class="ms-5 position-absolute translate-middle-y top-50 end-0"> --}}
                    {{--												<i class="ki-outline ki-night-day theme-light-show fs-2"></i> --}}
                    {{--												<i class="ki-outline ki-moon theme-dark-show fs-2"></i> --}}
                    {{--											</span></span> --}}
                    {{--                        </a> --}}
                    {{--                        <!--begin::Menu--> --}}
                    {{--                        <div --}}
                    {{--                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" --}}
                    {{--                            data-kt-menu="true" data-kt-element="theme-mode-menu"> --}}
                    {{--                            <!--begin::Menu item--> --}}
                    {{--                            <div class="menu-item px-3 my-0"> --}}
                    {{--                                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light"> --}}
                    {{--													<span class="menu-icon" data-kt-element="icon"> --}}
                    {{--														<i class="ki-outline ki-night-day fs-2"></i> --}}
                    {{--													</span> --}}
                    {{--                                    <span class="menu-title">Light</span> --}}
                    {{--                                </a> --}}
                    {{--                            </div> --}}
                    {{--                            <!--end::Menu item--> --}}
                    {{--                            <!--begin::Menu item--> --}}
                    {{--                            <div class="menu-item px-3 my-0"> --}}
                    {{--                                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark"> --}}
                    {{--													<span class="menu-icon" data-kt-element="icon"> --}}
                    {{--														<i class="ki-outline ki-moon fs-2"></i> --}}
                    {{--													</span> --}}
                    {{--                                    <span class="menu-title">Dark</span> --}}
                    {{--                                </a> --}}
                    {{--                            </div> --}}
                    {{--                            <!--end::Menu item--> --}}
                    {{--                            <!--begin::Menu item--> --}}
                    {{--                            <div class="menu-item px-3 my-0"> --}}

                    {{--                            </div> --}}
                    {{--                            <!--end::Menu item--> --}}
                    {{--                        </div> --}}
                    {{--                        <!--end::Menu--> --}}
                    {{--                    </div> --}}
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <a class="menu-link px-5" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Ausloggen') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::User account menu-->
                <!--end::Menu wrapper-->
            </div>
            <!--end::User menu-->
            <!--begin::Action-->
            <div class="app-navbar-item ms-2 ms-lg-6 me-lg-6">
                {{--                <!--begin::Link--> --}}
                {{--                <a href="../../demo39/dist/authentication/layouts/corporate/sign-in.html" class="btn btn-icon btn-custom btn-color-gray-600 btn-active-color-primary w-35px h-35px w-md-40px h-md-40px"> --}}
                {{--                    <i class="ki-outline ki-exit-right fs-1"></i> --}}
                {{--                </a> --}}
                {{--                <!--end::Link--> --}}
            </div>
            <!--end::Action-->
            <!--begin::Header menu toggle-->
            {{--            <div class="app-navbar-item ms-2 ms-lg-6 ms-n2 me-3 d-flex d-lg-none"> --}}
            {{--                <div class="btn btn-icon btn-custom btn-color-gray-600 btn-active-color-primary w-35px h-35px w-md-40px h-md-40px" id="kt_app_aside_mobile_toggle"> --}}
            {{--                    <i class="ki-outline ki-burger-menu-2 fs-2"></i> --}}
            {{--                </div> --}}
            {{--            </div> --}}
            <!--end::Header menu toggle-->
        </div>
        <!--end::Navbar-->
    </div>
    <!--end::Header main-->
    <!--begin::Separator-->
    <div class="app-header-separator"></div>
    <!--end::Separator-->
</div>

<script>
    function updateGermanTime() {
        const now = new Date();
        const options = {timeZone: 'Europe/Berlin'};

        // Format date and time separately and concatenate them with '||'
        const formattedDate = now.toLocaleString('de-DE', {
            ...options,
            day: '2-digit',
            month: '2-digit',
            year: '2-digit',
        });
        const formattedTime = now.toLocaleString('de-DE', {
            ...options,
            hour: '2-digit',
            minute: '2-digit',
        });
        const formattedDateTime = formattedDate + ' | ' + formattedTime;
        document.getElementById('german-time').textContent = formattedDateTime;
    }

    updateGermanTime();
    setInterval(updateGermanTime, 1000);
</script>



