@extends('layouts.master')
@section('content')
    <style>
        @media only screen and (max-width: 600px) {
            .kunde {
                display: none;
            }
            .kunden {
                margin-right: 20px;
            }
        }
    </style>
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row g-5 g-xl-10">
            <div class="card-p-0 card-flush">
                <div class="py-5 gap-2 d-flex">
                    <div class="card-toolbar flex-row-fluid gap-5 mt-2 kunden">
                        <h3 class="" style="color: #2B6123">Kunden</h3>
                    </div>
                    <div class="flex-row-fluid col-6 mt-1">
                        <a href="{{ route('user.create') }}" data-repeater-delete class="btn text-white"
                           style="background-color: #F49738; padding: 10px">
                            <i class="fa fa-plus text-white"></i> <span class="kunde">Kunde</span>
                        </a>
                    </div>
                    <div class="" style="text-align: right;">
                        <!--begin::Search-->
                        <form action="{{url()->current()}}" method="GET">
                            <div class="d-flex align-items-center position-relative my-1">
                                <div class="input-group">
                                    <input type="text" style="border-radius: 5px 0 0 5px" data-kt-filter="search"
                                           name="search" value="{{$search??''}}"
                                           class="form-control form-control-solid ps-5" placeholder="Suche">
                                    <button type="submit" class="input-group-text btn text-white"
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
                        <!--end::Search-->
                    </div>

                </div>

                <div class="card-body table-responsive">
                    <table class="table align-middle border rounded table-row-dashed fs-6 g-5 table-bordered"
                           style="padding: 0 5px">
                        <thead style="background-color: #2B6123">
                        <tr class="text-start text-white fw-bold fs-7 text-uppercase">
                            <th class="min-w-10px">ID</th>
                            <th class="min-w-80px">Firmenname</th>
                            <th class="min-w-80px">Standort</th>
                            <th class="min-w-80px">Abteilung</th>
                            <th class="min-w-80px">Berichte</th>
                            <th class="min-w-80px">zuständige BG</th>
                            <th class="min-w-80px">Unternehmensgröße</th>

                            <th class="min-w-80px">Vorname</th>
                            <th class="min-w-80px">Nachname</th>
                            <th class="min-w-80px">Strasse</th>
                            <th class="min-w-80px">Hausnr</th>
                            <th class="min-w-80px">PLZ</th>
                            <th class="min-w-80px">Wohnort</th>
                            <th class="min-w-80px">Telefonnummer</th>
                            <th class="min-w-80px">Email</th>
                            <th class="min-w-80px">Zugang</th>
                            <th class="min-w-100px">Action</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                        @foreach($users as $key=>$user)
                            <tr class="odd">
                                <td>
                                    {{$key + $users->firstItem()}}
                                </td>
                                <td>
                                    <span class="text-dark"><strong>{{ $user->firmenname }}</strong></span>
                                </td>
                                <td>
                                    <span class="text-dark">{{ $user->standort }}</span>
                                </td>
                                <td>
                                    <span class="text-dark">{{ $user->abteilung }}</span>
                                </td>

                                <td>
                                    <span class="text-dark">{{ $user->berichte }}</span>
                                </td>
                                <td>
                                    <span class="text-dark">{{ $user->responsible_BG }}</span>
                                </td>
                                <td>
                                    <span class="text-dark">{{ $user->company_size }}</span>
                                </td>


                                <td>
                                    <span class="text-dark">{{ $user->vorname }}</span>
                                </td>
                                <td>
                                    <span class="text-dark">{{ $user->nachname }}</span>
                                </td>

                                <td>
                                    <span class="text-dark">{{ $user->strasse }}</span>
                                </td>
                                <td>
                                    <span class="text-dark">{{ $user->hasunr }}</span>
                                </td>
                                <td>
                                    <span class="text-dark">{{ $user->plz }}</span>
                                </td>
                                <td>
                                    <span class="text-dark">{{ $user->wohnort }}</span>
                                </td>
                                <td>
                                    <span class="text-dark">{{ $user->phone }}</span>
                                </td>
                                <td>
                                    <span class="text-dark">{{ $user->email }}</span>
                                </td>

                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                               data-user-id="{{ $user->id }}" id="flexSwitchCheckDefault"
                                               @if ($user->status === 1) checked @endif>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('user.edit',$user->id) }}"
                                           class="btn btn-sm btn-light-dark me-2 mb-2" style="display: inline">
                                            <i class="ki-duotone ki-user-edit fs-5"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span><span
                                                    class="path4"></span><span class="path5"></span></i>
                                        </a>
                                        <a href="{{ route('user.delete',$user->id) }}" data-repeater-delete
                                           class="btn btn-sm btn-light-danger mb-2" style="display: inline">
                                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span><span
                                                    class="path4"></span><span class="path5"></span></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    {{ $users->links() }}
                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.form-check-input').on('change', function () {
                var userId = $(this).data('user-id');
                var status = $(this).is(':checked') ? 1 : 0;
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('send-email') }}',
                    data: {
                        userId: userId,
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
@endsection
