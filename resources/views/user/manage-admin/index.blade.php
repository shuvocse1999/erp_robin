@extends('layouts.user.master')
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
                                       class="form-control form-control-solid w-200px ps-5" placeholder="Search"/>
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text btn btn-primary"
                                            style="border-radius: 0 5px 5px 0">
                                        <i class="tio-search"></i>
                                        Search
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
                        <a href="{{ route('user.create') }}" data-repeater-delete
                           class="btn btn-light-primary mt-3 mt-md-8">
                            Create
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table align-middle border rounded table-row-dashed fs-6 g-5 table-bordered"
                           style="padding: 0 5px">
                        <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                            <th class="min-w-10px">SL</th>
                            <th class="min-w-80px">Photo</th>
                            <th class="min-w-80px">Name</th>
                            <th class="min-w-80px">Email</th>
                            <th class="min-w-100px">Action</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                        @foreach($admins as $key=>$admin)
                            <tr class="odd">
                                <td>
                                    {{$key + $admins->firstItem()}}
                                </td>
                                <td>
                                    <div class="col-lg-8">
                                        <!--begin::Image input-->

                                        @if(isset($admin->avatar))
                                            <div class="image-input-wrapper w-50px h-50px"
                                                 style="background-image: url('{{ asset('storage/images/admin/' . $admin->avatar) }}');  background-position: center; background-size: cover;"></div>
                                        @else
                                            <div class="image-input-wrapper w-50px h-50px"
                                                 style="background-image: url('{{ asset('public/assets') }}/media/avatars/blank.png')"></div>
                                        @endif
                                        <!--end::Image input-->
                                    </div>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $admin->name }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ $admin->email }}</span>
                                </td>
                                <td>
                                    <a href="{{route('user.edit',$admin->id)}}"
                                       class="btn btn-sm btn-light-dark mt-3 mt-md- me-2" style="display: inline">
                                        <i class="ki-duotone ki-user-edit fs-5"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span><span
                                                class="path4"></span><span class="path5"></span></i>
                                    </a>
                                    <a href="{{ route('user.delete',$admin->id) }}" data-repeater-delete
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
                    {{ $admins->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
