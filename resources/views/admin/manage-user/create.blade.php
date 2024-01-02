@extends('layouts.master')
@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card-toolbar flex-row-fluid justify-content-end gap-5 text-end">
            <a href="{{ route('admin.user.index') }}" data-repeater-delete
               class="btn btn-light-primary mt-3 mt-md-8">
                Back
            </a>
        </div>
        <div class="row g-5 g-xl-10">

            <!--begin::Form-->
            <form id="kt_docs_formvalidation_text" class="form" method="POST" action="{{ route('admin.user.store') }}"
                  autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="fv-row mb-10">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                    <div class="col-lg-8">
                        <div class="image-input image-input-outline" data-kt-image-input="true"
                             style="background-image: url('{{ asset('public/assets') }}/media/avatars/blank.png')">
                            <div class="image-input-wrapper w-125px h-125px"
                                 style="background-image: url('{{ asset('public/assets') }}/media/avatars/blank.png')"></div>
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
                    <label class="required fw-semibold fs-6 mb-2">Firmenname</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="text" name="firmenname" class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                           value=""/>
                    <!--end::Input-->
                </div>

                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Email</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                           value=""/>
                    <!--end::Input-->
                </div>
                <div class="fv-row mb-10">
                    <label class="required fw-semibold fs-6 mb-2">Password</label>
                    <input type="password" name="password" class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                           value=""/>
                    <span>Password contain one Capital letter, one small letter, one special character, one number and a minimum of 8 characters</span>
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="fv-row mb-10">
                    <label class="required fw-semibold fs-6 mb-2">Role</label>
                    <select class="form-control form-control-solid mb-3 mb-lg-0" name="role" data-control="select2" data-placeholder="Select an option">
                        <option></option>
                        <option value="1">Benutzer</option>
                        <option value="2">Kunde</option>
{{--                        <option value="3">User</option>--}}
                    </select>
                </div>

                <!--begin::Actions-->
                <button id="kt_docs_formvalidation_text_submit" type="submit" class="btn btn-light-primary">
        <span class="indicator-label">
            Create
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

