@extends('layouts.master')
@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row g-5 g-xl-10">
            <div class="card card-p-0 card-flush">
                <div class="card-toolbar flex-row-fluid gap-5 mt-2" style="text-align: right">
                </div>
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        <!--begin::Export buttons-->
                        <div id="kt_datatable_example_1_export" class="d-none"></div>
                        <!--end::Export buttons-->
                    </div>
                </div>

                <div class="card-body table-responsive">
                    <table
                        class="table align-middle border rounded table-row-dashed fs-6 g-5 table-bordered table-responsive"
                        style="padding: 0 5px">
                        <thead class="bg-primary">
                        <tr class="text-start text-white fw-bold fs-7 text-uppercase">
                            <th class="min-w-80px">ID</th>
                            <th class="min-w-80px">Title</th>
                            <th class="min-w-80px">conducted at</th>
                            <th class="min-w-80px">Status</th>
                            <th class="min-w-80px">Due at</th>
                            <th class="min-w-80px">overdue</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                        <tr class="odd">
                            <td><span class="text-dark text-hover-primary">{{ @$data['data']['id'] }}</span></td>
                            <td>
                                <span class="text-dark text-hover-primary">{{ @$data['data']['title'] }}</span>
                            </td>
                            <td>
                                <span class="text-dark text-hover-primary">{{ @$data['data']['conducted_at'] }}</span>
                            </td>
                            <td>
                                <span class="text-dark text-hover-primary">{{ @$data['data']['status'] }}</span>
                            </td>
                            <td>
                                <span class="text-dark text-hover-primary">{{ @$data['data']['due_at'] }}</span>
                            </td>
                            <td>
                                <span class="text-dark text-hover-primary">{{ @$data['data']['overdue'] }}</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">

                </div>

            </div>

            @if(@$data['data']['assignees'] != null)
                <div class="card card-p-0 card-flush">
                    <div class="card-toolbar flex-row-fluid gap-5 mt-2" style="text-align: right">
                    </div>
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <h3>Assignees</h3>
                            <!--begin::Export buttons-->
                            <div id="kt_datatable_example_1_export" class="d-none"></div>
                            <!--end::Export buttons-->
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table
                            class="table align-middle border rounded table-row-dashed fs-6 g-5 table-bordered table-responsive"
                            style="padding: 0 5px">
                            <thead class="bg-primary">
                            <tr class="text-start text-white fw-bold fs-7 text-uppercase">
                                <th class="min-w-80px">ID</th>
                                <th class="min-w-80px">name</th>
                                <th class="min-w-80px">email</th>
                            </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                            <tr class="odd">
                                <td><span
                                        class="text-dark text-hover-primary">{{ @$data['data']['assignees']['id'] }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$data['data']['assignees']['name'] }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$data['data']['assignees']['email'] }}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">

                    </div>

                </div>
            @endif

            @if(@$data['data']['conducted_by'] != null)
                <div class="card card-p-0 card-flush">
                    <div class="card-toolbar flex-row-fluid gap-5 mt-2" style="text-align: right">
                    </div>
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <h3>Conducted By</h3>
                            <!--begin::Export buttons-->
                            <div id="kt_datatable_example_1_export" class="d-none"></div>
                            <!--end::Export buttons-->
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table
                            class="table align-middle border rounded table-row-dashed fs-6 g-5 table-bordered table-responsive"
                            style="padding: 0 5px">
                            <thead class="bg-primary">
                            <tr class="text-start text-white fw-bold fs-7 text-uppercase">
                                <th class="min-w-80px">ID</th>
                                <th class="min-w-80px">name</th>
                                <th class="min-w-80px">email</th>
                                <th class="min-w-80px">role</th>
                                <th class="min-w-80px">admin</th>
                            </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                            <tr class="odd">
                                <td><span
                                        class="text-dark text-hover-primary">{{ @$data['data']['conducted_by']['id'] }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$data['data']['conducted_by']['name'] }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$data['data']['conducted_by']['email'] }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$data['data']['conducted_by']['role']['name'] }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$data['data']['conducted_by']['admin'] }}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">

                    </div>

                </div>
            @endif


            @if(@$data['data']['site'] != null)
                <div class="card card-p-0 card-flush">
                    <div class="card-toolbar flex-row-fluid gap-5 mt-2" style="text-align: right">
                    </div>
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <h3>Site</h3>
                            <!--begin::Export buttons-->
                            <div id="kt_datatable_example_1_export" class="d-none"></div>
                            <!--end::Export buttons-->
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table
                            class="table align-middle border rounded table-row-dashed fs-6 g-5 table-bordered table-responsive"
                            style="padding: 0 5px">
                            <thead class="bg-primary">
                            <tr class="text-start text-white fw-bold fs-7 text-uppercase">
                                <th class="min-w-80px">ID</th>
                                <th class="min-w-80px">Title</th>
                                <th class="min-w-80px">description</th>
                                <th class="min-w-80px">users</th>
                                <th class="min-w-80px">Primary ssid</th>
                                <th class="min-w-80px">Primary password</th>
                                <th class="min-w-80px">Secondary ssid</th>
                                <th class="min-w-80px">Secondary password</th>
                            </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                            <tr class="odd">
                                <td><span
                                        class="text-dark text-hover-primary">{{ @$data['data']['site']['id'] }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$data['data']['site']['title'] }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$data['data']['site']['description'] }}</span>
                                </td>

                                <td>
                                    @foreach($data['data']['site']['users'] as $dataUsers)
                                    <span
                                        class="text-dark text-hover-primary">{{ @$dataUsers['name'] }},</span>
                                    @endforeach
                                </td>

                                <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$data['data']['site']['primary_ssid'] }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$data['data']['site']['primary_password'] }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$data['data']['site']['secondary_ssid'] }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$data['data']['site']['secondary_password'] }}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">

                    </div>

                </div>
            @endif


            @if(@$data['data']['issues'] != null)
                <div class="card card-p-0 card-flush">
                    <div class="card-toolbar flex-row-fluid gap-5 mt-2" style="text-align: right">
                    </div>
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <h3>Issues</h3>
                            <!--begin::Export buttons-->
                            <div id="kt_datatable_example_1_export" class="d-none"></div>
                            <!--end::Export buttons-->
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table
                            class="table align-middle border rounded table-row-dashed fs-6 g-5 table-bordered table-responsive"
                            style="padding: 0 5px">
                            <thead class="bg-primary">
                            <tr class="text-start text-white fw-bold fs-7 text-uppercase">
                                <th class="min-w-80px">ID</th>
                                <th class="min-w-80px">Title</th>
                                <th class="min-w-80px">Updated at</th>
                                <th class="min-w-80px">Resolved by</th>
                                <th class="min-w-80px">Resolved at</th>
                                <th class="min-w-80px">Created at</th>
                                <th class="min-w-80px">Assignees</th>
                                <th class="min-w-80px">Status</th>
                                <th class="min-w-80px">Overdue</th>
                                <th class="min-w-80px">Priority</th>
                                <th class="min-w-80px">Created by</th>
                            </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                            @foreach($data['data']['issues'] as $issue)
                                <tr class="odd">
                                    <td><span
                                            class="text-dark text-hover-primary">{{ @$issue['id'] }}</span>
                                    </td>
                                    <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$issue['title'] }}</span>
                                    </td>
                                    <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$issue['updated_at'] }}</span>
                                    </td>
                                    <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$issue['resolved_by']['name'] }}</span>
                                    </td>
                                    <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$issue['resolved_at'] }}</span>
                                    </td>
                                    <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$issue['created_at'] }}</span>
                                    </td>
                                    <td>
                                        @foreach($issue['assignees'] as $issueItem)
                                    <span
                                        class="text-dark text-hover-primary">{{ @$issueItem['name'] }}, </span>
                                        @endforeach
                                    </td>
                                    <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$issue['status'] }}</span>
                                    </td>
                                    <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$issue['overdue'] }}</span>
                                    </td>
                                    <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$issue['priority'] }}</span>
                                    </td>
                                    <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$issue['created_by']['name'] }}</span>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">

                    </div>

                </div>
            @endif



            @if(@$data['data']['checklist'] != null)
                <div class="card card-p-0 card-flush">
                    <div class="card-toolbar flex-row-fluid gap-5 mt-2" style="text-align: right">
                    </div>
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <h3>Checklist</h3>
                            <!--begin::Export buttons-->
                            <div id="kt_datatable_example_1_export" class="d-none"></div>
                            <!--end::Export buttons-->
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table
                            class="table align-middle border rounded table-row-dashed fs-6 g-5 table-bordered table-responsive"
                            style="padding: 0 5px">
                            <thead class="bg-primary">
                            <tr class="text-start text-white fw-bold fs-7 text-uppercase">
                                <th class="min-w-80px">ID</th>
                                <th class="min-w-80px">Title</th>
                                <th class="min-w-80px">Status</th>
                            </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                            <tr class="odd">
                                <td><span
                                        class="text-dark text-hover-primary">{{ @$data['data']['checklist']['id'] }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$data['data']['checklist']['title'] }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-dark text-hover-primary">{{ @$data['data']['checklist']['status'] }}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">

                    </div>

                </div>
            @endif
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
