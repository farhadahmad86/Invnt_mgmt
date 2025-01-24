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
                        <p class="mb-1">Job Information List</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb hidden-print">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Management</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Information</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Job Information List</a></li>
                    </ol>
                </div>
            </div>
            @include('inc._message')
            <!-- row -->



            <div class="row hidden-print">
                <div class="col-12">
                    <div class="card hidden-print">
                        <div class="card-header">
                            <h4 class="card-title">Job Information List</h4>
                            <!-- Ibrahim add -->
                            {{-- <button > --}}
                            <div class="srch_box_opn_icon">
                                <i id="search_hide" onclick="hide_the_search();" class="fa fa-search icon-hide"></i>
                            </div>
                            {{-- </button> --}}
                        </div>
                        <div class="card-body">

                            <form action="{{ route('job_info.index') }}" method="get">

                                <div class="row">

                                    <div class="col-1">
                                        <div class="form-group mb-0">
                                            <label class="float-right mt-2" for="">Search</label>
                                        </div>
                                    </div>

                                    <div class="col-1-5">
                                        <div class="form-group mb-0">
                                            <label for=""></label>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="form-group mb-0">
                                            <label class="float-right mt-2" for="">Client</label>
                                        </div>
                                    </div>

                                    <div class="col-1-5">
                                        <div class="form-group mb-0">
                                            <label for=""></label>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="form-group mb-0">
                                            <label class="float-right mt-2" for="">Date</label>
                                        </div>
                                    </div>

                                    <div class="col-1-5">
                                        <div class="form-group mb-0">
                                            <label for=""></label>
                                        </div>
                                    </div>

                                </div>



                                {{-- second --}}
                                <div class="row">


                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">Job#</label>
                                    </div>


                                    <div class=" col-1-5">
                                        <input tabindex="4" type="text" name="job_no"
                                            class="form-control form-control-sm" id="job_no">
                                    </div>


                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">Name</label>
                                    </div>


                                    <div class=" col-1-5">
                                        <input tabindex="4" type="text" name="client_name"
                                            class="form-control form-control-sm" id="client_name">
                                    </div>

                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">From</label>
                                    </div>

                                    <div class=" col-1-5">
                                        <input type="date" tabindex="6" name="from_date"
                                            class="form-control date advance_search form-control-sm" value=""
                                            id="from_date" placeholder="Choose...">
                                    </div>






                                </div>


                                <div class="row">



                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">Status</label>
                                    </div>


                                    <div class=" col-1-5">
                                        {{-- <input tabindex="4" type="text" name="status" class="form-control form-control-sm" --}}
                                        {{-- id="status"> --}}

                                        <select id="status" name="status">
                                            {{-- <option value="0" selected disabled>Select</option> --}}

                                            <option value="" selected disabled>Select Status</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Assign">Assign</option>
                                            <option value="Close">Close</option>
                                            <option value="Paid">Paid</option>
                                            <option value="Credit">Credit</option>

                                        </select>
                                    </div>



                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">Number</label>
                                    </div>


                                    <div class=" col-1-5">
                                        <input tabindex="5" type="text" name="client_number"
                                            class="form-control form-control-sm" id="client_number">
                                    </div>






                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">To</label>
                                    </div>



                                    <div class=" col-1-5">
                                        <input type="date" name="to_date" tabindex="7"
                                            class="form-control date advance_search form-control-sm" value=""
                                            id="to_date" placeholder="Choose...">
                                    </div>



                                    <div class="col-0-5">
                                        <div class="form-group">
                                            <button tabindex="8" class="btn btn-primary btn-sm" id="customer_search">
                                                Search
                                            </button>
                                        </div>
                                    </div>




                                    <div class="col-0-5">
                                        <div class="form-group">
                                            <button tabindex="8" class="btn btn-primary btn-sm" id="pdf_download"
                                                name="pdf_download" value="1">
                                                Download
                                            </button>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">



                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">Warranty</label>
                                    </div>
                                    <div class="col-1-5">
                                        <select id="warranty" name="warranty">
                                            {{-- <option value="0" selected disabled>Select</option> --}}

                                            <option value="" selected disabled>Select Warranty</option>
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>

                                        </select>
                                    </div>



                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">Warrenty Vendor</label>
                                    </div>


                                    <div class=" col-1-5">
                                        <input tabindex="4" type="text" name="vendor_name"
                                            class="form-control form-control-sm" id="vendor_name">
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered display"
                                    style="min-width: 845px">
                                    <thead>
                                        <tr>

                                            <th>Job No</th>
                                            <th>Client Name</th>
                                            <th>Client Number</th>
                                            <th>Job Title</th>
                                            <th>Warrenty</th>
                                            <th>Vendor</th>
                                            <th>Brand</th>
                                            <th>Category</th>
                                            <th>Model</th>
                                            <th>Equipment</th>
                                            <th>Status</th>
                                            <th>Serial Number</th>
                                            <th>Cost</th>

                                            <th>Complain</th>
                                            <th>Accessories</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Actions</th>


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
                                                {{-- <td>{{$sr}}</td> --}}
                                                <td>{{ $brand->ji_id }}</td>
                                                <td>{{ $brand->cli_name }}</td>
                                                <td>{{ $brand->cli_number }}</td>
                                                {{-- <td class="view" data-id="{{$brand->ji_id}}" style="color:#007bff;cursor: pointer;white-space: nowrap;">{{$brand->ji_title}}</td> --}}
                                                <td onclick="thermal_print({{ $brand->ji_id }})"
                                                    style="color:#007bff;cursor: pointer;white-space: nowrap;">
                                                    {{ $brand->ji_title }}</td>
                                                {{-- <td><button type="button" class="btn btn-primary hidden-print thermalView" data-id="{{$brand->ji_id}}" data-bs-toggle="modal" data-bs-target="#exampleModall">
                                        Print
                                        </button></td> --}}
                                                {{-- <td><button type="button" class="btn btn-primary" onclick="thermal_print({{ $brand->ji_id }})">
                                                Print
                                            </button></td> --}}
                                                <td>{{ $brand->ji_warranty_status == 1 ? 'Yes' : '' }}</td>

                                                <td>{{ $brand->vendor_name }}</td>
                                                <td>{{ $brand->bra_name }}</td>
                                                <td>{{ $brand->cat_name }}</td>
                                                <td>{{ $brand->mod_name }}</td>
                                                <td>{{ $brand->ji_equipment }}</td>

                                                <td>{{ $brand->ji_job_status }}</td>
                                                <td>{{ $brand->ji_serial_no }}</td>
                                                <td>{{ $brand->ji_estimated_cost }}</td>

                                                {{-- <td>{{$complain_items->jii_item_name}}</td> --}}
                                                {{-- <td>{{$brand->ji_recieve_datetime}}</td> --}}
                                                {{-- <td>{{$brand->ji_recieve_datetime}}</td> --}}
                                                {{-- <td>{{$brand->ji_delivery_datetime}}</td> --}}

                                                @php
                                                foreach ($complain_items as $complain){
                                                    if ($complain->jii_ji_id == $brand->ji_id){
                                                    @endphp
                                                        <td>{{ $complain->jii_item_name }}</td>
                                                        @php
                                                    }
                                                    }
foreach ($accessory_items as $complain){
                                                    if ($complain->jii_ji_id == $brand->ji_id){
                                                    @endphp
                                                        <td>{{ $complain->jii_item_name }}</td>
                                                        @php
                                                    }
                                                    }
                                                @endphp

                                                <td>{{ date('d-m-Y', strtotime($brand->ji_recieve_datetime)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($brand->ji_delivery_datetime)) }}</td>
                                                <td><a href="{{ route('job_info.edit', $brand->ji_id) }}"><i
                                                            class="fas fa-edit"></i></a></td>

                                            </tr>

                                            @php
                                                $sr++;
                                                !empty($segmentSr) && $countSeg !== '0' ?: $countSeg++;
                                            @endphp
                                        @endforeach


                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <!--**********************************
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Content body end
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ***********************************-->

    <!-- Modal -->
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

    {{-- <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg mdl_wdth">
            <div class="modal-content base_clr">
                <div class="modal-header">
                    <h4 class="modal-title text-black">Job Card Detail</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div id="table_body">

                    </div>

                </div>

                <div class="modal-footer">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form_controls">
                            <button type="button" class="btn btn-default form-control cancel_button" data-dismiss="modal">
                                <i class="fa fa-times"></i> Cancel
                            </button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div> --}}

@endsection
@section('script')
    {{-- <script>
        function thermal_print(id) {

            $('#body_print').html(" ");
            jQuery.ajax({
                url: "job_info_thermal_modal_view_details/view/" + id,
                data: {
                    id: id
                },
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var warrenty = 'No';
                    if (data.items.ji_warranty_status == 1) {
                        warrenty = 'Yes';
                    }
                    const delivery_date = moment(data.items.ji_delivery_datetime).format('DD-MM-YYYY');
                    const booking_date = moment(data.items.ji_recieve_datetime).format('DD-MM-YYYY');
                    // const d = date('d-m-Y', strtotime( data.items.ji_delivery_datetime ));
                    let faults = '';
                    let accessories = '';
                    $.each(data.complain_items, function(index, value) {
                        faults += value.jii_item_name + ', ';

                    });
                    $.each(data.accessory_items, function(index, value) {
                        accessories += value.jii_item_name + ', ';

                    });

                    var modalbody =
                        // '<div class="ticket">
                        `<p class="centered fw-bold">Job Card</p>
                        <img class="img-center" src="{{ asset('') }}${data.company_profile.cp_logo}" alt="Logo" width="100" height="100">
                        <p class="centered fw-bold" style="line-height: 12px;"> ${data.company_profile.cp_address} - ${data.company_profile.cp_contact}  </p>
                        <table class="table job_t">
                        <tr class="job_tr">
                            <th style="padding-left: 70px;">Job ID :</th>
                            <td style="padding-left: 100px;">${data.items.ji_id}</td>

                        </tr>
                        <tr style="position: relative;top: 10px;">
                            <th>Consumer Name:</th>
                            <td>${data.items.cli_name}</td>
                        </tr>
                        <tr>
                            <th>Contact Number:</th>
                            <td>${data.items.cli_number}</td>
                        </tr>
                        <tr>
                        <td colspan="2" style="border-top:2px dashed #000">&nbsp</td>
                        </tr>

                        <tr class="tr_line">
                            <th>Receiving Date</th>
                            <td>${booking_date}</td>
                        </tr>
                        <tr class="tr_line">
                            <th>Brand</th>
                            <td>${data.items.bra_name}</td>
                        </tr>
                        <tr class="tr_line">
                            <th>Categary</th>
                            <td>${data.items.cat_name}</td>
                        </tr>
                        <tr class="tr_line">
                            <th>Model</th>
                            <td>${data.items.mod_name}</td>
                        </tr>
                        <tr class="tr_line">
                            <th>Fault</th>
                            <td class="content-line">${faults}</td>
                        </tr>
                        <tr>
                            <th>Accessories</th>
                            <td class="content-line">${accessories}</td>
                        </tr>
                        <tr class="tr_line">
                            <th>Warranty</th>
                            <td>${warrenty}</td>
                        </tr>
                        <tr class="tr_line">
                            <th>Est. Charges</th>
                            <td>${data.items.ji_estimated_cost}</td>
                        </tr>
                        <tr class="tr_line">
                            <th>Est. Delivery Date</th>
                            <td>${delivery_date}</td>
                        </tr>
                        </table>`;


                    // let terms = data.company_profile.cp_terms.replace(/,/g, "<br>");
                    let terms = data.company_profile.cp_terms;

                    modalbody += `</p>
                        <span class="fw-bold" style="line-height: 5px;"> Terms & Conditions </span>
                        <p class="ml-3 urdu"> ${terms} </p>`;
                    // '</div>';
                    $('#body_print').html(modalbody);


                }
            });

            $('#exampleModall').modal('show');
        }
    </script> --}}
    <script>
        // jQuery("#invoice_no").blur(function () {
        // jQuery(".view").click(function() {

        //     jQuery("#table_body").html("");

        //     var id = jQuery(this).attr("data-id");

        //     $('.modal-body').load('{{ url('job_info_modal_view_details/view/') }}' + '/' + id, function() {
        //         $('#myModal').modal({
        //             show: true
        //         });
        //     });

        // });



        jQuery(".thermalView").click(function() {
            alert(2);
            jQuery("#table_body").html("");

            var id = jQuery(this).attr("data-id");

            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "job_info_thermal_modal_view_details/view/" + id,
                data: {
                    id: id
                },
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var modalbody = '';
                    modalbody = '<div class="ticket">' +
                        '<p class="centered fw-bold">Job Card</p>' +
                        '<img src="./logo.png" alt="Logo">' +
                        ' <p class = "centered fw-bold" > Company Name < br > Company Salogan < /p>' +
                        ' <p class = "fw-bold" > Job #99999</p>' +
                        '<p>Booking Date: 29-12-2022</p>' + ' <
                    p > Delivery Date: 29 - 12 - 2022 < /p>'+' <
                    p > Job Title: _____________ '+
                    '</p>' + ' <
                    p > Client Name: _____________ '+
                    '</p>' + ' <
                    p > Client Mobile # 03008639171 '+
                    '</p>' + ' <
                    p > Warrenty: Omega Power < /p>'+' <
                    p > Complaints: '+' <
                        br > 1. ___________ '+' <
                        br > 2. ___________ '+' <
                        br > 3. ___________ '+' <
                        /p>'+' <
                    p > Accessories: '+' <
                        br > 1. ___________ '+
                    '<br> 2.___________' +
                    '<br> 3.___________' +
                    '</p>' + ' <
                    p class = "centered fw-bold" > Estimated Cost: 120, 000 < /p>'+' <
                    p class = "centered bold" > Rupees One Lac Twenty Thousand Only < /p>'+' <
                    p class = "centered bold" > We Deal in (Multilines) < /p>'+'

                        <
                        p class = "centered bold" > Contact # 1 03130456524 < /p>'+' <
                    p class = "centered bold" > Contact # 1 03130456524 < /p>'+' <
                    p class = "centered" > '+'
                    Company Address '+
                    '</p>                </div>';
                    console.log(modalbody);
                    $('#body_off_modal').html(modalbody);
                    $('#exampleModall').modal({
                        show: true
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.responseText);
                    alert(errorThrown);
                }
            });


            // $('.modal-body').load('{{ url('job_info_thermal_modal_view_details/view/') }}' + '/' + id, function() {
            //     $('#myModall').modal({
            //         show: true
            //     });
            // });

        });
    </script>
    <script>
        $(document).ready(function() {
            $("#warranty").select2();
            $("#status").select2();
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
