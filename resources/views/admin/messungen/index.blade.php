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
                <div class="py-5 gap-2 d-flex justify-content-between">
                    <div class="d-flex">
                        <div class="card-toolbar flex-row-fluid gap-5 mt-2 me-4">
                            <h3 class="" style="color: #2B6123">Messungen</h3>
                        </div>
                        <button type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#kt_modal_1"
                                style="background:#F49738;">
                            Import
                        </button>

                        <div class="modal fade" tabindex="-1" id="kt_modal_1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Import CSV or Excel File</h3>

                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                             data-bs-dismiss="modal" aria-label="Close">
                                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                                    class="path2"></span></i>
                                        </div>
                                        <!--end::Close-->
                                    </div>
                                    <form action="{{ route('excel.import') }}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            @php
                                                $kunden = \App\Models\User::where('role_id',2)->get();
                                            @endphp
                                            <div>
                                                <div class="form-group mb-2">
                                                    <select class="form-control form-control-solid mb-3 mb-lg-0"
                                                            name="user_id"
                                                            data-control="select2" data-placeholder="Select Kunde">
                                                        <option></option>
                                                        <option value=" ">Choose kunde</option>
                                                        @foreach($kunden as $kunde)
                                                            <option
                                                                value="{{ $kunde->id }}">{{$kunde->vorname}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <hr>
                                            {{--                                        <p>Modal body text goes here.</p>--}}
                                            <div>
                                                <div class="form-group mb-2">
                                                    <input type="file" name="file" class="form-control"
                                                           accept=".xls, .xlsx">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="" style="text-align: right;">
                        <form action="{{url()->current()}}" method="GET">
                            <div class="d-flex align-items-center position-relative my-1">
                                <div class="input-group">
                                    <input type="text" style="border-radius: 5px 0 0 5px" data-kt-filter="search"
                                           name="search" value="{{$search??''}}"
                                           class="form-control form-control-solid ps-5" placeholder="Suche">
                                    <button type="submit" class="input-group-text btn text-white"
                                            style="border-radius: 0 5px 5px 0; background-color: #2B6123">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
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
{{--                            <th class="min-w-150px">Kunde</th>--}}
                            <th class="min-w-150px">Firmenname</th>
                            <th class="min-w-150px">Standort</th>
                            <th class="min-w-150px">Abteilung</th>
                            <th class="min-w-80px">Datum/Zeit</th>
                            <th class="min-w-80px">Temperatur</th>
                            <th class="min-w-80px">T_max</th>
                            <th class="min-w-80px">T_min</th>
                            <th class="min-w-80px">relative Luftfeuchtigkeit</th>
                            <th class="min-w-80px">Lärmpegel aktuell</th>
                            <th class="min-w-80px">La max</th>
                            <th class="min-w-80px">La min</th>
                            <th class="min-w-80px">Beleuchtungsstarke</th>
                            <th class="min-w-80px">CO2</th>
                            <th class="min-w-80px">CO2_max</th>
                            <th class="min-w-80px">CO2_min</th>
                            <th class="min-w-80px">TVOC</th>
                            <th class="min-w-80px">TVOC_max</th>
                            <th class="min-w-80px">TVOC_min</th>
                            <th class="min-w-80px">CO</th>
                            <th class="min-w-80px">CO_max</th>
                            <th class="min-w-80px">CO_min</th>
                            <th class="min-w-80px">PM1u0</th>
                            <th class="min-w-80px">PM1u0_max</th>
                            <th class="min-w-80px">PM1u0_min</th>
                            <th class="min-w-80px">PM2u5</th>
                            <th class="min-w-80px">PM2u5_max</th>
                            <th class="min-w-80px">PM2u5_min</th>
                            <th class="min-w-80px">PM10u</th>
                            <th class="min-w-80px">PM10u_max</th>
                            <th class="min-w-80px">PM10u_min</th>
                            <th class="min-w-80px">Action</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600 text-center">
                        @php
                            $kunden = \App\Models\User::where('role_id',2)->get();
                        @endphp
                        @foreach($messungens as $item)
                            <tr class="odd default">
                                <td>
                                    <div class="d-flex">
                                        <span class="text-dark">{{ $item->id }}
                                    </span>
                                        <span class="text-dark btn btn-sm toggle-icon"
                                              onclick="toggleMessungerList({{ $item->id }})">
                                    <i class="fa fa-chevron-down"></i>
                                    </span>
                                    </div>
                                </td>
{{--                                <td><span class="text-dark">--}}
{{--                                        {{ @$item->user->vorname }}--}}
{{--                                    </span></td>--}}
                                <td><span class="text-dark">
                                        {{ @$item->user->firmenname }}
                                    </span></td>
                                <td><span class="text-dark">
                                        {{ @$item->user->standort }}
                                    </span></td>
                                <td><span class="text-dark">
                                        {{ @$item->user->abteilung }}
                                    </span></td>
                                <td><span class="text-dark">{{ $item->A }}</span></td>
                                <td><span class="text-dark">{{ $item->B }}</span></td>
                                <td><span class="text-dark">{{ $item->C }}</span></td>
                                <td><span class="text-dark">{{ $item->D }}</span></td>
                                <td><span class="text-dark">{{ $item->E }}</span></td>
                                <td><span class="text-dark">{{ $item->H }}</span></td>
                                <td><span class="text-dark">{{ $item->I }}</span></td>
                                <td><span class="text-dark">{{ $item->J }}</span></td>
                                <td><span class="text-dark">{{ $item->N }}</span></td>
                                <td><span class="text-dark">{{ $item->AC }}</span></td>
                                <td><span class="text-dark">{{ $item->AD }}</span></td>
                                <td><span class="text-dark">{{ $item->AE }}</span></td>
                                <td><span class="text-dark">{{ $item->AF }}</span></td>
                                <td><span class="text-dark">{{ $item->AG }}</span></td>
                                <td><span class="text-dark">{{ $item->AH }}</span></td>
                                <td><span class="text-dark">{{ $item->AI }}</span></td>
                                <td><span class="text-dark">{{ $item->AJ }}</span></td>
                                <td><span class="text-dark">{{ $item->AK }}</span></td>
                                <td><span class="text-dark">{{ $item->AL }}</span></td>
                                <td><span class="text-dark">{{ $item->AM }}</span></td>
                                <td><span class="text-dark">{{ $item->AN }}</span></td>
                                <td><span class="text-dark">{{ $item->AO }}</span></td>
                                <td><span class="text-dark">{{ $item->AP }}</span></td>
                                <td><span class="text-dark">{{ $item->AQ }}</span></td>
                                <td><span class="text-dark">{{ $item->AR }}</span></td>
                                <td><span class="text-dark">{{ $item->AS }}</span></td>
                                <td><span class="text-dark">{{ $item->AT }}</span></td>
                                <td>
                                    <div class="d-flex">
                                        {{--                                       <span class="text-dark btn btn-sm toggle-icon" onclick="toggleMessungerList({{ $item->id }})">--}}
                                        {{--                                    <i class="fa fa-chevron-down"></i>--}}
                                        {{--                                    </span>--}}
                                        <span class="text-dark">
                                    <a href="{{route('messungen.destroy',$item->id)}}" class="btn btn-sm"><i
                                            class="fa fa-trash"></i></a>
                                </span>
                                    </div>
                                </td>
                            </tr>
                            @foreach($item->messungerList as $messungerListItem)
                                <tr class="odd default2 messungerList{{ $item->id }}" style="display: none"
                                    id="messungerList{{ $item->id }}_{{ $messungerListItem->id }}">
                                    <td><span class="text-dark">{{ $item->id }}</span></td>
                                    <td><span class="text-dark">
                                                            {{ @$item->user->firmenname }}
                                                        </span></td>
                                    <td><span class="text-dark">
                                        {{ @$item->user->standort }}
                                    </span></td>
                                    <td><span class="text-dark">
                                        {{ @$item->user->abteilung }}
                                    </span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->A }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->B }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->C }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->D }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->E }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->H }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->I }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->J }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->N }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->AC }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->AD }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->AE }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->AF }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->AG }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->AH }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->AI }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->AJ }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->AK }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->AL }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->AM }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->AN }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->AO }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->AP }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->AQ }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->AR }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->AS }}</span></td>
                                    <td><span class="text-dark">{{ $messungerListItem->AT }}</span></td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    {!! $messungens->links() !!}
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function toggleMessungerList(itemId) {
            var messungerList = $('#messungerList' + itemId);
            var messungerList1 = $('.messungerList' + itemId);
            console.log(messungerList);
            messungerList.toggle();
            messungerList1.toggle();
        }
    </script>
@endsection
