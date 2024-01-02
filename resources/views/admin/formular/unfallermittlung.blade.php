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
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        <!--begin::Search-->
                        <div>
                            <h3 style="color: #2B6123">Unfallermittlung</h3>
                        </div>
                        <!--end::Search-->
                        <!--begin::Export buttons-->
                        <div id="kt_datatable_example_1_export" class="d-none"></div>
                        <!--end::Export buttons-->
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <form action="{{ url()->current() }}" method="GET">
                            <div class="d-flex align-items-center justify-content-end position-relative my-1">
                                <input type="text" style="border-radius: 5px 0 0 5px" data-kt-filter="search"
                                       name="search" value="{{ $search ?? '' }}"
                                       class="form-control form-control-solid w-200px ps-5" placeholder="Suche" />
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text btn text-white"
                                            style="border-radius: 0 5px 5px 0; background-color: #2B6123">
                                        <i class="tio-search"></i>
                                        Suche
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
                                <td><span class="text-dark"><strong>{{ @$ansSubmission->formulars->title }}</strong></span></td>
                                {{-- <td><span class="text-dark">{{ @$ansSubmission->userId->vorname }}</span></td> --}}
                                <td><span class="text-dark">{{ @$ansSubmission->userId->firmenname }}</span></td>
                                <td><span class="text-dark">{{ @$ansSubmission->userId->standort }}</span></td>
                                <td><span class="text-dark">{{ @$ansSubmission->userId->abteilung }}</span></td>
                                <td><span class="text-dark">
                                            {{ $ansSubmission->userAnswers->unique('aufgaben_id')->count() }}
                                        </span>
                                </td>
                                <td>
                                    <span class="text-dark">{{ @$ansSubmission->userAnswers->unique('bereich_id')->count() }}</span>
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
                                            <a href="{{ route('formular.submission.destroy', $ansSubmission->id) }}"
                                               class="btn btn-sm"><i class="fa fa-trash"></i></a>
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
            $('.form-check-input').on('change', function() {
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
                    success: function(response) {
                        toastr.success('Status updated successfully', 'Success');
                    },
                    error: function(xhr, status, error) {}
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
