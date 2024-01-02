@extends('layouts.master')
@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row g-5 g-xl-10">
            <div class="card card-p-0 card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">

                    <div class="card-title">
                        <!--begin::Search-->
                        <form action="{{url()->current()}}" method="GET">
                            <div class="d-flex align-items-center position-relative my-1">
                                <input type="text" style="border-radius: 5px 0 0 5px" data-kt-filter="search"
                                       name="search" value="{{$search??''}}"
                                       class="form-control form-control-solid w-200px ps-5" placeholder="Suche"/>
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text btn btn-primary"
                                            style="border-radius: 0 5px 5px 0">
                                        <i class="tio-search"></i>
                                        Suche
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!--end::Search-->
                        <!--begin::Export buttons-->
                        <div id="kt_datatable_example_1_export" class="d-none"></div>
                        <!--end::Export buttons-->
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <a href="{{ route('clients.create') }}" data-repeater-delete
                           class="btn btn-primary mt-3 mt-md-8">
                            Create
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table
                        class="table align-middle border rounded table-row-dashed fs-6 g-5 table-bordered table-responsive"
                        style="padding: 0 5px">
                        <thead class="bg-primary">
                        <tr class="text-start text-white fw-bold fs-7 text-uppercase">
                            <th class="min-w-10px">SL</th>
                            {{--                            <th class="min-w-80px">Photo</th>--}}
                            <th class="min-w-80px">Firma</th>
                            <th class="min-w-80px">Vorname</th>
                            <th class="min-w-80px">Nachname</th>
                            <th class="min-w-80px">Adresse</th>
                            <th class="min-w-80px">Postleitzahl</th>
                            <th class="min-w-80px">Ort</th>
                            <th class="min-w-80px">Email</th>
                            <th class="min-w-80px">Telefon</th>
                            <th class="min-w-200px">Status</th>
                            <th class="min-w-200px">Priorität</th>
                            <th class="min-w-100px">Action</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                        @foreach($clients as $key=>$client)
                            <tr class="odd">
                                <td>
                                    {{$key + $clients->firstItem()}}
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $client->firma }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $client->vorname }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $client->nachname }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $client->adresse }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $client->postleitzahl }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $client->ort }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $client->email }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $client->telefon }}</span>
                                </td>
                                <td>
                                    <input type="hidden" name="client_id" value="{{ $client->id }}">

                                    <select
                                        class="statusDropdown form-select form-select-solid @if(isset($client->status)) text-white @endif"
                                        name="status" data-client-id="{{ $client->id }}"
                                        data-placeholder="Select an option" style="background-color: <?php
                                            if ($client->status == 'wartet') echo 'red';
                                            elseif ($client->status == 'bearbeitung') echo 'orange';
                                            elseif ($client->status == 'erledigt') echo 'green';
                                        ?>;">
                                        <option value="">Select an option</option>
                                        <option
                                            value="wartet" <?php if ($client->status === 'wartet') echo 'selected'; ?>>
                                            Wartet
                                        </option>
                                        <option
                                            value="bearbeitung" <?php if ($client->status === 'bearbeitung') echo 'selected'; ?>>
                                            Bearbeitung
                                        </option>
                                        <option
                                            value="erledigt" <?php if ($client->status === 'erledigt') echo 'selected'; ?>>
                                            Erledigt
                                        </option>
                                    </select>
                                </td>

                                <td>

                                    <select
                                        class="prioritaetDropdown form-select form-select-solid @if(isset($client->priorität)) text-white @endif"
                                        name="priorität" data-client-id="{{ $client->id }}"
                                        data-placeholder="Select an option"
                                        style="background-color: <?php
                                            if ($client->priorität == 'niedrig') echo 'green';
                                            elseif ($client->priorität == 'mittel') echo 'orange';
                                            elseif ($client->priorität == 'hoch') echo 'red';
                                        ?>;"
                                    >
                                        <option value="">Select an option</option>
                                        <option
                                            value="niedrig" <?php if ($client->priorität === 'niedrig') echo 'selected'; ?>>
                                            Niedrig
                                        </option>
                                        <option
                                            value="mittel" <?php if ($client->priorität === 'mittel') echo 'selected'; ?>>
                                            Mittel
                                        </option>
                                        <option
                                            value="hoch" <?php if ($client->priorität === 'hoch') echo 'selected'; ?>>
                                            Hoch
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap">
                                        <a href="{{route('clients.edit',$client->id)}}"
                                           class="btn btn-sm btn-light-dark mt-3 mt-md-2 me-2">
                                            <i class="ki-duotone ki-user-edit fs-5"><span class="path1"></span><span
                                                    class="path2"></span><span
                                                    class="path3"></span><span class="path4"></span><span
                                                    class="path5"></span></i>
                                        </a>
                                        <a href="{{ route('clients.delete',$client->id) }}" data-repeater-delete
                                           class="btn btn-sm btn-light-danger mt-3 mt-md-2">
                                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span
                                                    class="path2"></span><span
                                                    class="path3"></span><span class="path4"></span><span
                                                    class="path5"></span></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    {{ $clients->links() }}
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.card-body').on('change', '.statusDropdown, .prioritaetDropdown', function () {
                var dropdown = $(this);
                var clientId = dropdown.data('client-id');
                var selectedStatus = dropdown.val();
                var selectedPrioritaet = $('.prioritaetDropdown[data-client-id="' + clientId + '"]').val();

                // Prepare the data to be sent
                var data = {
                    _token: '{{ csrf_token() }}',
                    client_id: clientId,
                    status: selectedStatus,
                    prioritaet: selectedPrioritaet
                };
                $.ajax({
                    url: '{{ route('client.submit') }}',
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        var backgroundColor = '';
                        if (selectedStatus === 'wartet') {
                            backgroundColor = 'red';
                        } else if (selectedStatus === 'bearbeitung') {
                            backgroundColor = 'orange';
                        } else if (selectedStatus === 'erledigt') {
                            backgroundColor = 'green';
                        }
                        dropdown.css('background-color', backgroundColor);

                        var prioritaetBackgroundColor = '';
                        if (selectedPrioritaet === 'niedrig') {
                            prioritaetBackgroundColor = 'green';
                        } else if (selectedPrioritaet === 'mittel') {
                            prioritaetBackgroundColor = 'orange';
                        } else if (selectedPrioritaet === 'hoch') {
                            prioritaetBackgroundColor = 'red';
                        }
                        $('.prioritaetDropdown[data-client-id="' + clientId + '"]').css('background-color', prioritaetBackgroundColor);
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        // Handle errors
                    }
                });
            });
        });
    </script>

@endsection
