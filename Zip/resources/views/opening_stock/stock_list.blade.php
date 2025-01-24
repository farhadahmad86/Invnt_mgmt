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

        .col-0-5 {
            flex: 0 0 3.6%;
            max-width: 6.6%;
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        /* farhad add */
        .rec {
            margin: none;
            font-size: 18px;
        }

        .rec p {
            line-height: 40px
        }

        .tr_line {
            line-height: 4px;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .content-line {
            line-height: 25px !important;
        }


        .ticket {
            width: 155px;
            max-width: 155px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        .img-center {
            margin: 10px auto;
            display: block;
            width: 300px;
            height: 130px;
        }



        .job_tr {
            border: 2px solid;
            line-height: 3px !important;
        }

        .job_t th {
            white-space: nowrap;
        }

        .urdu {
            color: black;
            font-size: 20px;
            font-family: 'Noto Nastaliq Urdu Draft', serif !important;
        }

        .english {
            color: black;
            font-family: Arial, Verdana, Helvetica, sans-serif;
        }

        .job_name {
            line-height: 30px !important;

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
                        <p class="mb-1">Stock Movement List</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Stock Movement</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Stock Movement List</a></li>
                        {{--                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Job Transfer</a></li> --}}
                    </ol>
                </div>
            </div>
            @include('inc._message')
            <!-- row -->



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Stock Movement List</h4>
                            <!-- Ibrahim add -->
                            {{--                        <button > --}}
                            <div class="srch_box_opn_icon">
                                <i id="search_hide" onclick="hide_the_search();" class="fa fa-search icon-hide"></i>
                            </div>
                            {{--                        </button> --}}
                        </div>
                        <div class="card-body">

                            <form action="{{ route('opening_stock.index') }}" method="get">

                                <div class="row">
                                    <div class="col-1-5">
                                        <div class="form-group mb-0">
                                            <label for="">Part Name</label>
                                            {{-- <input type="text" tabindex="1" id="part_name" name="part_name"
                                                class="form-control form-control-sm" value="{{ $part_name }}"> --}}
                                            <select id="part_name" name="part_name">
                                                <option value="0" selected disabled>Select Part</option>
                                                @foreach ($parts_title as $index => $part)
                                                    <option value="{{ $part->par_id }}"
                                                        {{ $part_name == $part->par_id ? 'selected' : '' }}>
                                                        {{ $part->par_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1-5">
                                        <div class="form-group mb-0">
                                            <label for="">Job #</label>
                                            <input type="text" tabindex="1" id="job_no" name="job_no"
                                                class="form-control form-control-sm" value="{{ $job_no }}">
                                        </div>
                                    </div>
                                    <div class=" col-1-5">
                                        <div class="form-group">
                                            <label class="" for="">Type</label>

                                            <select id="status" name="status">
                                                {{-- <option value="0" selected disabled>Select</option> --}}

                                                <option value="" selected disabled>Select Type</option>
                                                <option value="Openning" {{ $status === 'Openning' ? 'selected' : '' }}>
                                                    Openning</option>
                                                <option value="Issue" {{ $status === 'Issue' ? 'selected' : '' }}>Issue
                                                </option>
                                                <option value="Purchase Invoice"
                                                    {{ $status === 'Purchase Invoice' ? 'selected' : '' }}>Purchase Invoice
                                                </option>
                                                <option value="Sale Invoice"
                                                    {{ $status === 'Sale Invoice' ? 'selected' : '' }}>Sale Invoice
                                                </option>
                                                <option value="Recover" {{ $status === 'Recover' ? 'selected' : '' }}>
                                                    Recover
                                                </option>
                                                <option value="Return" {{ $status === 'Return' ? 'selected' : '' }}>Return
                                                </option>
                                                <option value="Loss" {{ $status === 'Loss' ? 'selected' : '' }}>Loss
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                    <x-date-filter label="From" id="from_date" name="from_date"
                                        value="{{ $from_date }}" />
                                    <x-date-filter label="To" id="to_date" name="to_date"
                                        value="{{ $to_date }}" />
                                    <div class="col-0-5">
                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <label for=""></label>
                                        </div>
                                        <div class="form-group">
                                            <a href="{{ route('opening_stock.index') }}" class="btn btn-primary btn-sm"
                                                id="">
                                                Clear
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-1-5">
                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <label for=""></label>
                                        </div>
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

                                            <th>Sr#</th>
                                            <th>Date</th>
                                            <th>Part</th>
                                            <th>Job</th>
                                            <th>Technicain</th>
                                            <th>Type</th>
                                            <th>Ref. No</th>
                                            <th>Stock In</th>
                                            {{-- <th>Rate</th> --}}
                                            {{-- <th>Amount</th> --}}
                                            <th>Stock Out</th>
                                            {{-- <th>Rate</th> --}}
                                            {{-- <th>Amount</th> --}}

                                            {{--                                        <th>Stock Hold Qty</th> --}}
                                            {{-- <th>Job Hold Qty</th> --}}
                                            {{-- <th>Rate</th> --}}
                                            {{-- <th>Amount</th> --}}
                                            <th>Total Qty</th>


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
                                            <tr>
                                                {{--                                            <td>{{$sr}}</td> --}}
                                                <td>{{ $sr }}</td>
                                                <td>{{ date('d-m-Y', strtotime($brand->sto_created_at)) }}</td>
                                                <td>{{ $brand->par_name }}</td>
                                                <td onclick="thermal_print({{ $brand->sto_job_id }})"
                                                    style="color:#007bff;cursor: pointer;white-space: nowrap;">
                                                    {{ $brand->sto_job_id }}</td>
                                                {{-- <td>{{ $brand->sto_job_id }}</td> --}}
                                                @php
                                                    $technician = $tech_name->firstWhere('jitt_job_no', $brand->sto_job_id);
                                                @endphp
                                                <td>{{ $technician ? $technician->tech_name : '' }}</td>
                                                <td>{{ $brand->sto_type }}</td>
                                                <td class="view" data-id="{{ $brand->sto_type_id }}"
                                                    data-type="{{ $brand->sto_type }}"
                                                    style="color:#007bff;cursor: pointer">
                                                    @if ($brand->sto_type == 'Issue')
                                                    ISSUE-
                                                    @elseif ($brand->sto_type == 'Sale Invoice')
                                                    SI-
                                                    @elseif ($brand->sto_type == 'Purchase Invoice')
                                                    PI-
                                                    @elseif ($brand->sto_type == 'Return')
                                                    Return-
                                                    @elseif ($brand->sto_type == 'Loss')
                                                    Product-Loss-
                                                    @elseif ($brand->sto_type == 'Recover')
                                                    Product-Recover-
                                                    @endif
                                                    {{ $brand->sto_type_id }}
                                                </td>
                                                {{-- <td>{{ $brand->sto_type_id }}</td> --}}
                                                <td>{{ $brand->sto_in }}</td>
                                                {{-- <td>{{ $brand->sto_in_rate }}</td> --}}
                                                {{-- <td>{{ $brand->sto_in_amount }}</td> --}}
                                                <td>{{ $brand->sto_out }}</td>
                                                {{-- <td>{{ $brand->sto_out_rate }}</td> --}}
                                                {{-- <td>{{ $brand->sto_out_amount }}</td> --}}
                                                {{-- <td>{{ $brand->sto_hold }}</td> --}}
                                                {{-- <td>{{ $brand->sto_hold_rate }}</td> --}}
                                                {{-- <td>{{ $brand->sto_hold_amount }}</td> --}}
                                                <td>{{ $brand->sto_total }}</td>
                                            </tr>

                                            @php
                                                $sr++;
                                                !empty($segmentSr) && $countSeg !== '0' ?: $countSeg++;
                                            @endphp
                                        @endforeach


                                    </tbody>

                                </table>
                            </div>
                            {{ $query->appends(['segmentSr' => $countSeg, 'status' => $status, 'job_no' => $job_no, 'from_date' => $from_date, 'to_date' => $to_date, 'part_name' => $part_name])->links() }}
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    {{-- farhad add --}}
    <!-- Modal -->
    <div class="modal fade rec" id="exampleModall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header hidden-print">
                    <h5 class="modal-title" id="exampleModalLabel">Sales Invoice Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="body_print">
                    @include('job_info.customfile')
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary hidden-print" data-bs-dismiss="modal">Close</button> --}}
                    <button id="btnPrint" class="btn btn-success hidden-print" style="display: none">Print</button>
                </div>
            </div>
        </div>
    </div>
    {{-- farhad add --}}
    {{-- For part Ref. --}}
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg mdl_wdth">
            <div class="modal-content base_clr">
                <div class="modal-header">
                    {{-- <h4 class="modal-title text-black">Parts Issue Detail</h4> --}}
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div id="table_body">

                    </div>

                </div>

                <div class="modal-footer">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form_controls">
                            <button type="button" class="btn btn-default form-control cancel_button"
                                data-dismiss="modal">
                                <i class="fa fa-times"></i> Cancel
                            </button>
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
        // jQuery("#invoice_no").blur(function () {
        jQuery(".view").click(function() {
            jQuery("#table_body").html("");

            var id = jQuery(this).attr("data-id");
            var type = jQuery(this).attr("data-type");
            if (type == 'Issue') {
                $('.modal-body').load('{{ url('part_issue_modal_view_details/view/') }}' + '/' + id, function() {
                    $('#myModal').modal({
                        show: true
                    });
                });
            } else if (type == 'Sale Invoice') {
                $('.modal-body').load('{{ url('sale_invoice_modal_view_details/view/') }}' + '/' + id, function() {
                    $('#myModal').modal({
                        show: true
                    });
                });
            } else if (type == 'Purchase Invoice') {
                $('.modal-body').load('{{ url('purchase_invoice_modal_view_details/view/') }}' + '/' + id,
                    function() {
                        $('#myModal').modal({
                            show: true
                        });
                    });
            } else if (type == 'Return') {
                $('.modal-body').load('{{ url('part_return_modal_view_details/view/') }}' + '/' + id, function() {
                    $('#myModal').modal({
                        show: true
                    });
                });
            } else if (type == 'Recover') {
                $('.modal-body').load('{{ url('part_recover_modal_view_details/view/') }}' + '/' + id, function() {
                    $('#myModal').modal({
                        show: true
                    });
                });
            } else if (type == 'Loss') {
                $('.modal-body').load('{{ url('product_loss_modal_view_details/view/') }}' + '/' + id, function() {
                    $('#myModal').modal({
                        show: true
                    });
                });
            } else {
                alert(1)
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#part_name').select2();
            $('#status').select2();
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
