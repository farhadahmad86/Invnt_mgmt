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
    <div class="content-body hidden-print">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text hidden-print">
                        <h4>Hi, welcome back!</h4>
                        <p class="mb-1">Job Information Detail List</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb hidden-print">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Management</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Information</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Job Information Detail List</a></li>
                    </ol>
                </div>
            </div>
            @include('inc._message')
            <!-- row -->



            <div class="row hidden-print">
                <div class="col-12">
                    <div class="card hidden-print">
                        <div class="card-header">
                            <h4 class="card-title">Job Information Detail List</h4>
                            <!-- Ibrahim add -->
                            {{--                        <button > --}}
                            <div class="srch_box_opn_icon">
                                <i id="search_hide" onclick="hide_the_search();" class="fa fa-search icon-hide"></i>
                            </div>
                            {{--                        </button> --}}
                        </div>
                        <div class="card-body">

                            <form action="{{ route('add_job_info_list.index') }}" method="get"
                                onsubmit="return validateForm()">

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
                                            <label class="" for="">Client Name</label>
                                            {{-- <input tabindex="4" type="text" name="client_name"
                                            class="form-control form-control-sm" id="client_name" value="{{$client_name}}">
                                            --}}
                                            <select id="client_name" name="client_name">

                                                <option value="" selected disabled>Select</option>
                                                @foreach ($client_title as $index => $client)
                                                    <option value="{{ $client->cli_name }}"
                                                        {{ $client_name == $client->cli_name ? 'selected' : '' }}>
                                                        {{ $client->cli_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" col-1-5">
                                        <div class="form-group">
                                            <label class="" for="">Status</label>
                                            <select id="status" name="status">
                                                {{-- <option value="" selected disabled>Select</option> --}}

                                                <option value="" selected disabled>Select Status</option>
                                                <option value="Pending" {{ $status === 'Pending' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="Assign" {{ $status === 'Assign' ? 'selected' : '' }}>Assign
                                                </option>
                                                <option value="Close" {{ $status === 'Close' ? 'selected' : '' }}>Close
                                                </option>
                                                <option value="Paid" {{ $status === 'Paid' ? 'selected' : '' }}>Paid
                                                </option>
                                                <option value="Credit" {{ $status === 'Credit' ? 'selected' : '' }}>Credit
                                                </option>
                                                <option value="Hold" {{ $status === 'Hold' ? 'selected' : '' }}>Hold
                                                </option>

                                            </select>
                                            <span id="statusError" class="validate_sign" style="color: red"> </span>
                                        </div>
                                    </div>
                                    <div class=" col-1-5">
                                        <div class="form-group">
                                            <label class="" for="">Delivery Status</label>
                                            <select id="job_delivery" name="job_delivery">
                                                {{-- <option value="" selected disabled>Select</option> --}}

                                                <option value="" selected disabled>Select Job Delivery</option>
                                                <option value="1" {{ $job_delivery === '1' ? 'selected' : '' }}>Not
                                                    deliverd</option>
                                                <option value="2" {{ $job_delivery === '2' ? 'selected' : '' }}>
                                                    Deliverd</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" col-1-5">
                                        <div class="form-group">
                                            <label class="" for="">Number</label>
                                            <input tabindex="5" type="text" name="client_number"
                                                class="form-control form-control-sm" id="client_number"
                                                value="{{ $client_number }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1-5">
                                        <div class="form-group">
                                            <label class="" for="">Warranty</label>
                                            <select id="warranty" name="warranty">
                                                {{-- <option value="" selected disabled>Select</option> --}}

                                                <option value="" selected disabled>Select Warranty</option>
                                                <option value="0" {{ $warranty === '0' ? 'selected' : '' }}>No
                                                </option>
                                                <option value="1" {{ $warranty === '1' ? 'selected' : '' }}>Yes
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class=" col-1-5">
                                        <div class="form-group">
                                            <label class="" for="">Warrenty Vendor</label>
                                            <select id="vendor_name" name="vendor_name">

                                                <option value="" selected disabled>Select</option>
                                                @foreach ($warrenty_vendor as $index => $vendor)
                                                    <option value="{{ $vendor->vendor_name }}"
                                                        {{ $vendor_name == $vendor->vendor_name ? 'selected' : '' }}>
                                                        {{ $vendor->vendor_name }}</option>
                                                @endforeach
                                            </select>
                                            <span id="clientNameError" class="validate_sign" style="color: red"> </span>
                                        </div>
                                    </div>
                                    <div class=" col-1-5">
                                        <div class="form-group">
                                            <label class="" for="">Technician</label>
                                            {{-- <input tabindex="4" type="text" name="tech_name"
                                            class="form-control form-control-sm" id="tech_name" value="{{$tech_name}}">
                                            --}}
                                            <select id="tech_name" name="tech_name">
                                                <option value="" selected disabled>Select Technician</option>
                                                @foreach ($tech_title as $index => $tech)
                                                    <option value="{{ $tech->tech_name }}"
                                                        {{ $tech_name == $tech->tech_name ? 'selected' : '' }}>
                                                        {{ $tech->tech_name }}</option>
                                                @endforeach
                                            </select>
                                            <span id="techNameError" class="validate_sign" style="color: red"> </span>
                                        </div>
                                    </div>
                                    <x-date-filter label="From" id="from_date" name="from_date"
                                        value="{{ $from_date }}" />
                                    <x-date-filter label="To" id="to_date" name="to_date"
                                        value="{{ $to_date }}" />
                                </div>
                                <div class="row">
                                    <div class="col-0-5" style="margin-top: 30px">
                                        <div class="form-group">
                                            <a href="{{ route('add_job_info_list.index') }}"
                                                class="btn btn-primary btn-sm" id="">
                                                Clear
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-0-5" style="margin-top: 30px">
                                        <div class="form-group">
                                            <button tabindex="8" class="btn btn-primary btn-sm" id="customer_search">
                                                Search
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-0-5" style="margin-top: 30px">
                                        <div class="form-group">
                                            <button tabindex="8" type="submit" class="btn btn-primary btn-sm"
                                                id="pdf_download" name="pdf_download" value="1">
                                                Download
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
                                            <th>Client Name</th>
                                            <th>Client Number</th>
                                            <th>Job Title</th>
                                            <th>Warrenty</th>
                                            <th>Delivery Status</th>
                                            <th>Delivered By</th>
                                            <th>Edit Delivery</th>
                                            <th>Vendor</th>
                                            <th>Brand</th>
                                            <th>Category</th>
                                            <th>Model</th>
                                            <th>Equipment</th>
                                            <th>Status</th>
                                            <th>Serial Number</th>
                                            <th>Cost</th>
                                            <th>Amount Pay (Rs)</th>
                                            <th>Remaining</th>

                                            <th>Complain</th>
                                            <th>Accessories</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Action</th>

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
                                            <td>{{ $brand->job_id }}</td>
                                            @php
                                            $technician = optional($tech_names)->firstWhere('jitt_job_no', $brand->job_id);
                                            @endphp
                                        <td>{{ $technician ? $technician->tech_name : '' }}</td>
                                            <td>{{ $brand->cli_name }}</td>
                                            <td>{{ $brand->cli_number }}</td>
                                            <td onclick="thermal_print({{ $brand->job_id }})"
                                                style="color:#007bff;cursor: pointer;white-space: nowrap;">
                                                {{ $brand->ji_title }}</td>
                                            <td>{{ $brand->ji_warranty_status == 1 ? 'Yes' : '' }}</td>
                                            <td>{{ $brand->job_delivery_status == 2 ? 'Delivered' : 'Not delivered' }}</td>
                                            <td>{{ $brand->user_name }}</td>
                                            <td>
                                                @if ($brand->job_delivery_status == 2)
                                                <a href="{{route('job_delivery_edit',$brand->job_id)}}"><i class="fas fa-edit"></i></a>
                                                @else
                                                 {{''}}
                                                @endif
                                             </td>
                                            <td>{{ $brand->vendor_name }}</td>
                                            <td>{{ $brand->bra_name }}</td>
                                            <td>{{ $brand->cat_name }}</td>
                                            <td>{{ $brand->mod_name }}</td>
                                            <td>{{ $brand->ji_equipment }}</td>
                                            <td>{{ $brand->ji_job_status }}</td>
                                            <td>{{ $brand->ji_serial_no }}</td>
                                            <td>{{ $brand->ji_estimated_cost }}</td>
                                            <td>{{ $brand->ji_amount_pay }}</td>
                                            <td>{{ $brand->ji_remaining }}</td>
                                            @php
                                            foreach ($complain_items as $complain){
                                                if ($complain->jii_ji_job_id == $brand->job_id){
                                                @endphp
                                                    <td>{{ $complain->jii_item_name }}</td>
                                                @php
                                           }
                                           }
                                            foreach ($accessory_items as $complain){
                                                if ($complain->jii_ji_job_id == $brand->job_id){

                                                @endphp
                                                    <td>{{ $complain->jii_item_name }}</td>
                                                    @php
                                                }
                                                }
                                            @endphp

                                            <td>{{ date('d-m-Y', strtotime($brand->ji_recieve_datetime)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($brand->ji_delivery_datetime)) }}</td>
                                            <td>
                                                @if ($brand->ji_job_status == 'Close' || $brand->ji_job_status == 'Credit')
                                                <a href="{{route('job_invoice_edit',$brand->job_id)}}" class="btn btn-info" style="font-size: 12px">Generate Invoice</a>
                                                {{-- <a href="{{route('get_sale_job_inv')}}" class="btn btn-info" style="font-size: 12px">Generate Invoice</a> --}}
                                                @else
                                                 {{''}}
                                                @endif
                                             </td>

                                        </tr>

                                        @php
                                            $sr++;
                                            !empty($segmentSr) && $countSeg !== '0' ?: $countSeg++;
                                        @endphp
                                        @endforeach
                                        </tbody>

                                </table>
                            </div>
                            {{ $query->appends(['segmentSr' => $countSeg, 'job_no' => $job_no, 'status' => $status, 'client_name' => $client_name, 'client_number' => $client_number, 'from_date' => $from_date, 'to_date' => $to_date, 'warranty' => $warranty, 'tech_name' => $tech_name, 'job_delivery' => $job_delivery, 'vendor_name' => $vendor_name])->links() }}
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <!--**********************************
                                                                    Content body end
                                                                ***********************************-->


    <div class="modal fade rec" id="exampleModall" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                    <button type="button" class="btn btn-secondary hidden-print" data-bs-dismiss="modal">Close</button>
                    <button id="btnPrint" class="btn btn-success hidden-print">Print</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script>
        function validateForm() {
            // alert(1);
            // Get values of relevant form fields
            var jobNo = document.getElementById('job_no').value;
            var clientName = document.getElementById('client_name').value;
            var status = document.getElementById('status').value;
            var jobDelivery = document.getElementById('job_delivery').value;
            var clientNumber = document.getElementById('client_number').value;
            var warranty = document.getElementById('warranty').value;
            var techName = document.getElementById('tech_name').value;
            var VendorName = document.getElementById('vendor_name').value;
            var fromDate = document.getElementById('from_date').value;
            var toDate = document.getElementById('to_date').value;

            // Count the number of non-empty fields
            var filledFields = [jobNo, clientName, status, jobDelivery, clientNumber, warranty, techName, VendorName,
                    fromDate, toDate
                ]
                .filter(field => field !== '').length;
            // alert(filledFields)

            // Check if only the job number is filled
            if (filledFields === 1 && jobNo !== '') {
                return true;
            }
            // Check if at least two fields are filled
            if (filledFields < 2) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Please fill in at least two fields, or only the Job Number.',
                });
                return false; // Prevent form submission
            }

            // If validation passes, allow form submission
            return true;
        }
    </script>

    <script>
        function checkForm() {
            console.log('Form submitted!'); // Add this line for debugging

            var tech_name = document.getElementById('tech_name').value;
            var status = document.getElementById('status').value;

            // Clear previous error messages
            document.getElementById('techNameError').innerHTML = "";
            document.getElementById('statusError').innerHTML = "";
            // Validation for status
            if (status === null || status === "" || status === "0") {
                document.getElementById('statusError').innerHTML = "Please select a Status.";
                return false;
            }
            // Validation for tech_name
            if (tech_name === null || tech_name === "" || tech_name === "0") {
                document.getElementById('techNameError').innerHTML = "Please select a Tech.";
                return false;
            }
            // Additional validations if needed

            return true;
        }
    </script>
    {{-- <script>
        // jQuery("#invoice_no").blur(function () {
        jQuery(".view").click(function() {

            jQuery("#table_body").html("");

            var id = jQuery(this).attr("data-id");

            $('.modal-body').load('{{ url('job_info_modal_view_details/view/') }}' + '/' + id, function() {
                $('#myModal').modal({
                    show: true
                });
            });

        });
    </script> --}}
    <script>
        $(document).ready(function() {
            $("#warranty").select2();
            $("#status").select2();
            $("#job_delivery").select2();
            $("#tech_name").select2();
            $("#client_name").select2();
            $("#vendor_name").select2();
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
    {{-- farhad add thermal print script --}}
    <script>
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });
    </script>
@stop
