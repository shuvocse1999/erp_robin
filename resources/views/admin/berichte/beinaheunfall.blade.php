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
                            <th class="min-w-80px">Vorbereitet von</th>
                            <th class="min-w-80px">Datum und Uhrzeit des Beinaheunfalls</th>
                            <th class="min-w-80px">Genauer Ort des Beinaheunfalls</th>
                            <th class="min-w-80px">Wähle die Kategorie aus-1</th>
                            <th class="min-w-80px">Wähle die Kategorie aus-2</th>
                            <th class="min-w-80px">Wähle die Kategorie aus-3</th>
                            <th class="min-w-80px">Wähle die Kategorie aus-4</th>
                            <th class="min-w-80px">Wähle die Kategorie aus-5</th>
                            <th class="min-w-80px">Beschreibe, wie es zum Beinaheunfall kam</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                        @foreach($beinaheunfall as $key=>$item)
                            <tr class="odd">
                                <td>
                                    {{$key + $beinaheunfall->firstItem()}}
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Standort }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Vorbereitet_von }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Datum }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Genauer_Beinaheunfalls }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->aus-1 }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->aus-2 }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->aus-3 }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->aus-4 }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->aus-5 }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Beschreibe }}</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    {{ $beinaheunfall->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
