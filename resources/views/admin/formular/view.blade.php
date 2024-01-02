@extends('layouts.master')
@section('content')
    <style>
        .text-dark a:hover i {
            color: #2B6123;
        }

        .btn-aktion:hover i {
            color: #2B6123;
        }
    </style>
    <div id="kt_app_content_container" class="app-container container-fluid">

        <div class="" style="display:flex; align-items: flex-end; margin-bottom: 10px">
            {{--                        <div class="card-toolbar justify-content-end gap-5 me-4">--}}
            {{--                            <a href="{{ route('formular.index') }}" data-repeater-delete class="btn mt-3 mt-md-8"--}}
            {{--                               style="color: #2B6123">--}}
            {{--                                <i class="fa-solid fa-arrow-left" style="color: #2B6123"></i>Formular--}}
            {{--                            </a>--}}
            {{--                        </div>--}}
            <div class="card-toolbar justify-content-end gap-5 me-4">
                @php
                    $user = \App\Models\User::where('id',$userId)->first();
                @endphp
                <h4>{{@$submission->formulars->title}} / {{ @$user->name }} / created
                    on: {{@$submission->created_at->format("d.m.Y") }}</h4>
            </div>

            {{--            <div class="card-title">--}}
            {{--                <!--begin::Search-->--}}
            {{--                <div class="col-12 text-end">--}}
            {{--                    <div class="w-150px ms-auto">--}}
            {{--                        <!--begin::Menu-->--}}
            {{--                        <form id="viewpdfForm" action="{{ route('view-generate-pdf',$submission->id) }}" method="post">--}}
            {{--                            @csrf--}}
            {{--                            <select name="export_type" class="form-select form-select-solid" data-control="select2"--}}
            {{--                                    data-placeholder="Generate Pdf" onchange="submitForm()">--}}
            {{--                                <option></option>--}}
            {{--                                <option value="pdf">PDF</option>--}}
            {{--                            </select>--}}
            {{--                        </form>--}}
            {{--                        <!--end::Menu-->--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <!--end::Export buttons-->--}}
            {{--            </div>--}}

        </div>
        <div class="row g-5 g-xl-10">
            <!--begin::Form-->

            <div class="card-body table-responsive">
                <table
                    class="table align-middle border rounded table-row-dashed fs-6 table-bordered table-responsive"
                    style="padding: 0 5px">
                    <thead class="" style="background-color: #15731F">
                    <tr class="text-start text-white fw-bold fs-7 text-uppercase text-center">
                        <th class="min-w-80px">Aufgaben</th>
                        <th class="min-w-80px">Auswahl</th>
                        <th class="min-w-80px">Photos</th>
                        <th class="min-w-80px">Text</th>
                    </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600 row_data">

                    @if ($submission->userAnswers->count() > 0)
                        @php $row = 1; @endphp
                        @foreach ($submission->userAnswers->groupBy('aufgaben_id') as $aufgabenId => $userAnswers)
                            @php $childRow = 1; @endphp
                            <tr id="tr_table_row{{ $row }}" class="tr_table_row">
                                <td>
                                        <span class="text-dark">
                                            <div class="d-flex align-items-center">
                                                <span class="row-number" style="font-size: 20px">{{ $row }}.</span> &nbsp
                                                <input style="border: 1px solid #2B6123;"
                                                       value="{{ @$userAnswers->first()->aufgabens->name }}"
                                                       class="form-control" id="aufgaben"
                                                       name="aufgaben[{{ $row }}][title]" readonly>
                                            </div>
                                        </span>
                                    @foreach ($userAnswers as $userAnswer)
                                        <span class="text-dark child_col" id="child_col{{ $row }}.{{ $childRow }}">
                                                <input type="hidden" class="old_checkbox" name="old_checkbox"
                                                       value="{{ @$userAnswer->answer_sheet_id }}">
                                                <div class="mb-2 mt-2 align-items-center"
                                                     style="display: flex; justify-content: flex-end;">{{ $row }}.{{ $childRow }} &nbsp
                                                    <input class="form-control"
                                                           style="width: 80%; border: 1px solid #2B6123;"
                                                           value="{{ @$userAnswer->bereiches->name }}"
                                                           name="bereich[{{ $childRow }}][title]" readonly>
                                                </div>
                                            </span>
                                        @php $childRow++; @endphp
                                    @endforeach
                                </td>
                                <td>
                                    <div style="margin-top: 50px;">
                                        @foreach ($userAnswers as $answer)
                                            @if ($answer->answer_sheet_id != 10 && $answer->answer_sheet_id != 11 && $answer->answer_sheet_id != 12 && $answer->answer_sheet_id != 13 )
                                                <span class="text-dark">
                                                    <div class="d-flex align-items-center" style="margin-top: inherit;">
                                                        <div class="btn mb-2"
                                                             style="background-color: {{@$answer->answers->background_color}}">
                                                            {{ @$answer->answers->answer }}
                                                        </div>
                                                    </div>
                                                </span>
                                            @elseif($answer->answer_sheet_id == 10)
                                                <span class="text-dark">
                                                    <div class="d-flex align-items-center" style="margin-top: inherit;">
                                                        <div class="btn mb-2"
                                                             style="background-color: {{@$answer->answers->background_color}}">
                                                            {{ @$answer->Textfield }}
                                                        </div>
                                                    </div>
                                                </span>
                                            @elseif($answer->answer_sheet_id == 11)
                                                <span class="text-dark">
                                                    <div class="d-flex align-items-center" style="margin-top: inherit;">
                                                        <div class="btn mb-2"
                                                             style="background-color: {{@$answer->answers->background_color}}">
                                                            {{ \Carbon\Carbon::parse($answer->dateTime)->format('Y-m-d H:i:s') }}
                                                        </div>
                                                    </div>
                                                </span>
                                            @elseif($answer->answer_sheet_id == 12)
                                                <span class="text-dark">
                                                    <div class="d-flex align-items-center" style="margin-top: inherit;">
                                                        <div class="btn mb-2"
                                                             style="background-color: {{@$answer->answers->background_color}}">
                                                            {{ @$answer->Zahlen }}
                                                        </div>
                                                    </div>
                                                </span>
                                            @elseif($answer->answer_sheet_id == 13)
                                                <span class="text-dark">
                                                   <div class="mb-2" style=" margin-top: inherit;">
                                                               <a href="{{ asset('public/images/formular/' . $answer->Unterschrift) }}"
                                                                  target="_blank">
                                                            <img class="mb-2 me-2"
                                                                 src="{{ asset('public/images/formular/' . $answer->Unterschrift) }}"
                                                                 alt="Photo"
                                                                 height="40px" width="40px">
                                                        </a>
                                                    </div>
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <div style="margin-top: 50px;">
                                        @foreach ($userAnswers as $answer)
                                            @php
                                                $photos = json_decode($answer->photo);
                                            @endphp
                                            @if (count($photos) != 1)
                                                <div class="d-flex align-items-center">
                                                    @foreach ($photos as $photo)
                                                        <div class="mb-2">
                                                            <a href="{{ asset('public/images/formular/' . $photo) }}" target="_blank">
                                                                <img class="mb-2 me-2" src="{{ asset('public/images/formular/' . $photo) }}"
                                                                     alt="Photo" height="40px" width="40px">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @elseif (count($photos) == 1)
                                                @foreach ($photos as $photo)
                                                    <div class="text-dark mb-2">
                                                        <a href="{{ asset('public/images/formular/' . $photo) }}" target="_blank">
                                                            <img src="{{ asset('public/images/formular/' . $photo) }}"
                                                                 alt="Photo" height="40px" width="40px">
                                                        </a>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>

                                    {{--                                    <div style="margin-top: 50px;">--}}
{{--                                        @foreach ($userAnswers as $answer)--}}
{{--                                            @php--}}
{{--                                                $photos  = json_decode($answer->photo);--}}
{{--                                            @endphp--}}
{{--                                            @foreach ($photos as $photo)--}}
{{--                                            <span class="text-dark">--}}
{{--                                                <div class="d-flex align-items-center" style="margin-top: inherit;">--}}
{{--                                                    <div class="mb-2">--}}
{{--                                                        <a href="{{ asset('public/images/formular/' . $photo) }}"--}}
{{--                                                           target="_blank">--}}
{{--                                                            <img class="mb-2 me-2"--}}
{{--                                                                 src="{{ asset('public/images/formular/' . $photo) }}"--}}
{{--                                                                 alt="Photo"--}}
{{--                                                                 height="40px" width="40px">--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </span>--}}
{{--                                            @endforeach--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}

                                    {{--                                    <span class="text-dark" style="margin-top: 50px">--}}
                                    {{--                                            <div class="mb-2"--}}
                                    {{--                                                 style="display: flex; margin-top: inherit; flex-wrap: wrap">--}}
                                    {{--                                               @foreach ($userAnswers as $answer)--}}
                                    {{--                                                    @php--}}
                                    {{--                                                        $photos  = json_decode($answer->photo);--}}
                                    {{--                                                    @endphp--}}
                                    {{--                                                    @foreach ($photos as $photo)--}}
                                    {{--                                                        <a href="{{ asset('public/images/formular/' . $photo) }}"--}}
                                    {{--                                                           target="_blank">--}}
                                    {{--                                                            <img class="mb-2 me-2"--}}
                                    {{--                                                                 src="{{ asset('public/images/formular/' . $photo) }}"--}}
                                    {{--                                                                 alt="Photo"--}}
                                    {{--                                                                 height="40px" width="40px">--}}
                                    {{--                                                        </a>--}}
                                    {{--                                                        --}}{{--                                                        <img class="mb-2 me-2" src="{{ asset('public/images/formular/' . $photo) }}" alt="Photo" height="40px" width="40px">--}}
                                    {{--                                                    @endforeach--}}
                                    {{--                                                @endforeach--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </span>--}}
                                </td>
                                <td>
                                        <span class="text-dark" style="margin-top: 50px">
                                            <div class="mb-2" style="display: grid; margin-top: inherit;">
                                                @foreach ($userAnswers as $comments)
                                                    <p style="max-width: 45ch; white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">{{@$comments->comment}}</p>
                                                @endforeach

                                            </div>
                                        </span>
                                </td>


                            </tr>
                            @php $row++; @endphp
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <!--end::Form-->
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="dynamicModal">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content" style="background: #000;">
                <div class="modal-header" style="justify-content: center;">
                    <h1 class="modal-title text-white" style="font-size: 34px">Auswahl</h1>
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                            data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="checkboxForm">
                        @csrf
                        <div>
                            @foreach($answersheets as $answersheet)
                                <div class="col-12" style="display: flex; justify-content: center; padding: 5px;
}">
                                    <div class="col-1 d-flex align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="checkboxes[]"
                                                   value="{{ $answersheet->id }}" onclick="onlyOne(this)">
                                        </div>
                                    </div>
                                    @foreach($answersheet->answers as $answer)
                                        <div class="col-3"
                                             style="background-color: {{ $answer->background_color }}; padding: 5px">
                                            <h5 style="height: 30px;  display: flex; align-items: center;    margin-bottom: 0;"> {{ $answer->answer }} </h5>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="display: flex; justify-content: center">
                    <button type="button" class="btn text-white" style="background-color: #d3d300" id="saveCheckboxes">
                        SPEICHERN
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitForm() {
            document.getElementById("viewpdfForm").submit();
        }
    </script>
@endsection
