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
                                            style="border-radius: 0 5px 5px 0; background-color: #2B6123">
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
                            <th class="min-w-80px">Erstellt von</th>
                            <th class="min-w-80px">Kategorie</th>
                            <th class="min-w-80px">Beginn</th>
                            <th class="min-w-80px">Ende</th>
                            <th class="min-w-80px">Beschreibung</th>
                            <th class="min-w-80px">Dauer/Aufwand</th>
                            <th class="min-w-80px">Dieser Abs</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                        @foreach($tatigkeitsbericht as $key=>$item)
                            <tr class="odd">
                                <td>
                                    {{$key + $tatigkeitsbericht->firstItem()}}
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Standort }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Erstellt_von }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Kategorie }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Beginn }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Ende }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Beschreibung }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Dauer_Aufwand }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Dieser_Abs }}</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    {{ $tatigkeitsbericht->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
