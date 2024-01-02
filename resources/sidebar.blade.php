<style>
    .menu-title {
        color: #fff;
    }
</style>
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px"
     data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle"
     style="background-color: #2B6123">
    <!--begin::Wrapper-->
    <div id="kt_app_sidebar_wrapper" class="app-sidebar-wrapper hover-scroll-y my-5 my-lg-2" data-kt-scroll="true"
         data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
         data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_sidebar_wrapper"
         data-kt-scroll-offset="5px">
        <!--begin::Sidebar menu-->
        <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
             class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-6 mb-5">
            <!--begin:Menu item-->
            <div class="app-sidebar-header d-flex flex-stack d-none d-lg-flex pt-8 pb-2" id="kt_app_sidebar_header">
                <a href="{{ route('admin.dashboard') }}" class="app-sidebar-logo">
                    <img alt="Logo" src="{{ asset('public/assets') }}/media/logos/Faibt-logo-1.png"
                         class="h-40px theme-light-show"/>
                    <img alt="Logo" src="{{ asset('public/assets') }}/media/logos/Faibt-logo-1.png"
                         class="h-40px theme-dark-show"/>
                </a>
            </div>

            <div class="menu-item">
                <!--begin:Menu link-->
                <a @class(['menu-link','active' => Request::is('admin/dashboard*')]) href="{{ url("admin/dashboard") }}">
                                <span class="menu-icon">
                                   <i class="ki-duotone ki-home fs-2"></i>
                                </span>
                    <span class="menu-title {{ Request::is('admin/dashboard*') ? '' : 'text-white' }}">Dashboard</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a @class(['menu-link','active' => Request::is('admin/manage-user*')]) href="{{ url("admin/manage-user") }}">
                                <span class="menu-icon">
                                    <i class="fas fa-user" style="font-size: 18px"></i>
                                </span>
                    <span class="menu-title {{ Request::is('admin/manage-user*') ? '' : 'text-white' }}">Benutzer</span>
                </a>
                <!--end:Menu link-->
            </div>

            <div class="menu-item">
                <!--begin:Menu link-->
                <a @class(['menu-link','active' => Request::is('admin/kunden*')]) href="{{ url("admin/kunden") }}">
                    <span class="menu-icon">
                    <i class="fa fa-users" style="font-size: 18px" aria-hidden="true"></i>
                        </span>
                    <span class="menu-title {{ Request::is('admin/kunden*') ? '' : 'text-white' }}">Kunde</span>
                </a>
                <!--end:Menu link-->
            </div>

            <div class="menu-item">
                <!--begin:Menu link-->
                <a @class(['menu-link','active' => Request::is('admin/formular*')]) href="{{ url("admin/formular") }}">
                                <span class="menu-icon">
                                    <i class="fa fa-table" style="font-size: 18px" aria-hidden="true"></i>
                                </span>
                    <span class="menu-title {{ Request::is('admin/formular*') ? '' : 'text-white' }}">Formulare</span>
                </a>
                <!--end:Menu link-->
            </div>
            <div class="menu-item">
                <!--begin:Menu link-->
                <a @class(['menu-link','active' => Request::is('admin/submissions*')]) href="{{ url("admin/submissions") }}">
                                <span class="menu-icon">
                                    <i class="fa fa-file" style="font-size: 18px" aria-hidden="true"></i>
                                </span>
                    <span class="menu-title {{ Request::is('admin/submissions*') ? '' : 'text-white' }}">Berichte</span>
                </a>
                <!--end:Menu link-->
            </div>
            <hr style="border: 2px solid #fff;">

            <div class="menu-item">
                <!--begin:Menu link-->
                <a @class(['menu-link']) href="#">
                                <span class="menu-icon">
                                    <i class="fa-solid fa-download" style="font-size: 18px; color: #000" ></i>
                                </span>
                    <span class="menu-title text-white">Mobile APP</span>
                </a>
                <!--end:Menu link-->
            </div>

        </div>
        <!--end::Sidebar menu-->
    </div>
    <!--end::Wrapper-->
</div>
