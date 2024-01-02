@extends('layouts.user.master')
@section('content')
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
                                            <button class="btn" style="background-color: #F49738;"><a href="{{ route('vorlagen.index') }}" class="text-dark">Vorlagen</a></button>
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
                                            <button class="btn" style="background-color: #F49738;"><a href="{{ route('berichte.index') }}" class="text-dark">Berichte</a></button>
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
