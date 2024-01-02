@extends('layouts.master')
@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="container">
            <form id="createForm" action="{{ route('formular.submission.update',$submission->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-5 col-sm-6 col-md-3 col-lg-3 col-xl-2 mb-3">
                        <a href="{{ route('formular.index') }}" style="color: #2B6123"
                           class="btn fontSize">
                            <i class="fa-solid fa-arrow-left" style="color: #2B6123"></i> Berichte
                        </a>
                    </div>
                    <div class="col-7 col-sm-6 col-md-9 col-lg-3 col-xl-4 mb-3">
                        <select class="form-select fontSize" data-control="select2" name="kunde" id="kunde"
                                data-placeholder="Kunde"
                                style="BORDER: 1px solid #2B6123 !important; --bs-gray-300: 1px solid #2B6123 !important;"
                                disabled>
                            <option></option>
                            <option value=" ">Choose one</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $submission->user_id == $user->id ? 'selected':'' }}>
                                    {{ $user->vorname }} {{ $user->nachname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-7 col-sm-9 col-md-9 col-lg-4 col-xl-4 mb-2">
                        <input class="form-control fontSize required-field" id="titel" name="titel"
                               value="{{ @$submission->formulars->title }}"
                               placeholder="Titel" style="border: 1px solid #2B6123; --bs-gray-500: #2B6123;" readonly>
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
                    <div class="col-md-4 col-sm-12 mb-2" style="flex: 1;">
                        <strong>Aufgabe</strong>
                    </div>
                    <div class="col-md-2 col-sm-12 mb-2" style="flex: 1;">
                        <strong>Answers</strong>
                    </div>
                    <div class="col-md-3 col-sm-12 mb-2" style="flex: 1;">
                        <strong>Photo</strong>
                    </div>
                    <div class="col-md-3 col-sm-12 mb-2" style="flex: 1;">
                        <strong>Comment</strong>
                    </div>
                </div>
                <div id="kt_docs_repeater_nested">
                    <div class="form-group">
                        <div data-repeater-list="aufgabens">
                            @php
                            $i = 1;
                            @endphp
                            @foreach($submission->userAnswers->groupBy('aufgaben_id') as $index=>$answerSubmission)
                                <input type="hidden" name="answer_submission_id" value="{{ @$submission->id }}">
                                <div data-repeater-item class="data-repeater-item parent-div">
                                    <input type="hidden" name="id"
                                           value="{{ @$answerSubmission->first()->aufgaben_id }}">
                                    <div class="form-group row mb-5">
                                        <div class="col-md-4 d-flex align-items-center">
                                            <div class="col-1">
{{--                                                @dd($index);--}}
                                                <span class="bereich-index text-bold">{{ $i++ }}</span>
                                            </div>
                                            <div class="col-11">
                                                <input type="text" name="name"
                                                       value="{{ @$answerSubmission->first()->aufgabens->name }}"
                                                       class="form-control mb-2 mb-md-0 required-field"
                                                       placeholder="Bereich" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-5">
                                        <div class="">
                                            <div class="inner-repeater">
                                                <div data-repeater-list="bereiches" class="mb-5 childDiv">
                                                    @foreach($answerSubmission as $berichIndex=>$bereich)
                                                        <div data-repeater-item class="row mt-2 child-index">
                                                            <input type="hidden" name="id"
                                                                   value="{{ $bereich->bereich_id }}">
                                                            <input type="hidden" name="userAnswerSubmissionId"
                                                                   value="{{ $bereich->id }}">
                                                            <input type="hidden" name="answer_sheet_id"
                                                                   value="{{ @$bereich->answer_sheet_id }}">

                                                            <div
                                                                class="col-md-3 child-div offset-md-1 d-flex align-items-center"
                                                                style="align-self: center;">
                                                                <div class="col-1">
                                                                    <span class="aufgaben-index">{{ $loop->parent->index+1 }}.{{ $berichIndex+1 }}</span>
                                                                </div>
                                                                <div class="col-11">
                                                                    <input type="text" name="name[]"
                                                                           class="form-control mb-2 mb-md-0 required-field"
                                                                           value="{{ @$bereich->bereiches->name }}"
                                                                           placeholder="Aufgaben" readonly/>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3" style="align-self: center;">
                                                                <div class="auswahl_btn">
                                                                    @php
                                                                        $answers = \App\Models\Answer::where('answer_sheet_id',$bereich->answer_sheet_id)->get();
                                                                    @endphp
                                                                    @if(isset($bereich->answer_sheet_id))
                                                                        @if($bereich->answer_sheet_id == 10)
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control"
                                                                                       placeholder="Text"
                                                                                       name="TextField"
                                                                                       value="{{ $bereich->textField }}"/>
                                                                            </div>
                                                                        @elseif($bereich->answer_sheet_id == 11)
                                                                            <div class="input-group">
                                                                                {{--                                                                                <input type="date" class="form-control"--}}
                                                                                {{--                                                                                       name="dateTime"--}}
                                                                                {{--                                                                                       value="{{  $bereich->dateTime }}">--}}
                                                                                {{--                                                                                <input type="datetime-local" class="form-control" name="dateTime" value="{{ $bereich->dateTime }}">--}}
                                                                                @php
                                                                                    // Assuming $bereich->dateTime is a valid datetime string
                                                                                    $formattedDateTime = \Carbon\Carbon::parse($bereich->dateTime)->format('Y-m-d H:i');
                                                                                @endphp

                                                                                <input type="datetime-local"
                                                                                       class="form-control"
                                                                                       name="dateTime"
                                                                                       value="{{ $formattedDateTime }}">

                                                                            </div>
                                                                        @elseif($bereich->answer_sheet_id == 12)
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control"
                                                                                       name="Zahlen"
                                                                                       value="{{  $bereich->Zahlen }}">
                                                                            </div>
                                                                        @elseif($bereich->answer_sheet_id == 13)
                                                                            @php
                                                                                $basePhotoUrl = "https://vbgenius1.bplaced.net/faisst/public/images/formular/";
                                                                                 $fullUrl = asset($basePhotoUrl . trim($bereich->Unterschrift, '[]\"'));
                                                                            @endphp
                                                                            <div class="input-group">
                                                                                <input type="hidden"
                                                                                       class="form-control"
                                                                                       name="Unterschrift"
                                                                                       value="{{  $bereich->Unterschrift }}">
                                                                                <img src="{{ asset($fullUrl) }}"
                                                                                     height="35px" width="70px">

                                                                            </div>
                                                                        @elseif($bereich->answer_sheet_id > 13)
                                                                            <select class="form-select" id="answerSelect"
                                                                                    data-control="select2"
                                                                                    data-placeholder="Select an option">
                                                                                <option></option>
                                                                                @foreach($answers as $answer)
                                                                                    <option value="{{ $answer->id }}" {{ $answer->id == $bereich->answer_id ? 'selected' : '' }}>{{ $answer->answer }}</option>
                                                                                @endforeach

                                                                            </select>
                                                                            <input type="hidden" name="answer_id" id="hiddenAnswerId" value="">
                                                                        @else
                                                                            @foreach($answers as $answer)
                                                                                <div
                                                                                    class="form-check form-check-custom form-check-solid m-2"
                                                                                    style="background-color: {{ $answer->background_color }}; padding: 5px; color: #000">
                                                                                    <input
                                                                                        onclick="onlyOne(this, '{{ $bereich->id }}')"
                                                                                        class="form-check-input"
                                                                                        type="checkbox" name="answer_id"
                                                                                        value="{{ $answer->id }}"
                                                                                        id="flexCheckChecked"
                                                                                        data-group="{{ $bereich->id }}"
                                                                                        {{ $answer->id == $bereich->answer_id ? 'checked' : '' }}
                                                                                    />
                                                                                    <label
                                                                                        class="form-check-label text-dark"
                                                                                        for="flexCheckChecked">
                                                                                        {{ $answer->answer }}
                                                                                    </label>
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    @else

                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3"
                                                                 style="align-self: center; display: flex; flex-wrap: wrap">

                                                                @php
                                                                    $photos = json_decode($bereich->photo);
                                                                @endphp
                                                                @if(count($photos) > 0)
                                                                    @foreach($photos as $photo)
                                                                        <div class="mb-2 d-flex">
                                                                            {{--                                                                            <a href="{{ asset('public/images/formular/'.$photo) }}">--}}
                                                                            {{--                                                                                <img--}}
                                                                            {{--                                                                                    src="{{ asset('public/images/formular/'.$photo) }}"--}}
                                                                            {{--                                                                                    class="image img-thumbnail"--}}
                                                                            {{--                                                                                    height="35px" width="70px"/>--}}
                                                                            {{--                                                                            </a>--}}
                                                                            <!--begin::Image input placeholder-->
{{--                                                                            <style>--}}
{{--                                                                                .image-input-placeholder {--}}
{{--                                                                                    background-image: url('svg/avatars/blank.svg');--}}
{{--                                                                                }--}}

{{--                                                                                [data-bs-theme="dark"] .image-input-placeholder {--}}
{{--                                                                                    background-image: url('svg/avatars/blank-dark.svg');--}}
{{--                                                                                }--}}
{{--                                                                            </style>--}}
                                                                            <div class="image-input image-input-outline mb-2" data-kt-image-input="true">
                                                                                <div class="image-input-wrapper w-70px h-35px" style="background-image: url('https://vbgenius1.bplaced.net/faisst/public/images/formular/{{ $photo }}')"></div>

                                                                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                                      data-kt-image-input-action="cancel"
                                                                                      data-bs-toggle="tooltip"
                                                                                      data-bs-dismiss="click"
                                                                                      title="Cancel avatar"
                                                                                      onclick="cancelAvatar('{{ $photo }}')">
                                                                                    <i class="ki-outline ki-cross fs-3"></i>
                                                                                </span>
                                                                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                                      data-kt-image-input-action="remove"
                                                                                      data-bs-toggle="tooltip"
                                                                                      data-bs-dismiss="click"
                                                                                      title="Remove avatar"
                                                                                      onclick="removeAvatar('{{ $photo }}')">
                                                                                <i class="ki-outline ki-cross fs-3"></i>
                                                                            </span>
                                                                            </div>

                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                                {{--                                                                <div class="mb-2">--}}
                                                                {{--                                                                    <input type="file" class="form-control"--}}
                                                                {{--                                                                           name="photo[]" multiple  accept="image/*"--}}
                                                                {{--                                                                           onchange="previewImage(this)">--}}
                                                                {{--                                                                    <img src="#" alt="Preview" id="imagePreview"--}}
                                                                {{--                                                                         style="display:none;"--}}
                                                                {{--                                                                         class="image img-thumbnail"--}}
                                                                {{--                                                                         height="35px" width="70px"/>--}}
                                                                {{--                                                                </div>--}}

                                                                <div class="mb-2">
                                                                    <input type="file" class="form-control" name="photo[]" multiple accept="image/*" onchange="previewMultipleImages(this)">
                                                                    <div class="preview-container"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2" style="align-self: center;">
                                                                <textarea style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;" class="form-control" name="comment" data-kt-autosize="true">{{ @$bereich->comment }}</textarea>
                                                            </div>

                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                                @endforeach--}}
                            @endforeach

                            {{--                            @endforeach--}}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"
            integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Add this script in the head or before the closing body tag -->




    <script>
        function cancelAvatar(photo) {
            // Implement AJAX logic to cancel the avatar (e.g., revert changes)
            console.log('Cancel clicked for photo:', photo);
        }

        function removeAvatar(photo, userAnswerSubmissionId) {
            console.log('Remove clicked for photo:', photo);
            $.ajax({
                url: "{{ route('submission.photo.delete') }}",
                type: 'GET',
                data: {
                    photo: photo,
                    userAnswerSubmissionId: {{ $bereich->id }}
                },
                success: function(response) {
                    // Handle success, update UI, etc.
                    console.log('Image removed successfully:', response);
                },
                error: function(error) {
                    // Handle error, show error message, etc.
                    console.error('Error removing image:', error);
                }
            });
        }
    </script>


    <script>
        $(document).ready(function () {
            // Update hidden field value when the select option changes
            $('#answerSelect').on('change', function () {
                $('#hiddenAnswerId').val($(this).val());
            });
        });
    </script>
    <script>
        function previewMultipleImages(input) {
            var previewContainer = $(input).siblings('.preview-container');
            previewContainer.empty(); // Clear previous previews

            var files = input.files;

            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();
                var file = files[i];

                reader.onload = function (e) {
                    var img = $('<img class="image img-thumbnail" height="35px" width="70px">');
                    img.attr('src', e.target.result);
                    previewContainer.append(img);
                }

                reader.readAsDataURL(file);
            }
        }
    </script>


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
                    console.log("Save button clicked");
                    $("#createForm").submit();
                } else {
                    alert("Bitte füllen Sie alle erforderlichen Felder aus.");
                }
            });
        });
    </script>
    <script>
        $('#kt_docs_repeater_nested').repeater({
            repeaters: [{
                selector: '.inner-repeater',
                show: function () {
                    $(this).slideDown();
                    var bereichIndices = $(this).closest('.parent-div').find('.bereich-index');
                    if (bereichIndices.length > 0) {
                        var lastNumber = bereichIndices.text();
                        updateIndexNumbers(lastNumber, this);
                    } else {
                        console.log('No elements with class "bereich-index" found.');
                    }
                },
                hide: function (deleteElement) {
                }
            }],
            show: function () {
                $(this).slideDown();
                updateBereichIndices();
                var bereichIndices = $(this).closest('.parent-div').find('.bereich-index');
                if (bereichIndices.length > 0) {
                    var lastNumber = bereichIndices.text();
                    updateIndexNumbers(lastNumber, this);
                } else {
                    console.log('No elements with class "bereich-index" found.');
                }
            },
            hide: function (deleteElement) {
                var innerRepeaters = $(this).closest('.parent-div').find('.child-index');
                if (innerRepeaters.length > 1) {
                    $(this).slideUp(deleteElement);
                } else {
                    console.log('This inner-repeater cannot be removed because it is the only one.');
                }
            }
        });


        function onlyOne(checkbox, groupId) {
            const checkboxes = document.querySelectorAll(`input[type="checkbox"][data-group="${groupId}"]`);
            checkboxes.forEach((cb) => {
                if (cb !== checkbox) {
                    cb.checked = false;
                }
            });
        }
    </script>

@endsection
