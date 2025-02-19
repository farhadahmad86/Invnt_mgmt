@extends('layouts.theme')

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
        .input{
            border: none;
            background: none;
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
                        <p class="mb-1">Job Part Registration List</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Registration</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Part Registration</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Part Registration List</a></li>
                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Part Registration List</h4>
                            <!-- Ibrahim add -->
                            {{--                        <button >--}}
                            <div class="srch_box_opn_icon">
                                <i id="search_hide" onclick="hide_the_search();" class="fa fa-search icon-hide"></i>
                            </div>
                            {{--                        </button>--}}
                        </div>
                        <div class="card-body">

{{--                            <form action="" method="get">--}}

{{--                                <div class="row">--}}

{{--                                    <div class="col-1-5">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="">Part Name</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}



{{--                                    <div class="col-1-5">--}}
{{--                                        <div class="form-group mb-0">--}}
{{--                                            <input  type="text" tabindex="1" id="job_no" name="job_no" class="form-control form-control-sm"--}}
{{--                                                    value="">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}







{{--                                    <div class="col">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <button tabindex="8" class="btn btn-primary btn-sm" id="customer_search">--}}
{{--                                                Search--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}


{{--                            </form>--}}


                            <form class="form-valide" id="form" action="{{route('store_openning')}}"
                                  method="post" onsubmit="return checkform()">
                                @csrf

                            <div class="table-responsive">
                                <table id="" class="table table-striped table-bordered display" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        {{--                                        <th>User Name</th>--}}
                                        <th>Part Name</th>

{{--                                        <th>Purchase Price</th>--}}
{{--                                        <th>Bottom Price</th>--}}
{{--                                        <th>Retail Price</th>--}}
                                        {{--                                        <th>Average Price</th>--}}
                                        {{--                                        <th>Last Purchase Price</th>--}}
                                        <th>Opening stock</th>
{{--                                        <th>Cutternt stock</th>--}}
{{--                                        <th>Total stock</th>--}}


                                        {{--                                        <th>Created At</th>--}}
                                        {{--                                        <th>Updated At</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>


                                    @php
                                        $segmentSr  = (!empty(app('request')->input('segmentSr'))) ? app('request')->input('segmentSr') : '';
                                        $segmentPg  = (!empty(app('request')->input('page'))) ? app('request')->input('page') : '';
                                        $sr = (!empty($segmentSr)) ? $segmentSr * $segmentPg - $segmentSr + 1 : 1;
                                        $countSeg = (!empty($segmentSr)) ? $segmentSr : 0;
                                        $prchsPrc = $slePrc = $avrgPrc = 0;
                                    @endphp


{{--                                    {{$counter = 1}}--}}
                                    @foreach($parts as $part)
                                    <tr>
                                        <td>{{$sr}}</td>

                                        <td hidden><input name="part_id[]"  class="input" readonly value="{{$part->par_id}}"></td>
{{--                                        <td><input id="part_name[]" class="input" readonly value="{{$part->par_sale_price}}"></td>--}}
                                        <td><input name="part_purchase[]" class="input" readonly value="{{$part->par_name}}"></td>
{{--                                        <td><input id="part_bottom[]" class="input" readonly value="{{$part->par_purchase_price}}"></td>--}}
{{--                                        <td><input id="part_retail[]" class="input" readonly value="{{$part->par_bottom_price}}"></td>--}}
{{--                                        <td><input id="part_opening[]" class="input" onkeyup="add_openning()"></td>--}}

                                        <td><input onkeypress="return numbersOnly(event)" name="qty[]" class="input" ></td>
{{--                                        <td><input onkeypress="return numbersOnly(event)" name="qty[]" class="input" value="{{$part->par_total_qty}}" ></td>--}}
{{--                                        <td><input id="part_id[]" class="input" readonly></td>--}}

                                    </tr>

{{--                                        {{$counter++}}--}}

                                    @php
                                        $sr++; (!empty($segmentSr) && $countSeg !== '0') ?  : $countSeg++;
                                    @endphp
                                    @endforeach




                                    </tbody>

                                </table>
                            </div>
                            {{ $parts->links() }}
                                <button type="submit" class="btn btn-primary" tabindex="8">Save
                                </button>

                            </form>
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
        $(document).ready(function () {
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
                errorPlacement: function (e, a) {
                    jQuery(a).parents(".form-group > div").append(e)
                },
                highlight: function (e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
                },
                success: function (e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
                },

            });


        });
        function add_openning(){
            alert("work");
        }
    </script>
@stop
