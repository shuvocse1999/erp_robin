@extends('layouts.master')
@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card-toolbar flex-row-fluid justify-content-end gap-5 text-end">
            <a href="{{ route('admin.index') }}" data-repeater-delete
               class="btn btn-light-primary mt-3 mt-md-8">
                Back
            </a>
        </div>
        <div class="row g-5 g-xl-10">
            <!--begin::Form-->
            <form id="kt_docs_formvalidation_text" class="form" method="POST" action="{{ route('admin.update',$admin->id) }}"
                  autocomplete="off" enctype="multipart/form-data">
                @csrf

                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Image input-->
                        <div class="image-input image-input-outline" data-kt-image-input="true"
                             style="background-image: url('{{ asset('public/assets') }}/media/avatars/blank.png')">
                            <!--begin::Preview existing avatar-->

                            {{--                            <div class="image-input-wrapper w-125px h-125px"--}}
                            {{--                                 style="background-image: url('{{ asset('public/assets') }}/media/avatars/blank.png')"></div>--}}

                            @if(isset($admin->avatar))
                                <div class="image-input-wrapper w-125px h-125px"
                                     style="background-image: url('{{ asset('storage/images/admin/' . $admin->avatar) }}')"></div>
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
                </div>


                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Name</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                           value="{{ $admin->name }}"/>
                    <!--end::Input-->
                </div>

                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Email</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                           value="{{ $admin->email }}"/>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->

                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Password</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="password" name="password" class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                           value=""/>
                    <!--end::Input-->
                </div>
                <!--begin::Actions-->
                <button id="kt_docs_formvalidation_text_submit" type="submit" class="btn btn-light-primary">
        <span class="indicator-label">
            Update
        </span>
                    <span class="indicator-progress">
            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
        </span>
                </button>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
    </div>
@endsection
