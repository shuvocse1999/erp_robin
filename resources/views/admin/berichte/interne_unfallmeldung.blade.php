@extends('layouts.master')
@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row g-5 g-xl-10">
            <div class="card card-p-0 card-flush">
                {{--                <div class="card-toolbar flex-row-fluid gap-5 mt-2" style="text-align: right">--}}
                {{--                --}}
                {{--                </div>--}}
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">

                    <div class="card-title">
                        <!--begin::Search-->
                        <form action="{{url()->current()}}" method="GET">
                            <div class="d-flex align-items-center position-relative my-1">
                                <input type="text" style="border-radius: 5px 0 0 5px" data-kt-filter="search"
                                       name="search" value="{{$search??''}}"
                                       class="form-control form-control-solid w-200px ps-5" placeholder="Suche"/>
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text btn text-white"
                                            style="border-radius: 0 5px 5px 0;background-color: #2B6123">
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
                </div>
                <div class="card-body table-responsive">
                    <table class="table align-middle border rounded table-row-dashed fs-6 g-5 table-bordered table-responsive"
                           style="padding: 0 5px">
                        <thead style="background-color: #2B6123">
                        <tr class="text-center text-white fw-bold fs-7 text-uppercase">
                            <th class="min-w-10px">SL</th>
                            <th class="min-w-80px">Standort</th>
                            <th class="min-w-80px">Zuständige</th>
                            <th class="min-w-80px">erstellt von</th>
                            <th class="min-w-80px">abgeseschlossen am</th>
                            <th class="min-w-80px">Abteilung</th>
                            <th class="min-w-80px">Name des Verunfallten</th>
                            <th class="min-w-80px">Berufshauptgruppe</th>
                            <th class="min-w-80px">Zeitpunkt des Unfalls</th>
                            <th class="min-w-80px">Ausgefallene Arbeitstage</th>
                            <th class="min-w-80px">Art des Unfalls</th>
                            <th class="min-w-80px">Sonstige Schäden</th>
                            <th class="min-w-80px">Betroffene Körperteile</th>
                            <th class="min-w-80px">Art der Verletzung</th>
                            <th class="min-w-80px">Bauliche Einrichtung</th>
                            <th class="min-w-80px">Schwere des Unfalls</th>
                            <th class="min-w-80px">Korrekturmaßnahmen angezeigt</th>
                            <th class="min-w-80px">Korrekturmaßnahme</th>
                            <th class="min-w-80px">Maßnahme</th>
                            <th class="min-w-80px">Deadline</th>
                            <th class="min-w-80px">Status</th>
                            <th class="min-w-80px">Priorität</th>
                            <th class="min-w-80px">Abfrage</th>
                            <th class="min-w-80px">beschreibung</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                        @foreach($interne_unfallmeldung as $key=>$item)
                            <tr class="odd">
                                <td>
                                    {{$key + $interne_unfallmeldung->firstItem()}}
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->standort }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Zustandige }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->erstellt_von }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->abgeseschlossen_am }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Abteilung }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Name_des_Verunfallten }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Berufshauptgruppe }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Zeitpunkt_des_Unfalls }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Ausgefallene_Arbeitstage }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Art_des_Unfalls }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Sonstige_Schaden }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Betroffene_Korperteile }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Art_der_Verletzung }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Bauliche_Einrichtung }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Schwere_des_Unfalls }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Korrekturmabnahmen_angezeigt }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Korrekturmabnahme }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Mabnahme }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Deadline }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Status }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Prioritat }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Abfrage }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->beschreibung }}</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    {{ $interne_unfallmeldung->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
