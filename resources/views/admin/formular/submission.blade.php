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
        <div class="row g-5 g-xl-10">
            <div class="card-p-0 card-flush">
                {{--                <div class="card-header align-items-center py-5 gap-2 gap-md-5">--}}
                {{--                    <div class="card-title">--}}
                {{--                        <!--begin::Search-->--}}
                {{--                        <div>--}}
                {{--                            <h3 style="color: #2B6123">Berichte</h3>--}}
                {{--                        </div>--}}
                {{--                        <!--end::Search-->--}}
                {{--                        <!--begin::Export buttons-->--}}
                {{--                        <div id="kt_datatable_example_1_export" class="d-none"></div>--}}
                {{--                        <!--end::Export buttons-->--}}
                {{--                    </div>--}}
                {{--                    <div class="card-toolbar d-flex justify-content-end gap-5">--}}
                {{--                        <form action="{{ url()->current() }}" method="GET" class="d-flex align-items-center position-relative my-1">--}}
                {{--                            <!-- Date Filter -->--}}
                {{--                            <div class="col-sm-6 col-lg-3">--}}
                {{--                                <label for="date" class="title-color d-flex" style="font-size: 14px">Select Date</label>--}}
                {{--                                <input type="date" name="date" id="from_date" value="{{ $date }}" class="form-control form-control-solid">--}}
                {{--                            </div>--}}

                {{--                            <!-- Filter Button -->--}}
                {{--                            <div class="col-sm-6 col-lg-3">--}}
                {{--                                <button id="filter-btn" type="submit" class="btn btn-light-primary">--}}
                {{--                                    <i class="tio-filter-list nav-icon"></i> Filter--}}
                {{--                                </button>--}}
                {{--                            </div>--}}

                {{--                            <!-- Search Filter -->--}}
                {{--                            <div class="input-group col-lg-6">--}}
                {{--                                <input type="text" data-kt-filter="search" name="search" value="{{ $search ?? '' }}" class="form-control form-control-solid" placeholder="Search" style="border-radius: 5px 0 0 5px;" />--}}
                {{--                                <div class="input-group-append">--}}
                {{--                                    <button type="submit" class="btn text-white" style="border-radius: 0 5px 5px 0; background-color: #2B6123;">--}}
                {{--                                        <i class="tio-search"></i> Search--}}
                {{--                                    </button>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </form>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        <!--begin::Search-->
                        <div>
                            <h3 style="color: #2B6123">Berichte</h3>
                        </div>
                        <!--end::Search-->
                        <!--begin::Export buttons-->
                        <div id="kt_datatable_example_1_export" class="d-none"></div>
                        <!--end::Export buttons-->
                    </div>
                    <div class="card-toolbar d-flex flex-wrap justify-content-between col-12">
                        <form action="{{ url()->current() }}" method="GET"
                              class="align-items-center position-relative my-1 col-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="d-flex flex-wrap">
                                <div class="col-8 col-md-8">
{{--                                    <label for="date" class="title-color" style="font-size: 14px">Select Date</label>--}}
                                    {{--                                    <input type="date" name="date" value="{{ $date }}"--}}
                                    {{--                                           class="form-control form-control-solid">--}}
{{--                                    <input class="form-control form-control-solid" placeholder="Pick date rage"--}}
{{--                                           id="kt_daterangepicker_1" name="date" value="{{ $date }}"/>--}}
                                    <input class="form-control form-control-solid" placeholder="Datum auswählen" id="kt_daterangepicker_1" name="date" value="{{ $date }}"/>


                                </div>
                                <div class="col-4 col-md-4" style="align-self: end;">
                                    <button id="filter-btn" type="submit" class="btn btn-light-primary">
                                        <i class="tio-filter-list nav-icon"></i> Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                        <form action="{{ url()->current() }}" method="GET"
                              class="d-flex align-self-end justify-content-end position-relative my-1 col-12 col-sm-6 col-md-6 col-lg-6">
                            <!-- Search Filter -->
                            <div class="d-flex flex-wrap justify-content-end">
                                <div class="col-8">
                                    <input type="text" data-kt-filter="search" name="search"
                                           value="{{ $search ?? '' }}"
                                           class="form-control form-control-solid" placeholder="Suche"
                                           style="border-radius: 5px 0 0 5px;"/>
                                </div>
                                <div class="input-group-append">
{{--                                    <button type="submit" class="btn text-white"--}}
{{--                                            style="border-radius: 0 5px 5px 0; background-color: #2B6123;">--}}
{{--                                        <i class="tio-search"></i> Suche--}}
{{--                                    </button>--}}

                                    <button type="submit" class="btn text-white"
                                            style="border-radius: 0 5px 5px 0; background-color: #2B6123">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                            <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path
                                                d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"
                                                fill="#fff"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body table-responsive">
                    <table
                        class="table align-middle border rounded table-row-dashed fs-6 g-5 table-bordered table-responsive"
                        style="padding: 0 5px">
                        <thead class="" style="background-color: #2B6123">
                        <tr class="text-start text-white text-center fw-bold fs-7 text-uppercase">
                            <th class="min-w-10px">ID</th>
                            <th class="min-w-80px">Titel</th>
                            {{-- <th class="min-w-80px">Kunde</th> --}}
                            <th class="min-w-80px">Firmenname</th>
                            <th class="min-w-80px">Standort</th>
                            <th class="min-w-80px">Abteilung</th>
                            <th class="min-w-80px">Bereiche</th>
                            <th class="min-w-80px">Aufgaben</th>
                            <th class="min-w-80px">Datum</th>
{{--                            <th class="min-w-80px">Status</th>--}}
                            <th class="min-w-80px">Aktion</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600 text-center">
                        @foreach ($ansSubmissions as $ansSubmission)
                            <input type="hidden" name="user_id" value="{{ @$ansSubmission->userId->id }}">
                            <tr class="odd">
                                <td><span class="text-dark">{{ $ansSubmission->id }}</span></td>
                                <td><span
                                        class="text-dark"><strong>{{ @$ansSubmission->formulars->title }}</strong></span>
                                </td>
                                {{-- <td><span class="text-dark">{{ @$ansSubmission->userId->vorname }}</span></td> --}}
                                <td><span class="text-dark">{{ @$ansSubmission->userId->firmenname }}</span></td>
                                <td><span class="text-dark">{{ @$ansSubmission->userId->standort }}</span></td>
                                <td><span class="text-dark">{{ @$ansSubmission->userId->abteilung }}</span></td>
                                <td><span class="text-dark">
                                            {{ $ansSubmission->userAnswers->unique('aufgaben_id')->count() }}
                                        </span>
                                </td>
                                <td>
                                    <span
                                        class="text-dark">{{ @$ansSubmission->userAnswers->unique('bereich_id')->count() }}</span>
                                </td>
                                <td>
                                    <span class="text-dark">{{ $ansSubmission->created_at->format('d.m.Y') }}</span>
                                </td>
{{--                                <td>--}}
{{--                                    <div class="form-check form-switch">--}}
{{--                                        <input class="form-check-input" type="checkbox" role="switch"--}}
{{--                                               data-submission-id="{{ $ansSubmission->id }}" id="flexSwitchCheckDefault"--}}
{{--                                               @if ($ansSubmission->status === 1) checked @endif>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="text-dark">
{{--                                            <a href="{{route('view-generate-pdf', $ansSubmission->id) }}"--}}
{{--                                               class="btn btn-sm"><i class="fa fa-eye"></i></a>--}}
                                            <a href="{{ @$ansSubmission->pdf_path }}" target="_blank"
                                               class="btn btn-sm"><i class="fa fa-eye"></i></a>
                                        </div>
                                        <div class="text-dark">
                                            <a href="{{route('formular.submission.edit', $ansSubmission->id) }}"
                                               class="btn btn-sm"><i class="fa fa-edit"></i></a>
                                        </div>
                                        <div class="text-dark">
                                            <a href="{{ route('formular.submission.destroy', $ansSubmission->id) }}"
                                               class="btn btn-sm"
                                               onclick="return confirm('Are you sure you want to delete this form?')"><i
                                                    class="fa fa-trash"></i></a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    {!! $ansSubmissions->links() !!}
                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#kt_daterangepicker_1').daterangepicker({
                locale: {
                    // format: 'DD.MM.YYYY', // German date format
                    // separator: ' - ',
                    applyLabel: 'Anwenden',
                    cancelLabel: 'Abbrechen',
                    fromLabel: 'Von',
                    toLabel: 'Bis',
                    customRangeLabel: 'Benutzerdefiniert',
                    weekLabel: 'W',
                    daysOfWeek: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
                    monthNames: [
                        'Januar',
                        'Februar',
                        'März',
                        'April',
                        'Mai',
                        'Juni',
                        'Juli',
                        'August',
                        'September',
                        'Oktober',
                        'November',
                        'Dezember'
                    ],
                    firstDay: 1
                }
            });
        });
    </script>

    <script>
        // $(document).ready(function (){
        //     $("#kt_daterangepicker_1").daterangepicker();
        // });
        $(document).ready(function () {
            $('.form-check-input').on('change', function () {
                var submissionId = $(this).data('submission-id');
                console.log(submissionId);
                var status = $(this).is(':checked') ? 1 : 0; // Assuming 1 is for "on" and 0 is for "off"
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('update-status') }}',
                    data: {
                        submission_id: submissionId,
                        status: status,
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function (response) {
                        toastr.success('Status updated successfully', 'Success');
                    },
                    error: function (xhr, status, error) {
                    }
                });
            });
        });
    </script>

    <script>
        function submitForm() {
            document.getElementById("pdfForm").submit();
        }
    </script>
@endsection
