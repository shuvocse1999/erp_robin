@extends('layouts.master')
@section('content')
    <style>
        @media only screen and (max-width: 600px) {
            .vorlage{
                display: none;
            }
            .vorlagen{
                margin-right: 30px;
            }
        }
    </style>
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row g-5 g-xl-10">
            <div class="card-p-0 card-flush">
                <div class="py-5 gap-2 d-flex">
                    <div class="card-toolbar flex-row-fluid gap-5 mt-2 vorlagen">
                        <h3 class="" style="color: #2B6123">Kategorien</h3>
                    </div>
                    <div class="flex-row-fluid col-6 mt-1">
                        <a href="{{ route('kategorien.create') }}" data-repeater-delete class="btn text-white" style="background-color: #F49738; padding: 10px">
                            <i class="fa fa-plus text-white"></i> <span class="vorlage">Kategorien</span>
                        </a>
                    </div>
                    <div class="" style="text-align: right;">
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
                    <table class="table align-middle border rounded table-row-dashed fs-6 g-5 table-bordered table-responsive"
                           style="padding: 0 5px">
                        <thead style="background-color: #2B6123">
                        <tr class="text-center text-white fw-bold fs-7 text-uppercase">
                            <th class="min-w-10px">ID</th>
                            <th class="min-w-80px">Bild</th>
                            <th class="min-w-80px">Gefährdung</th>
                            <th class="min-w-80px">Kat1</th>
                            <th class="min-w-80px">Kat2</th>
                            <th class="min-w-80px">Kat3</th>
                            <th class="min-w-80px">Kat4</th>
                            <th class="min-w-80px">Kat5</th>
                            <th class="min-w-80px">Kat6</th>
                            <th class="min-w-80px">Kat7</th>
                            <th class="min-w-80px">Kat8</th>
                            <th class="min-w-80px">Kat9</th>
                            <th class="min-w-80px">Kat10</th>
                            <th class="min-w-100px">Action</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                        @foreach($kategorien as $key=>$kategory)
                            <tr class="odd text-center">
                                <td>
                                    {{$kategory->id}}
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">

                                        <img src="{{ asset('public') . '/' . $kategory->photo }}" height="50px" width="50px">

                                    </span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $kategory->danger }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ @$kategory->categoryoption->first()->kat1 }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ @$kategory->categoryoption->first()->kat2 }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ @$kategory->categoryoption->first()->kat3 }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ @$kategory->categoryoption->first()->kat4 }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ @$kategory->categoryoption->first()->kat5 }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ @$kategory->categoryoption->first()->kat6 }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ @$kategory->categoryoption->first()->kat7 }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ @$kategory->categoryoption->first()->kat8 }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ @$kategory->categoryoption->first()->kat9 }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ @$kategory->categoryoption->first()->kat10 }}</span>
                                </td>
{{--                                <td>--}}
{{--                                    <a href="{{route('kategorien.edit',$kategory->id)}}"--}}
{{--                                       class="btn btn-sm btn-light-dark mt-3 mt-md- me-2" style="display: inline">--}}
{{--                                        <i class="ki-duotone ki-user-edit fs-5"><span class="path1"></span><span--}}
{{--                                                class="path2"></span><span class="path3"></span><span--}}
{{--                                                class="path4"></span><span class="path5"></span></i>--}}
{{--                                    </a>--}}
{{--                                    <a href="{{ route('kategorien.delete',$kategory->id) }}" data-repeater-delete--}}
{{--                                       class="btn btn-sm btn-light-danger mt-3 mt-md-8" style="display: inline">--}}
{{--                                        <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span--}}
{{--                                                class="path2"></span><span class="path3"></span><span--}}
{{--                                                class="path4"></span><span class="path5"></span></i>--}}
{{--                                    </a>--}}
{{--                                </td>--}}
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('kategorien.edit', $kategory->id) }}" class="btn btn-sm btn-light-dark mb-2 mb-md-0 me-2">
                                                                                    <i class="ki-duotone ki-user-edit fs-5"><span class="path1"></span><span
                                                                                            class="path2"></span><span class="path3"></span><span
                                                                                            class="path4"></span><span class="path5"></span></i>
                                        </a>
                                        <a href="{{ route('kategorien.delete', $kategory->id) }}" data-repeater-delete class="btn btn-sm btn-light-danger">
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
                    {{ $kategorien->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
