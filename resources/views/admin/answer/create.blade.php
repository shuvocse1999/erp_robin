@extends('layouts.master')
@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="container">
            <form id="createForm" action="{{ route('vorlagen.antworten.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-8 col-xl-8 mb-2">
                        <input class="form-control fontSize" id="titel" name="title" value=""
                               placeholder="Antwortgruppe" style="border: 1px solid #2B6123; --bs-gray-500: #2B6123;" required>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-3" style="text-align: right">
                        <button type="submit" class="btn btn-warning text-white fontSize" id="saveBtn"
                                style="background-color: #F49738">
                            Speichern
                        </button>
                    </div>
                </div>
                <div class="mb-2 text-white"
                     style="display: flex; text-align: center; font-size: 16px; background-color: #2B6123; padding: 12px 0 12px 0px; flex-wrap: wrap;">
                    <div class="col-md-6 col-sm-12 mb-2" style="flex: 1;">
                        <strong>Antwort</strong>
                    </div>
                    <div class="col-md-2 col-sm-12 mb-2" style="flex: 1;">
                        <strong>Aktion</strong>
                    </div>
                </div>
                <!--begin::Repeater-->
                <div id="kt_docs_repeater_basic">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div data-repeater-list="kt_docs_repeater_basic">
                            <div data-repeater-item>
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-12 mb-2">
                                        <input type="text" class="form-control mb-2 mb-md-0" name="answer" placeholder="Aufgabe" />
                                    </div>

                                    <div class="col-md-2 col-sm-12 mb-2">
{{--                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-1">--}}
{{--                                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>--}}
{{--                                            Delete--}}
{{--                                        </a>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Form group-->

                    <!--begin::Form group-->
                    <div class="form-group mt-5">
                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                            <i class="ki-duotone ki-plus fs-3"></i>
                            Hinzufügen
                        </a>
                    </div>
                    <!--end::Form group-->
                </div>
            </form>
            <!--end::Repeater-->
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"
            integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#kt_docs_repeater_basic').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    </script>
@endsection
