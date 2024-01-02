<!DOCTYPE html>
<html>
<head>

</head>
<body>
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
            <div class="card card-p-0 card-flush">
                <div class="card-body table-responsive">
                    <table
                        class="table align-middle border rounded table-row-dashed fs-6 g-5 table-bordered table-responsive"
                        style="padding: 0 5px">
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
                        @foreach($ansSubmissions as $ansSubmission)
                            <input type="hidden" name="user_id" value="{{@$ansSubmission->userId->id}}">
                            <tr class="odd">
                                <td><span class="text-dark">{{$ansSubmission->id}}</span></td>
                                <td><span class="text-dark">{{@$ansSubmission->userId->name}}</span></td>
                                <td><span class="text-dark">{{@$ansSubmission->formulars->title}}</span></td>
                                <td><span class="text-dark">
                                            {{@$ansSubmission->userAnswers()->count()}}
                                        </span>
                                </td>
                                <td><span class="text-dark">{{$ansSubmission->userAnswers()->groupBy('aufgaben_id')->count()}}</span></td>
                                <td><span class="text-dark">{{$ansSubmission->created_at->format('d.m.Y') }}</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">

                </div>

            </div>
        </div>
    </div>
</body>
</html>
