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
                        <div class="d-flex align-items-center position-relative my-1">
                            <input type="text" style="border-radius: 5px 0 0 5px" data-kt-filter="search"
                                   name="search"
                                   class="form-control form-control-solid w-200px ps-5" placeholder="Search"/>
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text btn btn-primary"
                                        style="border-radius: 0 5px 5px 0">
                                    <i class="tio-search"></i>
                                    Search
                                </button>
                            </div>
                        </div>
                        <!--end::Search-->
                        <!--begin::Export buttons-->
                        <div id="kt_datatable_example_1_export" class="d-none"></div>
                        <!--end::Export buttons-->
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table align-middle border rounded table-row-dashed fs-6 g-5 table-bordered table-responsive"
                           style="padding: 0 5px">
                        <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                            <th class="min-w-80px">ID</th>
                            <th class="min-w-80px">Title</th>
                            <th class="min-w-80px">Status</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">

                        @foreach($data['data'] as $key=>$item)
                            <tr class="odd">
                                <td><span class="text-dark text-hover-primary">{{ @$item['id'] }}</span></td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ @$item['title'] }}</span>
                                </td>
                                <td>
                                    <span class="text-dark text-hover-primary">{{ @$item['status'] }}</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{--                <div class="row">--}}
                {{--                    {{ $users->links() }}--}}
                {{--                </div>--}}

            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('[data-kt-filter="search"]').on('keyup', function () {
            var searchText = $(this).val().toLowerCase();
            $('tbody tr').each(function () {
                var id = $(this).find('td:nth-child(1)').text().toLowerCase();
                var title = $(this).find('td:nth-child(2)').text().toLowerCase();
                var status = $(this).find('td:nth-child(3)').text().toLowerCase();

                // Check if any column (ID, Title, or Status) contains the search text
                if (id.includes(searchText) || title.includes(searchText) || status.includes(searchText)) {
                    $(this).show(); // Show the row if it matches
                } else {
                    $(this).hide(); // Hide the row if it doesn't match
                }
            });
        });
    });
</script>

