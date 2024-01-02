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
                            <th class="min-w-80px">Anlass</th>
                            <th class="min-w-80px">Abteilung / Bereich</th>
                            <th class="min-w-80px">Gefährdung / Thema / Problem/ Missstand</th>
                            <th class="min-w-80px">Bild</th>
                            <th class="min-w-80px">Information / Mangel</th>
                            <th class="min-w-80px">Bemerkungen</th>
                            <th class="min-w-80px">Bewertung</th>
                            <th class="min-w-80px">Gesamtrisiko</th>
                            <th class="min-w-80px">Maßnahmenplanung</th>
                            <th class="min-w-80px">Übertrag in die Gefährdungsbeurteilung</th>
                            <th class="min-w-80px">created_at</th>
                            <th class="min-w-80px">updated_at</th>
                            <th class="min-w-80px">URL</th>

                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                        @foreach($begehung as $key=>$item)
                            <tr class="odd">
                                <td>
                                    {{$key + $begehung->firstItem()}}
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Standort }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Erstellt_von }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Anlass }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Abteilung_Bereich }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Thema_Problem_Missstand }}</span>
                                </td>
                                <td>
{{--                                    @php--}}
{{--                                        $imageUrls = explode("\n", $item->Bild);--}}
{{--                                    @endphp--}}
{{--                                    <div class="d-flex">--}}
{{--                                    @foreach($imageUrls as $img)--}}
{{--                                        <div style="height: 50px; width:50px; margin-right: 5px">--}}
{{--                                            <a href="{{$img}}" target="_blank"><img class="small-image zoom" src="{{ asset($img) }}" height="50px" width="50px"></a>--}}
{{--                                        </div>--}}

{{--                                    @endforeach--}}
{{--                                    </div>--}}
                                    @php
                                        $imageUrls = explode("\n", $item->Bild);
                                        $counter = 0;
                                    @endphp

                                    <div class="d-flex">
                                        @foreach($imageUrls as $img)
                                            <div style="height: 50px; width:50px; margin: 5px 5px 0 0">
                                                <a href="{{$img}}" target="_blank"><img class="small-image zoom" src="{{ asset($img) }}" height="50px" width="50px"></a>
                                            </div>

                                            @php
                                                $counter++;
                                                if ($counter % 3 === 0) {
                                                    echo '</div><div class="d-flex">';
                                                }
                                            @endphp
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Information_Mangel }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Bemerkungen }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Bewertung }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Gesamtrisiko }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Mabnahmenplanung }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->Ubertrag_Gefahrdungs }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->created_at }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $item->updated_at }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary"> <a href="{{ $item->URL }}">Link</a> </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    {{ $begehung->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection