@extends('layouts.user.master')
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

            <div class="py-5 gap-2 d-flex">
                <div class="card-toolbar flex-row-fluid gap-5 mt-2">
                    <h3 class="" style="color: #2B6123">Vorlagen</h3>
                </div>

                <div class="" style="text-align: right;">
                    <!--begin::Search-->
                    <form action="{{url()->current()}}" method="GET">
                        <div class="d-flex align-items-center position-relative my-1">
                            <div class="input-group">
                                <input type="text" style="border-radius: 5px 0 0 5px" data-kt-filter="search" name="search" value="{{$search??''}}" class="form-control form-control-solid ps-5" placeholder="Suche">
                                <button type="submit" class="input-group-text btn text-white" style="border-radius: 0 5px 5px 0; background-color: #2B6123">
                                    <i class="tio-search"></i> Suche
                                </button>
                            </div>
                        </div>
                    </form>
                    <!--end::Search-->
                </div>

            </div>
            <div class="card-body table-responsive">
                <table class="table align-middle border rounded table-row-dashed fs-6 g-5 table-bordered table-responsive" style="padding: 0 5px">
                    <thead class="" style="background-color: #2B6123">
                        <tr class="text-start text-white text-center fw-bold fs-7 text-uppercase">
                            <th class="min-w-10px">ID</th>
                            <th class="min-w-80px">Kunde</th>
                            <th class="min-w-80px">Title</th>
                            <th class="min-w-80px">Bereiche</th>
                            <th class="min-w-80px">Aufgaben</th>
                            <th class="min-w-80px">Datum</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600 text-center">
                        @foreach($formulars as $formular)
                        <tr class="odd">
                            <td><span class="text-dark">{{$formular->id}}</span></td>
                            <td><span class="text-dark">{{@$formular->users->vorname}} {{@$formular->users->nachname}}</span></td>
                            <td><span class="text-dark">{{$formular->title}}</span></td>
                            <td><span class="text-dark">{{$formular->aufgabes->count() ?? ""}}</span></td>
                            <td><span class="text-dark">
                                    @php
                                    $bereichCount = 0;
                                    foreach ($formular->aufgabes as $aufgabe) {
                                    $bereichCount += $aufgabe->bereiches->count();
                                    }
                                    echo $bereichCount;
                                    @endphp
                                </span>
                            </td>
                            <td><span class="text-dark">{{$formular->created_at->format('d.m.Y') }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                {!! $formulars->links() !!}
            </div>

        </div>
    </div>
</div>
@endsection
