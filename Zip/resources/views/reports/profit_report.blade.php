@extends('layouts.theme_list')

@section('content')



    <style>
        .col-1-5 {
            flex: 0 0 12.6%;
            max-width: 12.6%;
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .w-5 {
            width: 2% !important;
        }

        .leading-5 {
            margin-bottom: 0 !important;
            margin-top: 8px !important;
        }

        .border {
            border: none !important;
        }
    </style>




    <!--**********************************
                            Content body start
                        ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, welcome back!</h4>
                        <p class="mb-1">Profit Report</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Report</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Profit Report</a></li>

                    </ol>
                </div>
            </div>
            @include('inc._message')
            <!-- row -->



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Profit Report</h4>
                            <!-- Ibrahim add -->
                            {{--                        <button > --}}
                            <div class="srch_box_opn_icon">
                                <i id="search_hide" onclick="hide_the_search();" class="fa fa-search icon-hide"></i>
                            </div>
                            {{--                        </button> --}}
                        </div>
                        <div class="card-body">

                            <form action="{{ route('Profit_Report') }}" method="get">

                                <div class="row">
                                    <div class="col-1">
                                        <div class="form-group mb-0">
                                            <label class="" for="">Search</label>
                                        </div>
                                    </div>

                                    <div class="col-1-5">
                                        <div class="form-group mb-0">
                                            <label for=""></label>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="form-group mb-0">
                                            <label class="" for=""></label>
                                        </div>
                                    </div>

                                    <div class="col-1-5">
                                        <div class="form-group mb-0">
                                            <label for=""></label>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="form-group mb-0">
                                            <label class="" for=""></label>
                                        </div>
                                    </div>

                                    <div class="col-1-5">
                                        <div class="form-group mb-0">
                                            <label for=""></label>
                                        </div>
                                    </div>

                                </div>
                                {{--                second --}}
                                <div class="row">


                                    <div class=" col-1-5">
                                        <div class="form-group">
                                            <label class="" for="">Job#</label>
                                            <input tabindex="4" type="text" name="job_no"
                                                class="form-control form-control-sm" id="job_no"
                                                value="{{ $job_no }}">
                                        </div>
                                    </div>
                                    <div class=" col-1-5">
                                        <div class="form-group">
                                            <label class="" for="">Technician</label>
                                            {{-- <input tabindex="4" type="text" name="client_name"
                                            class="form-control form-control-sm" id="client_name" value="{{$client_name}}"> --}}
                                            <select id="tech_name" name="tech_name">
                                                <option value="0" selected disabled>Select Technician</option>
                                                @foreach ($tech_title as $index => $tech)
                                                    <option value="{{ $tech->tech_id }}"
                                                        {{ $tech_name == $tech->tech_id ? 'selected' : '' }}>
                                                        {{ $tech->tech_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class=" col-1-5">
                                        <div class="form-group">
                                            <label class="" for="">Status</label>
                                            <select tabindex="4" type="text" name="status"
                                                class="form-control form-control-sm" id="status">
                                                <option selected disabled>Select Option</option>
                                                {{-- <option {{ $status == 'Pending' ? 'selected' : '' }}>Pending</option> --}}
                                                <option {{ $status == 'Assign' ? 'selected' : '' }}>Assign</option>
                                                <option {{ $status == 'Close' ? 'selected' : '' }}>Close</option>
                                                <option {{ $status == 'Paid' ? 'selected' : '' }}>Paid</option>
                                                <option {{ $status == 'Credit' ? 'selected' : '' }}>Credit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1-5">
                                        <div class="form-group">
                                            <label class="" for="">Warranty</label>
                                            <select id="warranty" name="warranty">
                                                {{--                                            <option value="0" selected disabled>Select</option> --}}

                                                <option value="" selected disabled>Select Warranty</option>
                                                <option value="0" {{ $warranty == '0' ? 'selected' : '' }}>No</option>
                                                <option value="1" {{ $warranty == '1' ? 'selected' : '' }}>Yes
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                    <x-date-filter label="From" id="from_date" name="from_date"
                                        value="{{ $from_date }}" />
                                    <x-date-filter label="To" id="to_date" name="to_date"
                                        value="{{ $to_date }}" />
                                    <div class="col-0-5" style="margin-top: 2rem !important;">
                                        <div class="form-group">
                                            <a href="{{ route('Profit_Report') }}" class="btn btn-primary btn-sm"
                                                id="">
                                                Clear
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col" style="margin-top: 2rem !important;">
                                        <div class="form-group">
                                            <button tabindex="8" class="btn btn-primary btn-sm" id="customer_search">
                                                Search
                                            </button>
                                        </div>
                                    </div>
                                </div>



                            </form>




                            <div class="table-responsive">
                                <table id="" class="table table-striped table-bordered display"
                                    style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>Job No</th>
                                            <th>Technician</th>
                                            <th>Warrenty</th>
                                            <th>Status</th>
                                            <th>Cost</th>
                                            <th>Issue</th>
                                            <th>Return</th>
                                            <th>Expense</th>
                                            <th>Profit</th>
                                            <th>Date</th>



                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                            $segmentSr = !empty(app('request')->input('segmentSr')) ? app('request')->input('segmentSr') : '';
                                            $segmentPg = !empty(app('request')->input('page')) ? app('request')->input('page') : '';
                                            $sr = !empty($segmentSr) ? $segmentSr * $segmentPg - $segmentSr + 1 : 1;
                                            $countSeg = !empty($segmentSr) ? $segmentSr : 0;
                                            $prchsPrc = $slePrc = $avrgPrc = 0;
                                        @endphp



                                        @foreach ($query as $index => $brand)
                                            @php

                                            @endphp
                                            <tr>

                                                <td>{{ $brand->job_id }}</td>
                                                <td>{{ $brand->tech_name }}</td>

                                                <td>
                                                    @if ($brand->ji_warranty_status  == 1)
                                                        {{"Yes"}}
                                                    @else
                                                        {{'No'}}
                                                    @endif
                                                    {{-- {{ $brand->ji_warranty_status }} --}}
                                                </td>
                                                <td>{{ $brand->ji_job_status }}</td>

                                                <td>{{ $brand->ji_estimated_cost }}</td>

                                                @php
                                                    $var_return = 0;
                                                    $var_issue = 0;
                                                @endphp


                                                @foreach ($issue as $issuei)
                                                    @if ($issuei->job_id == $brand->job_id)
                                                        @php
                                                            $var_issue = $issuei->total_issue;
                                                        @endphp
                                                    @endif
                                                @endforeach

                                                <td>-{{ $var_issue }}</td>


                                                @foreach ($retured as $return)
                                                    @if ($return->job_id == $brand->job_id)
                                                        @php
                                                            $var_return = $return->total_return;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <td>{{ $var_return }}</td>


                                                {{-- @if ($retured[0]->ji_id == $brand->ji_id || $issue[0]->ji_id == $brand->ji_id) --}}

                                                @php
                                                    $exp = $var_return - $var_issue;
                                                @endphp

                                                <td>{{ $exp }}</td>


                                                <td>{{ $brand->ji_estimated_cost + $exp }}</td>
                                                <td>{{ date('d-m-Y', strtotime($brand->ji_recieve_datetime)) }}</td>
                                            </tr>

                                            @php
                                                $sr++;
                                                !empty($segmentSr) && $countSeg !== '0' ?: $countSeg++;
                                            @endphp
                                        @endforeach


                                    </tbody>
                                    <tr>
                                        {{-- <td>{{$total_amount}}</td> --}}
                                    </tr>
                                </table>
                            </div>
                            {{ $query->appends(['segmentSr' => $countSeg, 'status' => $status, 'tech_name' => $tech_name, 'warranty' => $warranty, 'from_date' => $from_date, 'to_date' => $to_date])->links() }}
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <!--**********************************
                        Content body end
                    ***********************************-->
@endsection
@section('script')


    <script>
        $(document).ready(function() {
            $("#status").select2();
            $("#warranty").select2();
            $("#tech_name").select2();
            $('#form').validate({ // initialize the plugin

                rules: {
                    brand: {
                        required: true,

                    }
                },
                messages: {
                    brand: {
                        required: "Required"
                    }

                },

                ignore: [],
                errorClass: "invalid-feedback animated fadeInUp",
                errorElement: "div",
                errorPlacement: function(e, a) {
                    jQuery(a).parents(".form-group > div").append(e)
                },
                highlight: function(e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
                },
                success: function(e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
                },

            });

        });
    </script>
@stop
