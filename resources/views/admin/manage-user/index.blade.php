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
{{--                <div class="py-5 gap-2 d-flex">--}}
{{--                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">--}}
{{--                        <a href="{{ route('admin.user.create') }}" data-repeater-delete--}}
{{--                           class="btn text-white" style="background-color: #2B6123">--}}
{{--                            Benutzer--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="" style="text-align: right;">--}}
{{--                        <!--begin::Search-->--}}
{{--                        <form action="{{url()->current()}}" method="GET">--}}
{{--                            <div class="d-flex align-items-center position-relative my-1">--}}
{{--                                <div class="input-group">--}}
{{--                                    <input type="text" style="border-radius: 5px 0 0 5px" data-kt-filter="search" name="search" value="{{$search??''}}" class="form-control form-control-solid ps-5" placeholder="Suche">--}}
{{--                                    <button type="submit" class="input-group-text btn text-white" style="border-radius: 0 5px 5px 0; background-color: #2B6123">--}}
{{--                                        <i class="tio-search"></i> Suche--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                        <!--end::Search-->--}}
{{--                    </div>--}}

{{--                </div>--}}
                <div class="py-5 gap-2 d-flex">
                    <div class="card-toolbar flex-row-fluid gap-5 mt-2 vorlagen">
                        <h3 class="" style="color: #2B6123">Mitarbeiter</h3>
                    </div>
                    <div class="flex-row-fluid col-6 mt-1">
                        <a href="{{ route('admin.user.create') }}" data-repeater-delete class="btn text-white" style="background-color: #F49738; padding: 10px">
                            <i class="fa fa-plus text-white"></i> <span class="vorlage">Mitarbeiter</span>
                        </a>
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
                    <table class="table align-middle border rounded table-row-dashed fs-6 g-5 table-bordered table-responsive"
                           style="padding: 0 5px">
                        <thead style="background-color: #2B6123">
                        <tr class="text-center text-white fw-bold fs-7 text-uppercase">
                            <th class="min-w-10px">ID</th>
                            <th class="min-w-80px">Firmenname</th>
                            <th class="min-w-80px">Email</th>
                            <th class="min-w-80px">Role</th>
                            <th class="min-w-100px">Action</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                        @foreach($users as $key=>$user)
                            <tr class="odd text-center">
                                <td>
                                    {{$user->id}}
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary"><strong>{{ $user->firmenname }}</strong></span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $user->email }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ @$user->role->name }}</span>
                                </td>
                                <td>
                                    <a href="{{route('admin.user.edit',$user->id)}}"
                                       class="btn btn-sm btn-light-dark mt-3 mt-md- me-2" style="display: inline">
                                        <i class="ki-duotone ki-user-edit fs-5"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span><span
                                                class="path4"></span><span class="path5"></span></i>
                                    </a>
                                    <a href="{{ route('admin.user.delete',$user->id) }}" data-repeater-delete
                                       class="btn btn-sm btn-light-danger mt-3 mt-md-8" style="display: inline">
                                        <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span><span
                                                class="path4"></span><span class="path5"></span></i>
                                    </a>
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
@endsection
