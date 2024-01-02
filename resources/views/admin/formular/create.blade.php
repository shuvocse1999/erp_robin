@extends('layouts.master')
@section('content')
    <style>
        .text-dark a:hover i {
            color: #2B6123;
        }

        .btn-aktion:hover i {
            color: #2B6123;
        }

        @media only screen and (max-width: 423px) {
            .fontSize {
                font-size: 10px !important;
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
                    <select class="form-select fontSize" data-control="select2" name="kunde" id="kunde" data-placeholder="Kunde"
                            style="border:1px solid #2B6123 !important; --bs-gray-300: 1px solid #2B6123 !important;" required>
                        <option></option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->firmenname }} - {{ $user->standort }} - {{ $user->abteilung }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="col-6 col-sm-9 col-md-9 col-lg-9 col-xl-3 mb-2">
                    <input class="form-control fontSize" id="titel" name="title" value=""
                           placeholder="Titel" style="border: 1px solid #2B6123; --bs-gray-500: #2B6123;" required>
                </div>

                <div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-2 mb-3" style="text-align: right">
                    <button class="btn btn-warning text-white fontSize" id="saveBtn" style="background-color: #F49738">
                        Speichern
                    </button>
                </div>
            </div>
            <div class="row g-5 g-xl-10">
                <form id="kt_docs_formvalidation_text" class="form" method="POST" action="{{ route('formular.store') }}"
                      autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body table-responsive">
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
                            <tbody class="fw-semibold text-gray-600 fontSize">

                            </tbody>
                        </table>
                    </div>
                </form>
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
                            @if ($answersheet->id != 10 && $answersheet->id != 11 && $answersheet->id != 12 && $answersheet->id != 13)
                                <div class="col-12" style="display: flex; padding: 5px;">
                                    <div class="col-1 d-flex align-items-center">
                                        <div class="form-check text-white">
                                            {{$answersheet->id}}
                                        </div>
                                    </div>

                                    <div class="col-1 d-flex align-items-center">
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
                            @else
                                <hr style="width: 100%; border: 1px solid #fff; margin: 5px 0 5px 0;">
                                <div class="col-12" style="display: flex; padding: 5px; color:#fff">
                                    <div class="col-1 d-flex align-items-center">
                                        <div class="form-check text-white">
                                            {{$answersheet->id}}
                                        </div>
                                    </div>

                                    <div class="col-1 d-flex align-items-center">
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
        var rowIndex = 1;
        function updateCount(){
            var parentId = (rowIndex-1);
            var parent = document.getElementById('tr_table_row'+parentId);
            var firstTd = parent.querySelector('td:first-child');
            var inputElements = firstTd.querySelectorAll('.child_col');
            var inputCount = inputElements.length;
            return (inputCount+1);
        }
        $(document).ready(function () {

            $('.btn-aufgabe').click(function (e) {
                e.preventDefault();

                childIndex = 1;
                var newRow = $('<tr id="tr_table_row' + rowIndex + '" class="tr_table_row">' +
                    '<td>' +
                    '<span class="text-dark">' +
                    '<div class="d-flex align-items-center">' +
                    '<span class="row-number fontSize14" style="font-size: 20px">' + rowIndex + '.</span>' +

                    '<input style="border: 1px solid #2B6123;" class="form-control aufgaben" id="aufgaben" name="aufgaben[' + rowIndex + '][title]" required>' +
                    '</div>' +
                    '</span>' +
                    '</td>' +
                    '<td class="text-center">' +
                    '<div class="mt-2" style="display: flex; justify-content: center">' +
                    '<span class="text-dark">' +
                    '<a href="#" class="btn btn-sm move-up">' +
                    '<i class="fa-solid fa-arrow-up" style="font-size: 27px"></i>' +
                    '</a>' +
                    '</span>' +
                    '<span class="text-dark">' +
                    '<a href="#" class="btn btn-sm move-down">' +
                    '<i class="fa-solid fa-arrow-down" style="font-size: 27px"></i>' +
                    '</a>' +
                    '</span>' +
                    '</div>' +
                    '</td>' +
                    '<td class="text-center">' +
                    '<div class="mt-2 auswahl_btn">' +
                    '<span class="text-dark">' +
                    '<button type="button" style="visibility: hidden" class="btn btn-aktion" id="' + rowIndex + '.' + childIndex + '">' +
                    '<i class="fa-solid fa-arrow-up-right-from-square fontSize14" style="font-size: 20px"></i>' +
                    '</button>' +
                    '</span>' +
                    '</div>'+
                    '</td>' +
                    '<td class="text-center">' +
                    '<div class="mt-2 child_btn" style="text-align: center;">' +
                    '<span class="btn text-dark">' +
                    '<a href="javascript:;" onclick="removerow.call(this)" data-repeater-delete="">' +
                    ' <i class="fa-solid fa-trash-can fontSize14" style="font-size: 20px"></i>' +
                    '</a>' +
                    '</span>' +
                    '</div>'+
                    '</td>' +
                    '</tr>');


                $('.table tbody').append(newRow);

                var parentId2 = rowIndex;
                var parent2 = document.getElementById('tr_table_row'+parentId2);
                var firstTd2 = parent2.querySelector('td:first-child');
                var inputElements2 = firstTd2.querySelectorAll('input');
                var inputCount2 = inputElements2.length;
                console.log(inputCount2)

                // console.log(inputCount2);

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
            var childIndex = 1;


            $('.btn-bereich').click(function (e) {
                e.preventDefault();
                var currentRow = $('.table tbody tr:last td:first-child');
                var newInputField = $(
                    '<span class="text-dark child_col" id="child_col' + (rowIndex - 1) + '.' + childIndex + '">' +
                    '<div class="mb-2 mt-2 align-items-center fontSize14" style="display: flex; justify-content: flex-end;">' +
                    '<span class="text-dark" id="child_col_title' + (rowIndex - 1) + '.' + childIndex + '">' +
                    (rowIndex - 1) + '.' + childIndex +
                    '</span>'+
                    '&nbsp <input class="form-control bereich" style="width: 80%; border: 1px solid #2B6123;" id="bereich" name="bereich[' + childIndex + '][title]" required>' +

                    '</div>' +
                    '</span>'
                );

                var currentRow3 = $('.table tbody tr:last').find('td:nth-child(3)');
                var newInputField3 = $(
                    '<div class="mt-2 auswahl_btn">' +
                    '<span class="text-dark" id="number_check' + (rowIndex - 1) + '.' + childIndex + '">' +
                    '<button type="button" class="btn btn-aktion" id="' + (rowIndex - 1) + '.' + childIndex + '">' +
                    '<i class="fa-solid fa-arrow-up-right-from-square fontSize14" style="font-size: 20px"></i>' +
                    '</button>' +
                    '</span>' +
                    '<span class="number_check" id="number_check' + (rowIndex - 1) + '.' + childIndex + '"></span>' +
                    '<div>'
                );



                var currentRow2 = $('.table tbody tr:last').find('td:nth-child(2)');
                var newInputField2 = $(
                    '<div class="child_arrow mt-2" style="display: flex; justify-content: center">' +
                    '<span class="text-dark" id="child_arrow' + (rowIndex - 1) + '.' + childIndex + '">' +
                    '<a href="#" class="btn btn-sm move-up-child">' +
                    '<i class="fa-solid fa-arrow-up" style="font-size: 27px"></i>' +
                    '</a>' +
                    '</span>' +
                    '<span class="text-dark">' +
                    '<a href="#" class="btn btn-sm move-down-child">' +
                    '<i class="fa-solid fa-arrow-down" style="font-size: 27px"></i>' +
                    '</a>' +
                    '</span>' +
                    '</div>'
                );

                var currentRow4 = $('.table tbody tr:last').find('td:nth-child(4)');
                var newInputField4 = $(
                    '<div class="mt-2 child_btn" style="text-align: center;">' +
                    '<span class="btn text-dark">' +
                    '<a href="javascript:;" onclick="removeChildRow.call(this)" data-repeater-delete="" data-child-id="'+ (rowIndex - 1) + '.' + childIndex + '">' +
                    ' <i class="fa-solid fa-trash-can" style="font-size: 20px"></i>' +
                    '</a>' +
                    '</span>' +
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
                        console.log(checkboxInputField);
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

                    if(existingInputNumberCheck){
                        existingInputNumberCheck.value = checkboxValues;
                    }
                    else{
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

                    // Find related "bereich" inputs within the same table row
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
                    url: '{{ route('formular.store') }}',
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
                newField.setAttribute('class', 'row_index');
                newField.setAttribute('value', this.id);
                formfield.appendChild(newField);


                var trRow = document.getElementById("child_col" + this.id);
                var existingInput = trRow.querySelector('input[name="checkbox"]');
                var oldCheckbox = trRow.querySelector('input[name="old_checkbox"]');
                var checkboxesModal = document.getElementsByName('checkboxes[]');

                // Uncheck all checkboxes
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
                }


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
                number_check.closest('.auswahl_btn').remove();
                child.closest('.child_arrow').remove();
                if (parentDiv) {
                   const parentEle =  parentDiv.closest('td');
                    var childSpanElements = parentEle.getElementsByClassName("child_col");
                    var childSpanCount = childSpanElements.length;
                   console.log(childSpanCount - 1)
                    parentDiv.remove();
                    $(this).closest('.child_btn').remove();

                    // Update the "id" attribute of each child element
                    for (var i = 0; i < childSpanElements.length; i++) {
                        var elements = childSpanElements[i].querySelectorAll('[id*="child_col_title"]');
                         let currentElement =  childSpanElements[i];
                        // Set the new "id" value for the child element
                        console.log( elements);

                        // Iterate through the matched elements
                        elements.forEach(function(element) {
                            console.log('element', element)
                            //childSpanCount = 5;
                            element.innerHTML = '55';
                            // Check if the element's ID contains the desired text
                            // if (element.id.indexOf('child_col_title') !== -1) {
                            //     // Change the innerHTML of the element
                            //     element.innerHTML = "New Content"; // Replace "New Content" with the desired content
                            // }
                        });
                    }
                }
                updateCount();


            }
            // window.location.reload();
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
