@extends('layouts.master')
@section('content')
    <style>
        .text-dark a:hover i {
            color: #2B6123;
        }

        .btn-aktion:hover i {
            color: #2B6123;
        }

        @media only screen and (max-width: 550px) {
            .fontSize {
                font-size: 6px !important;
            }

            .fontSize14 {
                font-size: 14px !important;
            }
        }
    </style>
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="container">
            <div class="col-6 col-sm-6 col-md-3 col-lg-2 col-xl-2 mb-3">
                <a href="{{ route('formular.index') }}" style="color: #2B6123" data-repeater-delete
                   class="btn fontSize">
                    <i class="fa-solid fa-arrow-left" style="color: #2B6123"></i> Vorlagen
                </a>
            </div>

            <div class="row">
                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-2 mb-3">
                    <a href="#" data-repeater-delete class="btn text-white btn-aufgabe fontSize"
                       style="background-color: #2B6123">
                        <i class="fa-solid fa-plus text-white fontSize"></i> Bereich
                    </a>
                </div>
                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-2 mb-3">
                    <a href="#" data-repeater-delete class="btn text-white btn-bereich fontSize"
                       style="background-color: #2B6123">
                        <i class="fa-solid fa-plus text-white fontSize"></i> Aufgabe
                    </a>
                </div>

                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-3 mb-3">
                    <select class="form-select fontSize" data-control="select2" name="kunde" id="kunde"
                            data-placeholder="Kunde"
                            style="border: 1px solid #2B6123 !important; --bs-gray-300: 1px solid #2B6123 !important;">
                        <option></option>
                        <option value=" ">Choose one</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $formular->user_id == $user->id ? 'selected':'' }}>
                                {{ $user->vorname }} {{ $user->nachname }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="col-6 col-sm-9 col-md-9 col-lg-9 col-xl-3 mb-2">
                    <input class="form-control fontSize" id="titel" name="title" value="{{$formular->title}}"
                           placeholder="Titel" style="border: 1px solid #2B6123; --bs-gray-500: #2B6123;">
                </div>

                <div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-2 mb-3" style="text-align: right">
                    <button class="btn btn-warning text-white fontSize" id="saveBtn" style="background-color: #F49738">
                        Speichern
                    </button>
                </div>
            </div>

            <div class="row g-5 g-xl-10">
                <!--begin::Form-->
                <form id="kt_docs_formvalidation_text" class="form" method="POST"
                      action="{{ route('formular.update',$formular->id) }}"
                      autocomplete="off" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body table-responsive">
                        <div class="table-container">
                            <table
                                class="table align-middle fs-6 table-responsive"
                                style="padding: 0 5px">
                                <thead class="" style="background-color: #15731F">
                                <tr class="text-start text-white fw-bold fs-7 text-uppercase text-center fontSize">
                                    <th class="min-w-200px">Aufgaben</th>
                                    <th class="min-w-80px">Position</th>
                                    <th class="min-w-20px">B-ID</th>
                                    <th class="min-w-80px">Aktion</th>
                                </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600 row_data fontSize">
                                @if(count(@$formular->aufgabes) > 0)
                                    @php
                                        $row = 1;
                                    @endphp
                                    @foreach($formular->aufgabes as $aufgaben)
                                        @php
                                            $childRow = 1;
                                            $auswahlRow = 1;
                                            $deleteChild = 1;
                                            $childNumber = 1;
                                        @endphp
                                        <tr id="tr_table_row{{ $row }}" class="tr_table_row">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="row-number fontSize14" style="font-size: 20px">{{ $row }}.</span>
                                                    &nbsp
                                                    <input style="border: 1px solid #2B6123;"
                                                           value="{{ @$aufgaben->name }}"
                                                           class="form-control aufgaben" id="aufgaben"
                                                           name="aufgaben[' + rowIndex + '][title]">
                                                </div>

                                                @if(count($aufgaben->bereiches) > 0)
                                                    @foreach($aufgaben->bereiches as $bereich)
                                                        <div class="child_col fontSize14 mt-2"
                                                             id="child_col{{$row}}.{{$childRow}}">
                                                            <input type="hidden" class="old_checkbox"
                                                                   name="old_checkbox"
                                                                   value="{{ @$bereich->questionAnswerRelation->answer_sheet_id }}">
                                                            <div class="mt-2 align-items-center"
                                                                 style="display: flex; justify-content: flex-end;">
                                                                {{$row}}.{{$childRow}} &nbsp
                                                                <input class="form-control bereich"
                                                                       style="width: 80%; border: 1px solid #2B6123;"
                                                                       value="{{ $bereich->name }}"
                                                                       name="bereich[' + childIndex + '][title]"
                                                                       id="bereich">
                                                            </div>
                                                        </div>
                                                        @php
                                                            $childRow++;
                                                        @endphp
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td style="text-align: center;">
                                                <div class="mt-2" style="display: flex; justify-content: center;">
                                                    <a href="#" class="btn btn-sm move-up">
                                                        <i class="fa-solid fa-arrow-up" style="font-size: 27px"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm move-down">
                                                        <i class="fa-solid fa-arrow-down"
                                                           style="font-size: 27px"></i>
                                                    </a>
                                                </div>
                                                @if(count($aufgaben->bereiches) > 0)
                                                    @foreach($aufgaben->bereiches as $bereich)
                                                        <div class="child mt-2 child_arrow"
                                                             style="text-align: center; justify-content: center; display: flex;"
                                                             id="child_arrow{{$row}}.{{$childNumber}}">
                                                            <a href="#" class="btn btn-sm move-up-child">
                                                                <i class="fa-solid fa-arrow-up"
                                                                   style="font-size: 27px"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-sm move-down-child">
                                                                <i class="fa-solid fa-arrow-down"
                                                                   style="font-size: 27px"></i>
                                                            </a>
                                                        </div>
                                                        @php
                                                            $childNumber++;
                                                        @endphp
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td style="justify-content: center;text-align: center;">
                                                @if(isset($aufgaben))
                                                    <div class="" style="visibility: hidden">
                                                        <button type="button" class="btn btn-aktion"
                                                                id="{{ $row }}">
                                                            <i class="fa-solid fa-arrow-up-right-from-square"
                                                               style="font-size: 20px"></i>
                                                        </button>
                                                    </div>
                                                    @foreach($aufgaben->bereiches as $bereich)
                                                        <div class="check  mt-2"
                                                             id="number_check{{ $row }}.{{$auswahlRow}}">
                                                            @if(isset($bereich->questionAnswerRelation->answer_sheet_id))
                                                                <button type="button" class="btn btn-aktion"
                                                                        id="{{ $row }}.{{$auswahlRow}}">
                                                                    <strong id="checkbox_id"
                                                                            style="font-size: 16px; text-decoration: underline;">{{ @$bereich->questionAnswerRelation->answer_sheet_id }}</strong>
                                                                </button>
                                                            @else
                                                                <button type="button" class="btn btn-aktion"
                                                                        id="{{ $row }}.{{$auswahlRow}}">
                                                                    <i class="fa-solid fa-arrow-up-right-from-square"
                                                                       style="font-size: 20px"></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                        @php
                                                            $auswahlRow++;
                                                        @endphp
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td style="text-align: center; display: grid">
                                                <div class="mt-2">
                                                    <a href="javascript:;" class="btn" onclick="removerow.call(this)"
                                                       data-repeater-delete="">
                                                        <i class="fa-solid fa-trash-can" style="font-size: 20px"></i>
                                                    </a>
                                                </div>
                                                @if(count($aufgaben->bereiches) > 0)
                                                    @foreach($aufgaben->bereiches as $bereich)
                                                        <div class="mt-2 child_btn">
                                                            <a href="javascript:;" class="btn"
                                                               onclick="removeChildRow.call(this)"
                                                               data-repeater-delete=""
                                                               data-child-id="{{ $row }}.{{$deleteChild}}">
                                                                <i class="fa-solid fa-trash-can"
                                                                   style="font-size: 20px"></i>
                                                            </a>
                                                        </div>
                                                        @php
                                                            $deleteChild++;
                                                        @endphp
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                        @php
                                            $row++;
                                        @endphp
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>

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
                <form id="checkboxForm">
                    @csrf
                    <div style="margin-top: 20px;">
                        @foreach($answersheets as $answersheet)
                            @if ($answersheet->id >= 1 && $answersheet->id <= 9 && !in_array($answersheet->id, [10, 11, 12, 13]))
                                <div class="col-12" style="display: flex; padding: 5px;">
                                    {{--                                    <div class="col-1 d-flex align-items-center">--}}
                                    {{--                                        <div class="form-check text-white">--}}
                                    {{--                                            {{$answersheet->id}}--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}

                                    <div class="col-2 d-flex align-items-center justify-content-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="checkboxes[]"
                                                   value="{{ $answersheet->id }}" onclick="onlyOne(this)">
                                        </div>
                                    </div>
                                    @foreach ($answersheet->answers as $answer)
                                        @php
                                            $count = $answersheet->answers->count();
                                            if ($count === 5) {
                                                $columnClass = 'col-2';
                                            } elseif ($count === 4) {
                                                $columnClass = ($loop->first) ? 'col-4' : 'col-2';
                                            }
                                             elseif ($count === 3) {
                                                $columnClass = ($loop->first) ? 'col-4' : 'col-3';
                                            }
                                            else{
                                                $columnClass = 'col-3';
                                            }
                                        @endphp

                                        <div class="{{ $columnClass }}"
                                             style="background-color: {{ $answer->background_color }}; padding: 5px;">
                                            <h5 style="height: 30px; display: flex; align-items: center; margin-bottom: 0; color: #000">{{ $answer->answer }}</h5>
                                        </div>
                                    @endforeach
                                </div>
                                @php $dropdownDisplayed = false; @endphp

                            @elseif($answersheet->whereNotBetween('id', [1, 13]) && !in_array($answersheet->id, [10, 11, 12, 13]))
                                <hr style="width: 100%; border: 1px solid #fff; margin: 5px 0 5px 0;">
                                @if (!$dropdownDisplayed)
                                    <div class="col-2 text-end">
                                        <h1 class="text-white">Dropdown</h1>
                                    </div>
                                    <hr style="width: 100%; border: 1px solid #fff; margin: 5px 0 5px 0;">
                                    @php $dropdownDisplayed = true; @endphp
                                @endif
                                <div class="col-12" style="display: flex; padding: 5px; flex-wrap: wrap;">
                                    <div class="col-2 d-flex justify-content-center">
                                        <div class="form-check">
                                            <input class="form-check-input aufgaben-checkbox" type="checkbox" name="checkboxes[]" value="{{ $answersheet->id }}" onclick="onlyOne(this)">
                                        </div>
                                    </div>
                                    <div class="col-10" style="display: flex; flex-wrap: wrap;">
                                        <div class="col-12">
                                            <h2 class="text-white">{{ $answersheet->title }}</h2>
                                        </div>
                                        @foreach($answersheet->answers as $answer)
                                            <div class="col-6 col-md-3 col-lg-3 col-xl-3" style="background-color: {{ $answer->background_color }}; padding: 5px;">
                                                <h5 style="height: 30px; display: flex; align-items: center; margin-bottom: 0; color: #fff">{{ $answer->answer }}</h5>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            @else
                                <hr style="width: 100%; border: 1px solid #fff; margin: 5px 0 5px 0;">
                                <div class="col-12" style="display: flex; padding: 5px; color:#fff">
                                    <div class="col-2 d-flex align-items-center justify-content-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="checkboxes[]"
                                                   value="{{ $answersheet->id }}" onclick="onlyOne(this)">
                                        </div>
                                    </div>
                                    @foreach($answersheet->answers as $answer)
                                        <div class="col-3"
                                             style="background-color: {{ $answer->background_color }}; padding: 5px;">
                                            <h5 style="height: 30px; color:#fff; display: flex; align-items: center; margin-bottom: 0;"> {{ $answer->answer }} </h5>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                </form>
                <div class="modal-footer" style="display: flex; justify-content: center">
                    <button type="button" class="btn text-white" style="background-color: #d3d300" id="saveCheckboxes">
                        SPEICHERN
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {

            $('.tr_table_row').find('.move-up').click(function (e) {
                e.preventDefault();
                var currentRow = $(this).closest('tr');
                if (currentRow.index() > 0) {
                    currentRow.insertBefore(currentRow.prev());
                }
            });


            $('.tr_table_row').find('.move-down').click(function (e) {
                e.preventDefault();
                var currentRow = $(this).closest('tr');
                if (currentRow.index() < $('.table tbody tr').length - 1) {
                    currentRow.insertAfter(currentRow.next());
                }
            });

            $('.child').on('click', '.move-up-child', function (e) {
                e.preventDefault();
                var currentRow = $('.tr_table_row').closest('tr');
                var currentRow4 = currentRow.find('.child_col');
                if (currentRow4.length > 0) {
                    var currentIndex4 = currentRow4.index($('.tr_table_row').closest('.child_col'));
                    currentRow4.eq(currentIndex4).insertBefore(currentRow4.eq(currentIndex4 - 1));
                }
            });

            $('.child .move-down-child').click(function (e) {
                e.preventDefault();
                var currentRow = $('.tr_table_row').closest('tr');
                var currentRow3 = currentRow.find('.child_col');
                var currentIndex1 = currentRow3.index(currentRow.find('.child_col'));
                if (currentIndex1 < currentRow3.length - 1) {
                    currentRow3.eq(currentIndex1).insertAfter(currentRow3.eq(currentIndex1 + 1));
                }
            });


            $('.child').find('.move-up-child').click(function (e) {
                e.preventDefault();
                var currentRow = $(this).closest('tr');
                var currentRow4 = currentRow.find('.child_arrow');
                var currentIndex4 = currentRow4.index($(this).closest('.child_arrow'));
                if (currentIndex4 > 0) {
                    currentRow4.eq(currentIndex4).insertBefore(currentRow4.eq(currentIndex4 - 1));
                }
            });

            $('.child').find('.move-down-child').click(function (e) {
                e.preventDefault();
                var currentRow = $(this).closest('tr');
                var currentRow3 = currentRow.find('.child_arrow');
                var currentIndex1 = currentRow3.index($(this).closest('.child_arrow'));
                if (currentIndex1 < currentRow3.length - 1) {
                    currentRow3.eq(currentIndex1).insertAfter(currentRow3.eq(currentIndex1 + 1));
                }
            });


            var rowIndex = {{ @$row }};
            $('.btn-aufgabe').click(function (e) {
                e.preventDefault();
                childIndex = 1;
                var newRow = $('<tr id="tr_table_row' + rowIndex + '" class="tr_table_row">' +
                    '<td>' +
                    '<div class="d-flex align-items-center">' +
                    '<span class="row-number" style="font-size: 20px">' + rowIndex + '.</span> &nbsp <input style="border: 1px solid #2B6123;" class="form-control aufgaben" id="aufgaben" name="aufgaben[' + rowIndex + '][title]">' +
                    '</div>' +
                    '</td>' +
                    '<td style="text-align: center;">' +
                    '<div class="mt-2" style="display: flex; justify-content: center">' +

                    '<a href="#" class="btn btn-sm move-up">' +
                    '<i class="fa-solid fa-arrow-up" style="font-size: 27px"></i>' +
                    '</a>' +
                    '<a href="#" class="btn btn-sm move-down">' +
                    '<i class="fa-solid fa-arrow-down" style="font-size: 27px"></i>' +
                    '</a>' +
                    '<div>' +
                    '</td>' +
                    '<td style="text-align: center;">' +
                    '<div class="mt-2">' +
                    '<button type="button" style="visibility: hidden" class="btn btn-aktion" id="' + rowIndex + '.' + childIndex + '">' +
                    '<i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 20px"></i>' +
                    '</button>' +
                    '</div>' +
                    '</td>' +
                    '<td style="text-align: center;">' +
                    '<div class="mt-2">' +
                    '<a href="javascript:;" class="btn" onclick="removerow.call(this)" data-repeater-delete="">' +
                    ' <i class="fa-solid fa-trash-can" style="font-size: 20px"></i>' +
                    '</a>' +
                    '</div>' +
                    '</td>' +
                    '</tr>');

                $('.table tbody').append(newRow);
                rowIndex++;
                newRow.find('.move-up').click(function (e) {
                    e.preventDefault();
                    var currentRow = $(this).closest('tr');
                    if (currentRow.index() > 0) {
                        currentRow.insertBefore(currentRow.prev());
                    }
                });


                newRow.find('.move-down').click(function (e) {
                    e.preventDefault();
                    var currentRow = $(this).closest('tr');
                    if (currentRow.index() < $('.table tbody tr').length - 1) {
                        currentRow.insertAfter(currentRow.next());
                    }
                });
            });

            var childIndex = {{@$childRow}};
            $('.btn-bereich').click(function (e) {
                e.preventDefault();
                var currentRow = $('.table tbody tr:last td:first-child');
                var newInputField = $(
                    '<div class="mt-2 align-items-center child_col" id="child_col' + (rowIndex - 1) + '.' + childIndex + '" style="display: flex; justify-content: flex-end;">' +
                    (rowIndex - 1) + '.' + childIndex +
                    '&nbsp <input class="form-control bereich" style="width: 80%; border: 1px solid #2B6123;" id="bereich" name="bereich[' + childIndex + '][title]">' +
                    '</div>'
                );

                var currentRow3 = $('.table tbody tr:last').find('td:nth-child(3)');
                var newInputField3 = $(
                    '<div class="mt-2 auswahl_btn check" id="number_check' + (rowIndex - 1) + '.' + childIndex + '">' +
                    '<button type="button" class="btn btn-aktion" id="' + (rowIndex - 1) + '.' + childIndex + '">' +
                    '<i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 20px"></i>' +
                    '</button>' +
                    '<span class="number_check check" id="number_check' + (rowIndex - 1) + '.' + childIndex + '"></span>' +
                    '</div>'
                );


                var currentRow2 = $('.table tbody tr:last').find('td:nth-child(2)');
                var newInputField2 = $(
                    '<div class="child_arrow child mt-2" id="child_arrow' + (rowIndex - 1) + '.' + childIndex + '" style="display: flex; justify-content: center">' +
                    '<a href="#" class="btn btn-sm move-up-child">' +
                    '<i class="fa-solid fa-arrow-up" style="font-size: 27px"></i>' +
                    '</a>' +
                    '<a href="#" class="btn btn-sm move-down-child">' +
                    '<i class="fa-solid fa-arrow-down" style="font-size: 27px"></i>' +
                    '</a>' +
                    '</div>'
                );
                var currentRow4 = $('.table tbody tr:last').find('td:nth-child(4)');
                var newInputField4 = $(
                    '<div class="mt-2 child_btn" style="text-align: center;">' +
                    '<a href="javascript:;" class="btn" onclick="removeChildRow.call(this)" data-repeater-delete="" data-child-id="' + (rowIndex - 1) + '.' + childIndex + '">' +
                    ' <i class="fa-solid fa-trash-can" style="font-size: 20px"></i>' +
                    '</a>' +
                    '</div>'
                );
                childIndex++;

                currentRow.append(newInputField);
                currentRow2.append(newInputField2);
                currentRow3.append(newInputField3);
                currentRow4.append(newInputField4);

                newInputField2.find('.move-up-child').click(function (e) {
                    e.preventDefault();
                    var currentRow = newInputField2.closest('tr');
                    var currentRow4 = currentRow.find('.child_arrow');
                    var currentIndex4 = currentRow4.index(newInputField2.closest('.child_arrow'));
                    if (currentIndex4 > 0) {
                        currentRow4.eq(currentIndex4).insertBefore(currentRow4.eq(currentIndex4 - 1));
                    }
                });

                newInputField2.find('.move-down-child').click(function (e) {
                    e.preventDefault();
                    var currentRow = newInputField2.closest('tr');
                    var currentRow3 = currentRow.find('.child_arrow');
                    var currentIndex1 = currentRow3.index(newInputField2.closest('.child_arrow'));
                    if (currentIndex1 < currentRow3.length - 1) {
                        currentRow3.eq(currentIndex1).insertAfter(currentRow3.eq(currentIndex1 + 1));
                    }
                });

                newInputField2.find('.move-up-child').click(function (e) {
                    e.preventDefault();
                    var currentRow = newInputField.closest('tr');
                    var currentRow4 = currentRow.find('.child_col');
                    var currentIndex4 = currentRow4.index(newInputField.closest('.child_col'));
                    if (currentIndex4 > 0) {
                        currentRow4.eq(currentIndex4).insertBefore(currentRow4.eq(currentIndex4 - 1));
                    }
                });

                newInputField2.find('.move-down-child').click(function (e) {
                    e.preventDefault();
                    var currentRow = newInputField.closest('tr');
                    var currentRow3 = currentRow.find('.child_col');
                    var currentIndex1 = currentRow3.index(newInputField.closest('.child_col'));
                    if (currentIndex1 < currentRow3.length - 1) {
                        currentRow3.eq(currentIndex1).insertAfter(currentRow3.eq(currentIndex1 + 1));
                    }
                });

                newInputField2.find('.move-up-child').click(function (e) {
                    e.preventDefault();
                    var currentRow = newInputField3.closest('tr');
                    var currentRow4 = currentRow.find('.auswahl_btn');
                    var currentIndex4 = currentRow4.index(newInputField3.closest('.auswahl_btn'));
                    if (currentIndex4 > 0) {
                        currentRow4.eq(currentIndex4).insertBefore(currentRow4.eq(currentIndex4 - 1));
                    }
                });

                newInputField2.find('.move-down-child').click(function (e) {
                    e.preventDefault();
                    var currentRow = newInputField3.closest('tr');
                    var currentRow3 = currentRow.find('.auswahl_btn');
                    var currentIndex1 = currentRow3.index(newInputField3.closest('.auswahl_btn'));
                    if (currentIndex1 < currentRow3.length - 1) {
                        currentRow3.eq(currentIndex1).insertAfter(currentRow3.eq(currentIndex1 + 1));
                    }
                });
            });

            $('#saveCheckboxes').click(function () {

                var formData = $('#checkboxForm').serializeArray(); // Serialize as an array
                var checkboxValues = formData.map(function (item) {
                    return item.value;
                });
                var aufgabenId = $('#dynamicModal').data('aufgabenId');
                if (formData.length > 0) {
                    var checkboxData = {
                        name: aufgabenId,
                        checkboxes: checkboxValues
                    };
                    formData.aufgaben = formData.aufgaben || [];
                    formData.aufgaben.push(checkboxData);
                }

                var checkboxInputField = null;
                formData.map(function (item) {
                    if (item.name == "row_index") {
                        checkboxInputField = item.value;
                    }
                    ;
                });

                var checkboxValues = null;
                formData.map(function (item) {
                    if (item.name == "checkboxes[]") {
                        checkboxValues = item.value;
                    }
                    ;
                });
                var trRow = document.getElementById("child_col" + checkboxInputField);
                var numberCheck = document.getElementById("number_check" + checkboxInputField);

                if (trRow && numberCheck) {
                    var existingInput = trRow.querySelector('input[name="checkbox"]');
                    var existingInputNumberCheck = numberCheck.querySelector('input[name="checkbox"]');

                    var newField = document.createElement('input');
                    newField.setAttribute('type', 'hidden');
                    newField.setAttribute('name', 'checkbox');
                    newField.setAttribute('id', 'checkbox_id');
                    newField.setAttribute('value', checkboxValues);


                    var newField2 = document.createElement('input');
                    newField2.setAttribute('type', 'text');
                    newField2.setAttribute('name', 'checkbox');
                    newField2.setAttribute('id', 'checkbox_id');
                    newField2.setAttribute('value', checkboxValues);
                    newField2.setAttribute('readonly', 'readonly');
                    newField2.setAttribute('style', 'width: 20px;height: 20px');

                    if (existingInput) {
                        existingInput.value = checkboxValues;
                    } else {
                        var firstTd = trRow.querySelector('.mt-2');
                        if (firstTd) {
                            firstTd.appendChild(newField);
                        }
                    }

                    if (existingInputNumberCheck) {
                        existingInputNumberCheck.value = checkboxValues;
                    } else {
                        var firstTd2 = numberCheck.querySelector('.btn-aktion');
                        if (firstTd2) {
                            firstTd2.appendChild(newField2);
                        }
                    }
                }

                $("#checkboxForm").trigger("reset");
                $('input[name="row_index"]').remove();
                $('#dynamicModal').modal('hide');
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();

                var titel = $('#titel').val();

                if (titel === '') {
                    alert('Titel is required.');
                    return;
                }

                var validationMessages = [];

                $('input.aufgaben').each(function () {
                    var aufgabenValue = $(this).val();
                    var rowIndex = $(this).closest('tr').index() + 1;

                    if (aufgabenValue === '') {
                        validationMessages.push('Bereich field is required.');
                    }

                    $(this).closest('tr').find('input.bereich').each(function () {
                        var bereichValue = $(this).val();
                        var childIndex = $(this).closest('td').index() - 1;

                        if (bereichValue === '') {
                            validationMessages.push('Aufgaben field is required.');
                        }
                    });
                });

                if (validationMessages.length > 0) {
                    // Display the validation messages in an alert
                    var errorMessage = 'Validation errors:\n' + validationMessages.join('\n');
                    alert(errorMessage);
                    return;
                }

                var formData = {
                    titel: $('#titel').val(),
                    kunde: $('#kunde').val(),
                    aufgaben: []
                };
                $('input[name^="aufgaben"]').each(function () {
                    var aufgabenValue = $(this).val();
                    var bereichValues = [];
                    var $row = $(this).closest('tr');
                    $row.find('input[name^="bereich"]').each(function () {
                        var bereichValue = $(this).val();
                        var checkboxValue = $(this).closest('td .child_col').find('input[name="checkbox"]').val();
                        var bereichObject = {
                            name: bereichValue,
                            checkbox: checkboxValue
                        };
                        bereichValues.push(bereichObject);
                    });

                    var aufgabenObject = {
                        name: aufgabenValue,
                        bereich: bereichValues
                    };

                    formData.aufgaben.push(aufgabenObject);
                });

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('formular.update',$formular->id) }}',
                    data: JSON.stringify(formData), // Send the data as JSON
                    contentType: 'application/json', // Set content type to JSON
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function (response) {
                        window.location.href = '{{ route('formular.index') }}';
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            });

            $(document).on('click', '.btn-aktion', function (e) {
                var formfield = document.getElementById('checkboxForm');
                var newField = document.createElement('input');
                newField.setAttribute('type', 'hidden');
                newField.setAttribute('name', 'row_index');
                newField.setAttribute('value', this.id);
                formfield.appendChild(newField);


                var trRow = document.getElementById("child_col" + this.id);
                var existingInput = trRow.querySelector('input[name="checkbox"]');
                var oldCheckbox = trRow.querySelector('input[name="old_checkbox"]');
                var checkboxesModal = document.getElementsByName('checkboxes[]');
                checkboxesModal.forEach((item) => {
                    item.checked = false;
                });
                if (existingInput) {
                    // Check the checkbox with the existing value
                    checkboxesModal.forEach((item) => {
                        if (item.value == existingInput.value) {
                            item.checked = true;
                        }
                    });
                } else {
                    if (oldCheckbox) {
                        // Check the checkbox with the old value
                        checkboxesModal.forEach((item) => {
                            if (item.value == oldCheckbox.value) {
                                item.checked = true;
                            }
                        });
                    }
                }

                var checkboxesModal = document.getElementsByName('checkboxes[]');

                var aufgabenId = $(this).closest('tr').find('input[name^="aufgaben"]').val();
                $('#dynamicModal').data('aufgabenId', aufgabenId);
                $('#dynamicModal #aufgabenIdDisplay').text(aufgabenId);
                $('#dynamicModal').modal('show');
            });
        });

        function removerow() {
            $(this).closest(".tr_table_row").remove();
        }

        function removeChildRow() {
            var childId = $(this).data('child-id');
            var elementToDelete = document.getElementById("child_col" + childId);
            var number_check = document.getElementById("number_check" + childId);
            var child = document.getElementById("child_arrow" + childId);

            if (elementToDelete) {
                var parentDiv = elementToDelete.closest('.child_col');
                number_check.closest('.check').remove();
                child.closest('.child').remove();
                if (parentDiv) {
                    parentDiv.remove();
                    $(this).closest('.child_btn').remove();
                }
            }
        }

    </script>
    <script>
        function onlyOne(checkbox) {
            var checkboxes = document.getElementsByName('checkboxes[]');
            checkboxes.forEach((item) => {
                if (item !== checkbox) item.checked = false;
            });
        }
    </script>
@endsection
