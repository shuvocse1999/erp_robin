@extends('layouts.master')
@section('content')
    <style>
        .text-dark a:hover i {
            color: #2B6123;
        }
        .btn-aktion:hover i {
            color: #2B6123;
        }
        @media only screen and (max-width: 600px) {
            .vorlage{
                display: none;
            }
            .vorlagen{
                margin-right: 20px;
            }
        }
    </style>
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row g-5 g-xl-10">
            <div class="card-p-0 card-flush">

                <div class="py-5 gap-2 d-flex">
                    <div class="card-toolbar flex-row-fluid gap-5 mt-2 vorlagen">
                        <h3 class="" style="color: #2B6123">Dropdown</h3>
                    </div>
                    <div class="flex-row-fluid col-6 mt-1">
                        <a href="{{route('vorlagen.antworten')}}" data-repeater-delete class="btn text-white" style="background-color: #F49738; padding: 10px">
                            <i class="fa fa-plus text-white"></i><span class="vorlage">Dropdown</span>
                        </a>
                    </div>
                    <div class="" style="text-align: right;">
                        <!--begin::Search-->
                        <form action="{{url()->current()}}" method="GET">
                            <div class="d-flex align-items-center position-relative my-1">
                                <div class="input-group">
                                    <input type="text" style="border-radius: 5px 0 0 5px" data-kt-filter="search" name="search" value="{{$search??''}}" class="form-control form-control-solid ps-5" placeholder="Suche">
                                    <button type="submit" class="input-group-text btn text-white" style="border-radius: 0 5px 5px 0; background-color: #2B6123">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" fill="#fff"/></svg>

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
                            <th class="min-w-80px">Title</th>
                            <th class="min-w-80px">Answer</th>
                            <th class="min-w-80px">Datum</th>
                            <th class="min-w-80px">Aktion</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600 text-center">
                        @foreach($answersheets as $answersheet)
                            <tr class="odd">
                                <td><span class="text-dark">{{$answersheet->id}}</span></td>
                                <td><span class="text-dark">{{@$answersheet->title}}</span></td>
                                <td><span class="text-dark">{{$answersheet->answers->count() ?? ""}}</span></td>
                                <td><span class="text-dark">@if(isset($answersheet->created_at)) {{$answersheet->created_at->format('d.m.Y') }} @endif</span></td>
                                <td>
                                <span class="text-dark">
                                    <a href="{{ route('vorlagen.antworten.edit',$answersheet->id) }}" class="btn btn-sm"><i class="fa fa-pencil"></i></a>
                                </span>
                                    <span class="text-dark">
                                    <a href="{{route('vorlagen.antworten.destroy',$answersheet->id)}}" class="btn btn-sm"><i class="fa fa-trash"></i></a>
                                </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    {!! $answersheets->links() !!}
                </div>

            </div>
        </div>
    </div>
@endsection
