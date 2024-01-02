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
                    <span
                        class="menu-title {{ Request::is('admin/manage-user*') ? '' : 'text-white' }}">Mitarbeiter</span>
                </a>
                <!--end:Menu link-->
            </div>

            <div class="menu-item">
                <!--begin:Menu link-->
                <a @class(['menu-link','active' => Request::is('admin/kunden*')]) href="{{ url("admin/kunden") }}">
                    <span class="menu-icon">
                    <i class="fa fa-users" style="font-size: 18px" aria-hidden="true"></i>
                        </span>
                    <span class="menu-title {{ Request::is('admin/kunden*') ? '' : 'text-white' }}">Kunden</span>
                </a>
                <!--end:Menu link-->
            </div>

            {{--            <div class="menu-item">--}}
            {{--                <!--begin:Menu link-->--}}
            {{--                <a @class(['menu-link','active' => Request::is('admin/formular*')]) href="{{ url("admin/formular") }}">--}}
            {{--                                            <span class="menu-icon">--}}
            {{--                                                <i class="fa fa-table" style="font-size: 18px" aria-hidden="true"></i>--}}
            {{--                                            </span>--}}
            {{--                    <span class="menu-title {{ Request::is('admin/formular*') ? '' : 'text-white' }}">Vorlagen</span>--}}
            {{--                </a>--}}
            {{--                <!--end:Menu link-->--}}
            {{--            </div>--}}
            <div @class(['menu-item','menu-accordion','show' => Request::is('admin/formular*') || Request::is('admin/vorlagen-antworten*')])  data-kt-menu-trigger="click">
                <a @class(['menu-link']) href="#"
                   data-bs-toggle="tooltip"
                   data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                    <span class="menu-icon">
                        <i class="fa fa-table" style="font-size: 18px" aria-hidden="true"></i>
                    </span>
                    <span class="menu-title text-white">Vorlagen</span>
                    <div data-kt-menu-trigger="click">
                        <span class="menu-arrow"></span>
                    </div>
                </a>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a @class(['menu-link','active' => Request::is('admin/formular*')]) href="{{ url("admin/formular") }}"
                           data-bs-toggle="tooltip"
                           data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                    <span class="menu-icon">
                        <i class="fa fa-table" style="font-size: 18px" aria-hidden="true"></i>
                    </span>
                            <span
                                class="menu-title {{ Request::is('admin/formular*') ? '' : 'text-white' }}">Vorlagen</span>
{{--                            <div data-kt-menu-trigger="click">--}}
{{--                                <span class="menu-arrow"></span>--}}
{{--                            </div>--}}
                        </a>
                    </div>
                    <div class="menu-item">
                        <a @class(['menu-link','active' => Request::is('admin/vorlagen-antworten*')]) href="{{ url("admin/vorlagen-antworten-index") }}"
                           data-bs-toggle="tooltip" data-bs-trigger="hover"
                           data-bs-dismiss="click" data-bs-placement="right">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                            <span class="menu-title {{ Request::is('admin/vorlagen-antworten*') ? '' : 'text-white' }}">Dropdown</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-item">
                <a @class(['menu-link','active' => Request::is('admin/submissions*')]) href="{{ url("admin/submissions") }}">
                                <span class="menu-icon">
                                    <i class="fa fa-file" style="font-size: 18px" aria-hidden="true"></i>
                                </span>
                    <span class="menu-title {{ Request::is('admin/submissions*') ? '' : 'text-white' }}">Berichte</span>
                </a>
                <!--end:Menu link-->
            </div>

            <div class="menu-item">
                <!--begin:Menu link-->
                <a @class(['menu-link','active' => Request::is('admin/online-verbandsbuch')]) href="{{ url('admin/online-verbandsbuch') }}">
                                <span class="menu-icon">
                                    <i class="fa-solid fa-book-medical" style="font-size: 18px"></i>
                                </span>
                    <span class="menu-title {{ Request::is('admin/online-verbandsbuch*') ? '' : 'text-white' }}">Verbandbuch</span>
                </a>
                <!--end:Menu link-->
            </div>
            <div class="menu-item">
                <!--begin:Menu link-->
                <a @class(['menu-link','active' => Request::is('admin/psychische-belastung*')]) href="{{ url('admin/psychische-belastung') }}">
                                <span class="menu-icon">
                                    <i class="fa-solid fa-head-side-virus" style="font-size: 18px"></i>
                                </span>
                    <span class="menu-title {{ Request::is('admin/psychische-belastung*') ? '' : 'text-white' }}">Psychische Belastung</span>
                </a>
                <!--end:Menu link-->
            </div>

            <div class="menu-item">
                <!--begin:Menu link-->
                <a @class(['menu-link','active' => Request::is('admin/unfallermittlung')]) href="{{ url('admin/unfallermittlung') }}">
                                <span class="menu-icon">
                                    <i class="fa-solid fa-scale-unbalanced-flip" style="font-size: 18px"></i>
                                </span>
                    <span class="menu-title {{ Request::is('admin/unfallermittlung*') ? '' : 'text-white' }}">Unfallermittlung</span>
                </a>
                <!--end:Menu link-->
            </div>

            <div class="menu-item">
                <!--begin:Menu link-->
                <a @class(['menu-link','active' => Request::is('#')]) href="#">
                                <span class="menu-icon">
                                    <i class="fa-solid fa-scale-unbalanced-flip" style="font-size: 18px"></i>
                                </span>
                    <span class="menu-title text-white">Maßnahmen</span>
                </a>
                <!--end:Menu link-->
            </div>

            <div @class(['menu-item','menu-accordion','show' => Request::is('admin/formular*') || Request::is('admin/vorlagen-antworten*')])  data-kt-menu-trigger="click">
                <a @class(['menu-link']) href="#"
                   data-bs-toggle="tooltip"
                   data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                    <span class="menu-icon">
                                    <i class="fa-solid fa-arrows-to-eye" style="font-size: 18px"></i>
                                </span>
                    <span class="menu-title text-white">Gefährdungsbeurteilung </span>
                    <div data-kt-menu-trigger="click">
                        <span class="menu-arrow"></span>
                    </div>
                </a>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a @class(['menu-link','active' => Request::is('admin/risk-assessment-create*')]) href="{{ route('assessment.create') }}"
                           data-bs-toggle="tooltip"
                           data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                     <span class="menu-icon">
                                    <i class="fa-solid fa-arrows-to-eye" style="font-size: 18px"></i>
                                </span>
                            <span
                                class="menu-title {{ Request::is('admin/risk-assessment-create*') ? '' : 'text-white' }}">Gefährdungsbeurteilung</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a @class(['menu-link','active' => Request::is('admin/kategorien*')]) href="{{ url("admin/kategorien") }}"
                           data-bs-toggle="tooltip" data-bs-trigger="hover"
                           data-bs-dismiss="click" data-bs-placement="right">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                            <span class="menu-title {{ Request::is('admin/kategorien*') ? '' : 'text-white' }}">Gefährdungen</span>
                        </a>
                    </div>
                </div>
            </div>


            <div class="menu-item">
                <!--begin:Menu link-->
                <a @class(['menu-link','active' => Request::is('admin/messungen')]) href="{{ url('admin/messungen') }}">
                                <span class="menu-icon">
                                    <i class="fa-solid fa-weight-scale" style="font-size: 18px"></i>
                                </span>
                    <span class="menu-title {{ Request::is('admin/messungen*') ? '' : 'text-white' }}">Messungen</span>
                </a>
                <!--end:Menu link-->
            </div>


            {{--            <div class="menu-item">--}}
            {{--                <!--begin:Menu link-->--}}
            {{--                <a @class(['menu-link','active' => Request::is('admin/vorlagen-antworten*')]) href="{{ url("admin/vorlagen-antworten-index") }}">--}}
            {{--                                <span class="menu-icon">--}}
            {{--                                    <i class="fa fa-table" style="font-size: 18px" aria-hidden="true"></i>--}}
            {{--                                </span>--}}
            {{--                    <span class="menu-title {{ Request::is('admin/vorlagen-antworten*') ? '' : 'text-white' }}">Einstellungen</span>--}}
            {{--                </a>--}}
            {{--                <!--end:Menu link-->--}}
            {{--            </div>--}}


            <hr style="border: 2px solid #fff;">


            <div class="menu-item">
                <!--begin:Menu link-->
                <a @class(['menu-link']) href="{{ asset('public/assets/media/faisst.apk') }}">
                                <span class="menu-icon">
                                    <i class="fa-solid fa-download" style="font-size: 18px; color: #000"></i>
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

