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
                        <p class="mb-1">Job Information Detail List</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Management</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Information</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Job Information Detail List</a></li>
                    </ol>
                </div>
            </div>
            @include('inc._message')
            <!-- row -->



            <div class="row">
                <div class="col-12">
                    <div class="card">
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

                            <form action="{{ route('add_job_info_list.index') }}" method="get">

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



                                {{--                second --}}



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

                                    {{--                                    <div class=" col-1-5"> --}}
                                    {{--                                        <input type="text" tabindex="6" name="from_date" class="form-control date advance_search form-control-sm" --}}
                                    {{--                                               value="{{$from_date}}" id="from_date" placeholder="Choose..."> --}}
                                    {{--                                    </div> --}}
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
                                        {{--                                        <input tabindex="4" type="text" name="status" class="form-control form-control-sm" --}}
                                        {{--                                               id="status"> --}}

                                        <select id="status" name="status">
                                            {{--                                            <option value="0" selected disabled>Select</option> --}}

                                            <option value="" selected disabled>Select Status</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Assign">Assign</option>
                                            <option value="Close">Close</option>
                                            <option value="Paid">Paid</option>
                                            <option value="Credit">Credit</option>

                                        </select>
                                    </div>





                                    {{--                                    <div class="col-1-5"> --}}
                                    {{--                                        <div class="form-group mb-0"> --}}

                                    {{--                                        </div> --}}
                                    {{--                                    </div> --}}


                                    {{--                                    <div class=" col-1-5"> --}}
                                    {{--                                        <label class="float-right mt-2" for=""></label> --}}
                                    {{--                                    </div> --}}



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



                                    {{--                                    <div class=" col-1-5"> --}}
                                    {{--                                        <input type="text" name="to_date" tabindex="7" class="form-control date advance_search form-control-sm" --}}
                                    {{--                                               value="{{$to_date}}" id="to_date" placeholder="Choose..."> --}}
                                    {{--                                    </div> --}}
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
                                            {{--                                            <option value="0" selected disabled>Select</option> --}}

                                            <option value="" selected disabled>Select Warranty</option>
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>

                                        </select>
                                    </div>


                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">Technician</label>
                                    </div>


                                    <div class=" col-1-5">
                                        <input tabindex="4" type="text" name="tech_name"
                                            class="form-control form-control-sm" id="tech_name">
                                    </div>
                                </div>
                                <div class="row">

                                </div>

                            </form>




                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered display"
                                    style="min-width: 845px">
                                    <thead>
                                        <tr>

                                            <th>Job No</th>
                                            <th>Technician</th>
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
                                            <th>Amount Pay (Rs)</th>
                                            <th>Remaining</th>

                                            <th>Complain</th>
                                            <th>Accessories</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            {{--                                        <th>Actions</th> --}}


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
                                                <td>{{ $brand->ji_id }}</td>
                                                <td>{{ $brand->tech_name }}</td>
                                                <td>{{ $brand->cli_name }}</td>
                                                <td>{{ $brand->cli_number }}</td>
                                                <td class="view" data-id="{{ $brand->ji_id }}"
                                                    style="color:#007bff;cursor: pointer;white-space: nowrap;">
                                                    {{ $brand->ji_title }}</td>

                                                <td>{{ $brand->ji_warranty_status == 1 ? 'Yes' : '' }}</td>
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

                                                {{--                                            <td>{{$complain_items->jii_item_name}}</td> --}}
                                                {{--                                            <td>{{$brand->ji_recieve_datetime}}</td> --}}
                                                {{--                                            <td>{{$brand->ji_recieve_datetime}}</td> --}}
                                                {{--                                            <td>{{$brand->ji_delivery_datetime}}</td> --}}

                                                @foreach ($complain_items as $complain)
                                                    @if ($complain->jii_ji_id == $brand->ji_id)
                                                        <td>{{ $complain->jii_item_name }}</td>
                                                    @endif
                                                @endforeach


                                                @foreach ($accessory_items as $complain)
                                                    @if ($complain->jii_ji_id == $brand->ji_id)
                                                        <td>{{ $complain->jii_item_name }}</td>
                                                        {{--                                               --}}
                                                    @endif
                                                @endforeach

                                                <td>{{ date('d-m-Y', strtotime($brand->ji_recieve_datetime)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($brand->ji_delivery_datetime)) }}</td>
                                                {{--                                            <td><a href="{{route('job_info.edit',$brand->ji_id)}}"><i class="fas fa-edit"></i></a></td> --}}

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


    <div class="modal fade" id="myModal" role="dialog">
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


@endsection
@section('script')

    <script>
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
@stop
