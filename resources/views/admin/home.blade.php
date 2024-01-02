@extends('layouts.master')
@section('content')
    {{--            <div id="kt_app_content_container" class="app-container container-fluid">--}}
    {{--                <div class="row g-5 g-xl-10">--}}
    {{--                    <div class="col-xxl-6 mb-md-5 mb-xl-10">--}}
    {{--                        <a>Benutzer</a>--}}
    {{--                    </div>--}}

    {{--                    <div class="col-xxl-6 mb-md-5 mb-xl-10">--}}
    {{--                        <a>Kunde</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--                <div class="row g-5 g-xl-10">--}}
    {{--                    <div class="col-xxl-6 mb-md-5 mb-xl-10">--}}
    {{--                        <a>Vorlagen</a>--}}
    {{--                    </div>--}}

    {{--                    <div class="col-xxl-6 mb-md-5 mb-xl-10">--}}
    {{--                        <a>Berichte</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--            </div>--}}

    <style>
        .mb-4 {
            margin-bottom: 5rem !important;
        }
    </style>

    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row g-5 g-xl-10">
            <div class="mb-md-5 mb-xl-10">
                <div class="row g-5 g-xl-10">
                    <div class="col-6 col-md-6 col-xl-6 ">
                        <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                            <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                                <div class="mb-4 px-9">
                                    <div class="d-flex align-items-center justify-content-center mb-2">

                                        <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">
                                            <button class="btn" style="background-color: #F49738;"><a href="{{ route('admin.user.index') }}" class="text-dark">Benutzer</a></button>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 col-xl-6 ">
                        <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                            <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                                <div class="mb-4 px-9">
                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                        <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">
                                            <button class="btn" style="background-color: #F49738;"><a href="{{ route('user.index') }}" class="text-dark">Kunde</a></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-5 g-xl-10">
            <div class="mb-md-5 mb-xl-10">
                <div class="row g-5 g-xl-10">
                    <div class="col-6 col-md-6 col-xl-6 ">
                        <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                            <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                                <div class="mb-4 px-9">
                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                        <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">
                                            <button class="btn" style="background-color: #F49738;"><a href="{{ route('formular.index') }}" class="text-dark">Vorlagen</a></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 col-xl-6 ">
                        <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                            <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                                <div class="mb-4 px-9">
                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                        <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">
                                            <button class="btn" style="background-color: #F49738;"><a href="{{ route('formular.submission') }}" class="text-dark">Berichte</a></button>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
