@extends('layouts.master')
@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card-toolbar flex-row-fluid justify-content-end gap-5 text-end">
            <a href="{{ route('clients.index') }}" data-repeater-delete
               class="btn btn-primary mt-3 mt-md-8">
                Back
            </a>
        </div>
        <div class="row g-5 g-xl-10">
            <!--begin::Form-->
            <form id="kt_docs_formvalidation_text" class="form" method="POST"
                  action="{{ route('clients.update',$client->id) }}"
                  autocomplete="off" enctype="multipart/form-data">
                @csrf
                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Firma</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="text" name="firma" class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                           value="{{ $client->firma }}"/>
                    <!--end::Input-->
                </div>

                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Vorname</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="text" name="vorname" class="form-control form-control-solid mb-3 mb-lg-0"
                           placeholder=""
                           value="{{ $client->vorname }}"/>
                    <!--end::Input-->
                </div>


                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="fw-semibold fs-6 mb-2">Nachname</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="text" name="nachname" class="form-control form-control-solid mb-3 mb-lg-0"
                           placeholder=""
                           value="{{ $client->nachname }}"/>
                </div>

                <div class="fv-row mb-10">
                    <label class="fw-semibold fs-6 mb-2">Adresse</label>
                    <!--begin::Input-->
                    <input type="text" name="adresse" class="form-control form-control-solid mb-3 mb-lg-0"
                           placeholder=""
                           value="{{ $client->adresse }}"/>
                    <!--end::Input-->
                </div>


                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Postleitzahl</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="text" name="postleitzahl" class="form-control form-control-solid mb-3 mb-lg-0"
                           placeholder=""
                           value="{{ $client->postleitzahl }}"/>
                    <!--end::Input-->
                </div>


                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="fw-semibold fs-6 mb-2">Ort</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="text" name="ort" class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                           value="{{ $client->ort }}"/>
                    <!--end::Input-->
                </div>

                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Email</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                           value="{{ $client->email }}"/>
                    <!--end::Input-->
                </div>

                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="fw-semibold fs-6 mb-2">Telefon</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="text" name="telefon" class="form-control form-control-solid mb-3 mb-lg-0"
                           placeholder=""
                           value="{{ $client->telefon }}"/>
                    <!--end::Input-->
                </div>

                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="fw-semibold fs-6 mb-2">Status</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select class="form-select form-select-solid" name="status" data-control="select2"
                            data-placeholder="Select an option">
                        <option></option>
                        <option value="wartet" {{ $client->status == "wartet" ? 'selected' :'' }} >Wartet</option>
                        <option value="bearbeitung" {{ $client->status == "bearbeitung" ? 'selected' :'' }}>Bearbeitung</option>
                        <option value="erledigt" {{ $client->status == "erledigt" ? 'selected' :'' }}>Erledigt</option>
                    </select>
                    <!--end::Input-->
                </div>

                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="fw-semibold fs-6 mb-2">Priorität</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select class="form-select form-select-solid" name="priorität" data-control="select2" data-placeholder="Select an option">
                        <option></option>
                        <option value="niedrig" {{ $client->priorität == "niedrig" ? 'selected' :'' }}>Niedrig</option>
                        <option value="mittel" {{ $client->priorität == "mittel" ? 'selected' :'' }}>Mittel</option>
                        <option value="hoch" {{ $client->priorität == "hoch" ? 'selected' :'' }}>Hoch</option>
                    </select>
                    <!--end::Input-->
                </div>

                <button id="kt_docs_formvalidation_text_submit" type="submit" class="btn btn-primary">
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
