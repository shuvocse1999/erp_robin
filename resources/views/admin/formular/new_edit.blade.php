@extends('layouts.master')
@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="container">
            <form id="createForm" action="{{ route('formular.update',$formular->id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-5 col-sm-6 col-md-3 col-lg-3 col-xl-2 mb-3">
                        <a href="{{ route('formular.index') }}" style="color: #2B6123"
                           class="btn fontSize">
                            <i class="fa-solid fa-arrow-left" style="color: #2B6123"></i> Vorlagen
                        </a>
                    </div>
                    <div class="col-7 col-sm-6 col-md-9 col-lg-3 col-xl-4 mb-3">
                        <select class="form-select fontSize" data-control="select2" name="kunde" id="kunde"
                                data-placeholder="Kunde"
                                style="BORDER: 1px solid #2B6123 !important; --bs-gray-300: 1px solid #2B6123 !important;"
                                required>
                            <option></option>
                            <option value=" ">Choose one</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $formular->user_id == $user->id ? 'selected':'' }}>
                                    {{ $user->vorname }} {{ $user->nachname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-7 col-sm-9 col-md-9 col-lg-4 col-xl-4 mb-2">
                        <input class="form-control fontSize required-field" id="titel" name="titel" value="{{ $formular->title }}"
                               placeholder="Titel" style="border: 1px solid #2B6123; --bs-gray-500: #2B6123;" required>
                    </div>
                    <div class="col-5 col-sm-3 col-md-3 col-lg-2 col-xl-2 mb-3" style="text-align: right">
                        <button type="submit" class="btn btn-warning text-white fontSize" id="saveBtn"
                                style="background-color: #F49738">
                            Speichern
                        </button>
                    </div>
                </div>
                <div class="mb-2 text-white"
                     style="display: flex; text-align: center; font-size: 16px; background-color: #2B6123; padding: 12px 0 12px 0px; flex-wrap: wrap;">
                    <div class="col-md-6 col-sm-12 mb-2" style="flex: 1;">
                        <strong>Aufgabe</strong>
                    </div>
                    <div class="col-md-2 col-sm-12 mb-2" style="flex: 1;">
                        <strong>Position</strong>
                    </div>
                    <div class="col-md-2 col-sm-12 mb-2" style="flex: 1;">
                        <strong>Auswahl</strong>
                    </div>
                    <div class="col-md-2 col-sm-12 mb-2" style="flex: 1;">
                        <strong>Aktion</strong>
                    </div>
                </div>
                <div id="kt_docs_repeater_nested">
                    <div class="form-group">
                        <div data-repeater-list="aufgaben">
                            @foreach($formular->aufgabes as $index =>$aufgabe)
                                <div data-repeater-item class="data-repeater-item parent-div">
                                    <div class="form-group row mb-5">
                                        <div class="col-md-6 d-flex align-items-center">
                                            <div class="col-1">
                                                <span class="bereich-index text-bold">{{ $index+1 }}</span>
                                            </div>
                                            <div class="col-11">
                                                <input type="text" name="name" value="{{ $aufgabe->name }}"
                                                       class="form-control mb-2 mb-md-0 required-field" placeholder="Bereich"/>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div style="display: flex; justify-content: center">
                                                <a href="#" class="btn btn-sm move-up">
                                                    <i class="fa-solid fa-arrow-up" style="font-size: 27px"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm move-down">
                                                    <i class="fa-solid fa-arrow-down" style="font-size: 27px"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-2">

                                        </div>
                                        <div class="col-md-2">
{{--                                           <div class="d-flex">--}}
{{--                                               <div class="form-check form-check-custom form-check-solid me-2">--}}
{{--                                                   <input class="form-check-input" name="duplicate" type="checkbox" id="flexCheckDefault" />--}}
{{--                                               </div>--}}
{{--                                               <div>--}}
                                                   <a href="javascript:;" data-repeater-delete
                                                      class="btn btn-sm btn-flex btn-light-danger mt-3 mt-md-0">
                                                       <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span
                                                               class="path2"></span><span class="path3"></span><span
                                                               class="path4"></span><span class="path5"></span></i>
                                                   </a>
{{--                                               </div>--}}
{{--                                           </div>--}}
                                        </div>
                                    </div>
                                    <div class="form-group mb-5">
                                        <div class="">
                                            <div class="inner-repeater">
                                                <div data-repeater-list="bereich"
                                                     class="mb-5 childDiv">
                                                    @foreach($aufgabe->bereiches as $index => $bereich)
                                                        <div data-repeater-item class="row mt-2 child-index">
                                                            <input type="hidden" class="old_checkbox"
                                                                   name="old_checkbox"
                                                                   value="{{ @$bereich->questionAnswerRelation->answer_sheet_id }}">
                                                            <div
                                                                class="col-md-5 child-div offset-md-1 d-flex align-items-center">
                                                                <div class="col-1">
                                                                    <span class="aufgaben-index">{{ $loop->parent->index+1 }}.{{ $index+1 }}</span>
                                                                </div>
                                                                <div class="col-11">
                                                                    <input type="text" name="name[]"
                                                                           class="form-control mb-2 mb-md-0 required-field"
                                                                           value="{{ $bereich->name }}"
                                                                           placeholder="Aufgaben"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div style="display: flex; justify-content: center">
                                                                    <a href="#" class="btn btn-sm move-up">
                                                                        <i class="fa-solid fa-arrow-up"
                                                                           style="font-size: 27px"></i>
                                                                    </a>
                                                                    <a href="#" class="btn btn-sm move-down">
                                                                        <i class="fa-solid fa-arrow-down"
                                                                           style="font-size: 27px"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="auswahl_btn">
                                                                    @if(isset($bereich->questionAnswerRelation->answer_sheet_id))
                                                                        <button type="button"
                                                                                class="btn open-modal-button selectedValuesContainer"
                                                                                data-toggle="modal"
                                                                                data-target="#dynamicModal">
                                                                            <i class="fa-solid fa-arrow-up-right-from-square fontSize14"
                                                                               style="font-size: 20px"></i>
                                                                            {{ $bereich->questionAnswerRelation->answer_sheet_id }}
                                                                        </button>
                                                                    @else
                                                                        <button type="button"
                                                                                class="btn open-modal-button selectedValuesContainer"
                                                                                data-toggle="modal"
                                                                                data-target="#dynamicModal">
                                                                            <i class="fa-solid fa-arrow-up-right-from-square fontSize14"
                                                                               style="font-size: 20px"></i>
                                                                        </button>
                                                                    @endif
                                                                    <input type="hidden" class="checkboxValues"
                                                                           name="checkbox[]"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <a href="javascript:;" data-repeater-delete
                                                                   class="btn btn-sm btn-flex btn-light-danger">
                                                                    <i class="ki-duotone ki-trash fs-5"><span
                                                                            class="path1"></span><span
                                                                            class="path2"></span><span
                                                                            class="path3"></span><span
                                                                            class="path4"></span><span
                                                                            class="path5"></span></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button class="btn btn-sm btn-flex btn-light-primary offset-md-1"
                                                        data-repeater-create
                                                        type="button">
                                                    <i class="ki-duotone ki-plus fs-5"></i>
                                                    Aufgabe
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <a href="javascript:;" data-repeater-create class="btn btn-flex btn-light-primary">
                            <i class="ki-duotone ki-plus fs-3"></i>
                            Bereich
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade dynamicModal" tabindex="-1" role="dialog">
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
{{--                                    <div class="col-2 text-end">--}}
{{--                                        <h1 class="text-white">Dropdown</h1>--}}
{{--                                    </div>--}}
{{--                                    <hr style="width: 100%; border: 1px solid #fff; margin: 5px 0 5px 0;">--}}
                                    @php $dropdownDisplayed = true; @endphp
                                @endif
                                <div class="col-12" style="display: flex; padding: 5px; flex-wrap: wrap;">
                                    <div class="col-2 d-flex justify-content-center">
                                        <div class="form-check">
                                            <input class="form-check-input aufgaben-checkbox" type="checkbox"
                                                   name="checkboxes[]" value="{{ $answersheet->id }}"
                                                   onclick="onlyOne(this)">
                                        </div>
                                    </div>
                                    <div class="col-10" style="display: flex; flex-wrap: wrap;">
                                        <div class="col-12">
                                            <h2 class="text-white">{{ $answersheet->title }}</h2>
                                        </div>
                                        @foreach($answersheet->answers as $answer)
                                            <div class="col-6 col-md-3 col-lg-3 col-xl-3"
                                                 style="background-color: {{ $answer->background_color }}; padding: 5px;">
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
                    <div class="modal-footer" style="display: flex; justify-content: center">
                        <button type="button" class="btn text-white" style="background-color: #F49738;"
                                id="saveCheckboxes">
                            SPEICHERN
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"
            integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).on("click", ".open-modal-button", function () {
            var aufgabenIndices = $(this).closest('.child-index').find('.aufgaben-index').text();
            var identifier = $(this).closest('.child-index').find('.aufgaben-identifier').val();
            $('#checkboxForm .aufgaben-identifier').val(identifier);
            var containerId = 'selectedValuesContainer' + aufgabenIndices;
            $(this).closest('.child-index').find('.selectedValuesContainer').attr('id', containerId);
            var uniqueId = 'child-index' + aufgabenIndices;
            $(this).closest('.childDiv').find('.child-index').attr('id', uniqueId);
            var formfield = document.getElementById('checkboxForm');
            var newField = document.createElement('input');
            newField.setAttribute('type', 'hidden');
            newField.setAttribute('name', 'row_index');
            newField.setAttribute('class', 'row_index');
            newField.setAttribute('value', aufgabenIndices);
            formfield.appendChild(newField);

            var existingInput = document.getElementById(containerId).textContent.trim().toLowerCase();
            var checkboxesModal = document.getElementsByName('checkboxes[]');
            checkboxesModal.forEach((item) => {
                var itemValue = item.value.trim().toLowerCase();
                item.checked = false;
                if (itemValue === existingInput) {
                    item.checked = true;
                }
            });

            var modalId = $('.dynamicModal').attr('id', 'dynamicModal' + aufgabenIndices);
            modalId.modal('show');
        });
        $('#saveCheckboxes').click(function () {
            var formData = $('#checkboxForm').serializeArray();
            var checkboxInputField = null;
            var checkboxValues = null;

            formData.map(function (item) {
                if (item.name == "row_index") {
                    checkboxInputField = item.value;
                }
                if (item.name == "checkboxes[]") {
                    checkboxValues = item.value;
                }
            });

            var selectedCheckboxes = $('input[name="checkboxes[]"]:checked').map(function () {
                return this.value;
            }).get();

            $('.checkboxValues').each(function () {
                var aufgabenIndices = $(this).closest('.child-index').find('.aufgaben-index').text();
                var uniqueId = 'checkboxValues_' + aufgabenIndices;
                $(this).attr('id', uniqueId);
                if (aufgabenIndices === checkboxInputField) {
                    $(this).val(selectedCheckboxes.join(','));
                }
            });

            var trRow = document.getElementById("child-index" + checkboxInputField);
            var numberCheck = document.getElementById("number_check" + checkboxInputField);

            if (trRow && numberCheck) {
                var existingInput = trRow.querySelector('input[name="checkbox"]');
                var existingInputNumberCheck = numberCheck.querySelector('input[name="checkbox"]');
                // console.log(existingInput);
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

            var aufgabenIndices = checkboxInputField;
            var itemValue = document.getElementById('selectedValuesContainer' + aufgabenIndices);
            if(checkboxValues != null){
                itemValue.textContent = checkboxValues;
            }
            else{
                var icon = '<i class="fas fa-arrow-up-right-from-square fontSize14" style="font-size: 20px"></i>';
                itemValue.innerHTML = icon;
            }


            $("#checkboxForm").trigger("reset");
            $('input[name="row_index"]').remove();
            // var modalId = '#dynamicModal' + aufgabenIndices;
            $('.dynamicModal').modal('hide');
        });
    </script>
    <script>
        function updateChildIndices(parent, newIndex) {
            parent.find('.aufgaben-index').each(function (index) {
                const aufgabenNumber = newIndex + '.' + (index + 1);
                $(this).text(aufgabenNumber);
            });
        }

        function moveChildToAnotherParent(childSection, newParent) {
            const oldParent = childSection.closest('.parent-div');
            childSection.detach().appendTo(newParent.find('[data-repeater-list="bereich"]'));
            updateChildIndices(oldParent, oldParent.find('.bereich-index').text());
            updateChildIndices(newParent, newParent.find('.bereich-index').text());
        }

        $(document).on("click", ".move-up", function () {
            const childSection = $(this).closest('[data-repeater-item]');
            const previousChildSection = childSection.prev('[data-repeater-item]');
            if (previousChildSection.length > 0) {
                childSection.detach().insertBefore(previousChildSection);
                updateChildIndices(childSection.closest('.parent-div'), childSection.closest('.parent-div').find('.bereich-index').text());
            } else {
                const parentDiv = childSection.closest('.parent-div');
                const previousParentRepeaterItem = parentDiv.closest('[data-repeater-item]').prev('[data-repeater-item]');
                if (previousParentRepeaterItem.length > 0) {
                    moveChildToAnotherParent(childSection, previousParentRepeaterItem);
                }
            }
        });
        $(document).on("click", ".move-down", function () {
            const childSection = $(this).closest('[data-repeater-item]');
            const nextChildSection = childSection.next('[data-repeater-item]');
            if (nextChildSection.length > 0) {
                childSection.detach().insertAfter(nextChildSection);
                updateChildIndices(childSection.closest('.parent-div'), childSection.closest('.parent-div').find('.bereich-index').text());
            } else {
                const parentDiv = childSection.closest('.parent-div');
                const nextParentRepeaterItem = parentDiv.closest('[data-repeater-item]').next('[data-repeater-item]');
                if (nextParentRepeaterItem.length > 0) {
                    moveChildToAnotherParent(childSection, nextParentRepeaterItem);
                }
            }
        });
    </script>
    <script>
        function updateBereichIndices() {
            var bereichIndices = $('.bereich-index');
            bereichIndices.each(function (index) {
                var bereichNumber = index + 1;
                $(this).text(bereichNumber);
            });
        }

        function updateIndexNumbers(bereichNumber, childIndex) {
            var aufgabenIndices = $(childIndex).closest('.parent-div').find('.aufgaben-index');
            aufgabenIndices.each(function (index) {
                var aufgabenNumber = bereichNumber + '.' + (index + 1);
                $(this).text(aufgabenNumber);
            });
        }

        $('#kt_docs_repeater_nested').repeater({
            repeaters: [{
                selector: '.inner-repeater',
                show: function () {
                    $(this).slideDown();
                    var aufgabenIndexElement = $(this).closest('.childDiv').find('.aufgaben-index');
                    var currentIndex = aufgabenIndexElement.length;
                    var bereichIndex = $(this).closest('.parent-div').find('.bereich-index').text();
                    var aufgabenIndices = bereichIndex + '.' + currentIndex;
                    var containerId = 'selectedValuesContainer' + (aufgabenIndices);

                    $(this).closest('.child-index').find('.selectedValuesContainer').attr('id', containerId);
                    var element = document.getElementById(containerId);
                    if (element) {
                        var icon = '<i class="fas fa-arrow-up-right-from-square fontSize14" style="font-size: 20px"></i>';
                        element.innerHTML = icon;
                    } else {
                        console.log("Element not found");
                    }
                    var bereichIndices = $(this).closest('.parent-div').find('.bereich-index');
                    if (bereichIndices.length > 0) {
                        var lastNumber = bereichIndices.text();
                        updateIndexNumbers(lastNumber, this);
                    } else {
                        console.log('No elements with class "bereich-index" found.');
                    }
                },
                hide: function (deleteElement) {
                    var len = $(this).closest('.parent-div').find('.child-index');
                   if(len.length > 1){
                       $(this).slideUp(deleteElement);
                   }
                }
            }],
            show: function () {
                $(this).slideDown();
                $(this).find('[data-repeater-list="bereich"] [data-repeater-item]:not(:first)').remove();
                updateBereichIndices();
                var currentIndex = 1;
                var bereichIndex = $(this).closest('.parent-div').find('.bereich-index').text();
                var aufgabenIndices = bereichIndex + '.' + currentIndex;
                var containerId = 'selectedValuesContainer' + aufgabenIndices; // Remove unnecessary parentheses
                var selectedValuesContainer = $(this).closest('.parent-div').find('.selectedValuesContainer');
                selectedValuesContainer.attr('id', containerId);
                selectedValuesContainer.html('<i class="fas fa-arrow-up-right-from-square fontSize14" style="font-size: 20px"></i>');
                var bereichIndices = $(this).closest('.parent-div').find('.bereich-index');
                if (bereichIndices.length > 0) {
                    var lastNumber = bereichIndices.text();
                    updateIndexNumbers(lastNumber, this);
                } else {
                    console.log('No elements with class "bereich-index" found.');
                }
            },
            hide: function (deleteElement) {
                var outerRepeaters =$(this).siblings('.parent-div');
                var innerRepeaters = $(this).closest('.parent-div').find('.child-index');

                if (outerRepeaters.length >= 1) {
                    $(this).slideUp(deleteElement);
                } else {
                    console.log('This outer-repeater cannot be removed because it is the only one.');
                }
                if (innerRepeaters.length > 1) {
                    $(this).slideUp(deleteElement);
                } else {
                    console.log('This inner-repeater cannot be removed because it is the only one.');
                }
            }


        });


    </script>
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $("#saveBtn").click(function (e) {--}}
{{--                e.preventDefault();--}}
{{--                console.log("Save button clicked");--}}
{{--                $("#createForm").submit();--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

    <script>
        $(document).ready(function () {
            $("#saveBtn").click(function (e) {
                e.preventDefault();
                var isValid = true;
                $(".required-field").each(function () {
                    if ($(this).val() === "") {
                        isValid = false;
                        $(this).addClass("is-invalid");
                    } else {
                        $(this).removeClass("is-invalid");
                    }
                });
                if (isValid) {
                    // unsavedChanges = false; // Reset the flag since changes are saved
                    console.log("Save button clicked");
                    $("#createForm").submit();
                } else {
                    alert("Bitte füllen Sie alle erforderlichen Felder aus.");
                }
            });
        });
    </script>
    <script>
        function onlyOne(checkbox) {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            const group = checkbox.getAttribute('data-group');
            checkboxes.forEach((cb) => {
                if (cb.getAttribute('data-group') === group && cb !== checkbox) {
                    cb.checked = false;
                }
            });
        }
    </script>
@endsection
