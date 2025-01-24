@extends('layouts.theme')
@section('content')


    <style>

        button, input {
            overflow: visible;
            border: none;
        }

        tbody {
            overflow-y: scroll;
            overflow-x: hidden;
            max-height: 180px;
        }

        /*.table-container {*/
        /*    height: 10em;*/
        /*}*/
        .table-responsive {
            overflow: hidden;
        }

        table {
            display: flex;
            flex-flow: column;
            /*height: 100%;*/
            width: 100%;
        }

        table thead {
            /* head takes the height it requires,
            and it's not scaled when table is resized */
            flex: 0 0 auto;
            /*width: calc(100% - 0.9em);*/
        }

        table tbody {
            /* body takes all the remaining available space */
            flex: 1 1 auto;
            display: block;
            overflow-y: scroll;
        }

        table tbody tr {
            width: 100%;
        }

        table thead, table tbody tr {
            display: table;
            table-layout: fixed;
        }

        td input {
            width: 100%;
        }
        @media only screen and (min-width: 1024px) {
            thead {
                width: 96.3%;
            }
            textarea{
                width: 100%;
                border: none;
                overflow: hidden;
                line-height: 1;
                margin-top: 0px;
                margin-bottom: 0px;}
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
                        <p class="mb-1">Edit Job Information</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Management</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Job Information</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Job Information</a></li>
                    </ol>
                </div>
            </div>
            @include('inc._message')

            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Job Information</h4>
                            <b style="color: red">Job ID = {{$job_info[0]->job_id}}</b>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" id="form" action="{{route('job_info.update', $job_info[0]->ji_id)}}" method="post" onsubmit="return maincheckForm()">
                                    @csrf
                                    @method("PUT")
                                    <div class="row">
                                        <div class="col-xl-12">

                                            <div class="form-group row">

                                                <input type="hidden" name="job_id" value="{{$job_info[0]->job_id}}">

                                                <div class="col-md-3">
                                                    <label class="col-form-label" for="number">Client Number
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="">
                                                        <input type="text" class="form-control" id="number"
                                                               name="number" placeholder="Enter a Number.." value="{{$job_info[0]->cli_number}}" onkeypress="return numberFormatter(event)">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="col-form-label" for="client_name">Client Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="">
                                                        <input type="text" class="form-control" id="client_name"
                                                               name="client_name" placeholder="Enter a Client Name.." value="{{$job_info[0]->cli_name}}" onkeypress="return lettersOnly(event)">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="col-form-label" for="client_address">Client Address
                                                    </label>
                                                    <div class="">
                                                        <input type="text" class="form-control" id="client_address"
                                                               name="client_address" placeholder="Enter a Client Address.." value="{{$job_info[0]->cli_address}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <label class="col-form-label" for="warranty">Warranty
                                                        {{--                                                        <span class="text-danger">*</span>--}}
                                                    </label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1" id="warrenty" name="warrenty" {{ ($job_info[0]->ji_warranty_status == 1 ? ' checked' : '') }}>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="display:none;" id="wandercol">
                                                    <label class="col-form-label" for="model">Warrenty Vendor
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="">
                                                        <select id="wander" name="wander" style="color: black">
                                                            <option value="0" style="color: black">Select Vendor</option>
                                                            @foreach($vendors as $vendor)
                                                                <option style="color: black" value="{{$job_info[0]->vendor_id}}" {{$job_info[0]->vendor_id == $job_info[0]->vendor_id ? 'selected="selected"':'' }}>
                                                                    {{$vendor->vendor_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="form-group row">


                                                <div class="col-md-3">
                                                    <label class="col-form-label" for="delivery_time">Delivery Time
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <?php
                                                    $date =date('Y-m-d', strtotime( $job_info[0]->ji_delivery_datetime ));
                                                    ?>

                                                    <div class="">
                                                        <input type="date" class="form-control" id="delivery_time"
                                                               name="delivery_time" placeholder="Enter a Delivery Time.."
                                                               value="{{ $date }}"
                                                            {{--                                                               value="{{ $job_info[0]->ji_delivery_datetime }}"--}}
                                                            {{--                                                               value="2018-07-22"--}}
                                                        >
                                                    </div>
                                                </div>




                                                <div class="col-md-3">
                                                    <label class="col-form-label" for="job_title">Job Title
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="">
                                                        <input readonly class="form-control" id="job_title"
                                                               name="job_title" value="{{$job_info[0]->ji_title}}" value="" placeholder="Enter a Job Title.." onchange="change_title()">
                                                    </div>
                                                </div>
                                                {{--                                                <div class="form-group row">--}}
                                                {{--                                                    <label class="col-lg-4 col-form-label" for="bra_name">Brand Name--}}
                                                {{--                                                        <span class="text-danger">*</span>--}}
                                                {{--                                                    </label>--}}
                                                {{--                                                    <div class="col-lg-8">--}}
                                                {{--                                                        <select id="brand" name="brand">--}}
                                                {{--                                                            <option value=0 selected disabled>Select</option>--}}
                                                {{--                                                            <option value="AL">Alabama</option>--}}
                                                {{--                                                            <option value="WY">Wyoming</option>--}}
                                                {{--                                                        </select>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}
                                                <div class="col-md-3">
                                                    <label class="col-form-label" for="brand">Brand
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="">
                                                        <div class="icons">
                                                            <a href="{{asset("add_brand")}}" style="color:black" target="_blank"><l class="fa fa-plus iconsl"></l></a>
                                                            <l id="bra_refresh" class="fa fa-refresh iconsl" style="cursor: pointer;"></l>
                                                        </div>
                                                        <select id="brand" name="brand">
                                                            <option value="0" selected disabled>Select</option>

                                                            @foreach($brands as $brand)
                                                                <option value="{{$brand->bra_id}}"  {{$job_info[0]->ji_bra_id == $brand->bra_id ? 'selected="selected"':'' }}>{{$brand->bra_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-3">
                                                    <label class="col-form-label" for="category">Category
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="">
                                                        <div class="icons">
                                                            <a href="{{asset("add_category")}}" style="color:black" target="_blank"><l class="fa fa-plus iconsl"></l></a>
                                                            <l id="cat_refresh" class="fa fa-refresh iconsl" style="cursor: pointer;"></l>
                                                        </div>
                                                        <select id="category" name="category">
                                                            @foreach($categories as $category)
                                                                <option value="{{$category->cat_id}}" {{$job_info[0]->ji_cat_id == $category->cat_id ? 'selected="selected"':'' }}>
                                                                    {{$category->cat_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="form-group row">

                                                <div class="col-md-3">
                                                    <label class="col-form-label" for="model">Model
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="">
                                                        <div class="icons">
                                                            <a href="{{asset("add_model")}}" style="color:black" target="_blank"><l class="fa fa-plus iconsl"></l></a>
                                                            <l id="mod_refresh" class="fa fa-refresh iconsl" style="cursor: pointer;"></l>
                                                        </div>
                                                        <select id="model" name="model">
                                                            @foreach($models as $model)
                                                                <option value="{{$model->mod_id}}" {{$job_info[0]->ji_mod_id == $model->mod_id ? 'selected="selected"':'' }}>
                                                                    {{$model->mod_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>



                                                <div class="col-md-3">
                                                    <label class="col-form-label" for="equipment">Equipment
                                                        {{--                                                        <span class="text-danger">*</span>--}}
                                                    </label>
                                                    <div class="">
                                                        <input type="text" class="form-control" id="equipment"
                                                               name="equipment" placeholder="Enter Equipments.." value="{{$job_info[0]->ji_equipment}}" >
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="col-form-label" for="serial_no">Serial No
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="">
                                                        <input type="text" class="form-control" id="serial_no"
                                                               name="serial_no" placeholder="Enter a Serial No.." onkeypress="return numbersOnly(value)" value="{{$job_info[0]->ji_serial_no}}">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="col-form-label" for="estimated_cost">Estimated Charges
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="">
                                                        <input readonly type="text" class="form-control" id="estimated_cost"
                                                               name="estimated_cost" placeholder="Enter a Estimated Cost.." onkeypress="return numbersOnly(value)" value="{{$job_info[0]->ji_estimated_cost}}">
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="form-group row">




                                                <div class="col-md-3">
                                                    <label class="col-form-label" for="complain">Complains<span class="text-danger">*</span>
                                                    </label>
                                                    <div class="">
                                                        <input type="text" class="form-control" id="complain"
                                                               name="complain" placeholder="Enter a Complain.." value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mt-auto">
                                                    <button type="button" onclick="add_complain()"  class="btn btn-primary">Add</button>
                                                </div>



                                                <div class="col-md-3">
                                                    <label class="col-form-label" for="accessories">Accessories<span class="text-danger">*</span>
                                                    </label>
                                                    <div class="">
                                                        <input type="text" class="form-control" id="accessories"
                                                               name="accessories" placeholder="Enter a Accessory.." value="">
                                                    </div>
                                                </div>

                                                <div class="col-md-3 mt-auto">
                                                    <button type="button" onclick="add_accessories()" class="btn btn-primary">Add</button>
                                                </div>


                                            </div>


                                            <div class="form-group row">

                                                <div class="col-lg-6">
                                                    {{--                                                    <div class="card">--}}
                                                    {{--                                                        <div class="card-header">--}}
                                                    {{--                                                            <h4 class="card-title">Bordered Table</h4>--}}
                                                    {{--                                                        </div>--}}
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered verticle-middle table-responsive-sm">
                                                                <thead>
                                                                <tr>
                                                                    <th scope="col" width="14%">Sr#</th>
                                                                    <th scope="col" >Task</th>
                                                                    <th scope="col" width="15%">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="table_body">


                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    {{--                                                    </div>--}}
                                                </div>

                                                <div class="col-lg-6">
                                                    {{--                                                    <div class="card">--}}
                                                    {{--                                                        <div class="card-header">--}}
                                                    {{--                                                            <h4 class="card-title">Bordered Table</h4>--}}
                                                    {{--                                                        </div>--}}
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered verticle-middle table-responsive-sm w-auto">
                                                                <thead>
                                                                <tr>
                                                                    <th scope="col" width="14%">Sr#</th>
                                                                    <th scope="col">Task</th>
                                                                    <th scope="col" width="15%">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="table_body2">


                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                </div>--}}

                                            </div>




                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
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

    {{--    <div class="modal fade" id="myModal" role="dialog">--}}
    {{--        <div class="modal-dialog modal-lg mdl_wdth">--}}
    {{--            <div class="modal-content base_clr">--}}
    {{--                <div class="modal-header">--}}
    {{--                    <h4 class="modal-title text-black">Sales Invoice Detail</h4>--}}
    {{--                    <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
    {{--                </div>--}}
    {{--                <div class="modal-body">--}}

    {{--                    <div id="table_body">--}}

    {{--                    </div>--}}

    {{--                </div>--}}

    {{--                <div class="modal-footer">--}}
    {{--                    <div class="col-lg-12 col-md-12 col-sm-12">--}}
    {{--                        <div class="form_controls">--}}
    {{--                            <button type="button" class="btn btn-default form-control cancel_button" data-dismiss="modal">--}}
    {{--                                <i class="fa fa-times"></i> Cancel--}}
    {{--                            </button>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}


    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}




@endsection
@section('script')

    <script>
        function change_title(){
            $("#brand").val();
        }
        $("#warrenty").click(function () {
            var check = $('#warrenty').is(':checked');
            if (check == true){
                $("#wandercol").css("display","block");
            }
            else
                $("#wandercol").css("display","none");
        });

        $(document).ready(function () {


            $("#brand").select2();
            $("#wander").select2();
            $("#model").select2();
            $("#category").select2();

            var job_id = '{!! $job_info[0]->job_id !!}';

            // alert(job_id);
            $("#brand").change(function () {
                title();
            });
            $("#category").change(function () {
                title();
            });
            $("#model").change(function () {
                title();
            });
            $("#equipment").change(function () {
                title();
            });
            $("#serial_no").change(function () {
                title();
            });

            var check = $('#warrenty').is(':checked');
            if (check == true){
                $("#wandercol").css("display","block");
            }
            else
                $("#wandercol").css("display","none");


            function title() {
                var brand = document.getElementById("brand");
                var brandtext = brand.options[brand.selectedIndex].text;
                var cat = document.getElementById("category");
                var cattext = cat.options[cat.selectedIndex].text;
                cattext = ((cat.value == 0)? "": cattext);
                var model = document.getElementById("model");
                var modeltext = model.options[model.selectedIndex].text;
                modeltext = ((model.value == 0)? "": modeltext);
                var equi = document.getElementById("equipment").value;
                var sr_no = document.getElementById("serial_no").value;
                document.getElementById("job_title").value = brandtext+"-"+cattext+"-"+modeltext+"-"+equi+"-"+sr_no;
            }

            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{route('get_data_job_info')}}",
                data: {job_id: job_id},
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function (data) {


                    console.log(data);

                    jQuery.each(data, function(index, item) {
                        if(item.jii_status == "Complain"){
                            counter++;
                            add_complain_row(counter, item.jii_item_name);
                        }


                    });

                    jQuery.each(data, function(index, item) {
                        if(item.jii_status == "Accessory") {

                            counter2++;
                            add_accessories_row(counter2, item.jii_item_name);
                        }
                    });

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.responseText);
                    alert(errorThrown);
                }
            });






// })



            $('#form').validate({ // initialize the plugin

                // rules: {
                //     client_name: {
                //         required: true,
                //         pattern: /^[A-Za-z0-9. ]{3,30}$/
                //     },
                //     client_no: {
                //         required: true,
                //         pattern:/^((\+92-?)|(0092-?)|(0))3\d{2}-?\d{7}$/
                //     },
                //     warranty: {
                //         required: true,
                //     },
                //     delivery_time: {
                //         required: true,
                //     },
                //     job_id: {
                //         required: true,
                //     },
                //     brand: {
                //         required: true,
                //     },
                //     model: {
                //         required: true,
                //     },
                //     category: {
                //         required: true,
                //     },
                //     equipment: {
                //         required: true,
                //         pattern: /^[A-Za-z0-9. ]{3,30}$/
                //     },
                //     serial_no: {
                //         required: true,
                //     },
                //     estimated_cost: {
                //         required: true,
                //         pattern:/^(\d+(,\d{1,2})?)?$/
                //     },
                //     complain: {
                //         pattern: /^[A-Za-z0-9. ]{3,30}$/
                //     },
                //     accessories: {
                //         pattern: /^[A-Za-z0-9. ]{3,30}$/
                //     }
                // },
                // messages: {
                //     client_name: {
                //         required: "Required",
                //     },
                //     client_no: {
                //         required: "Required",
                //     },
                //     delivery_time: {
                //         required: "Required",
                //     },
                //     job_id: {
                //         required: "Required",
                //     },
                //     brand: {
                //         required: "Required",
                //     },
                //     model: {
                //         required: "Required",
                //     },
                //     category: {
                //         required: "Required",
                //     },
                //     equipment: {
                //         required: "Required",
                //     },
                //     serial_no: {
                //         required: "Required",
                //     },
                //     estimated_cost: {
                //         required: "Required",
                //     }
                //
                // },

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



        var counter = 0;
        var counter2 = 0;


        function add_complain() {

            if(complain_checkForm()){
                counter++;

                var complain = $("#complain").val();

                add_complain_row(counter, complain);

            }else{

            }
        }

        function add_complain_row(counter, complain){

            jQuery("#table_body").append(

                '<tr id="table_row' + counter + '">' +
                '<td width="14%">' + counter + '</td>' +
                '<td>'+ '<textarea type="text" name="complain_data[]" id="complain_data'+ counter +'" value="'+ complain +'">'+complain+'</textarea>' +'</td>' +

                '<td width="15%">' +
                '<span>' +
                '<a href="javascript:void()" data-toggle="tooltip" data-placement="top" title="Close" onclick="deleterow('+ counter +')"><i class="fa fa-close color-danger"></i></a>' +
                '</span>' +
                '</td>' +

                '</tr>');

            $("#complain").val('');

        }

        function deleterow(count) {
            // Remove the row with the specified count
            $("#table_row" + count).remove();

            // Check if the count is 0 and reset the counter
            if (counter === 1) {
                counter = 0; // Reset the counter
            }
        }
        function deleterow2(count) {
            // Remove the row with the specified count
            $("#table_row2"+count).remove();

            // Check if the count is 0 and reset the counter
            if (counter2 === 1) {
                counter2 = 0; // Reset the counter
            }
        }


        function add_accessories() {


            if(accessories_checkForm()){

                counter2++;

                var accessories = $("#accessories").val();

                add_accessories_row(counter2, accessories);

            }else{

            }

        }

        function add_accessories_row(counter2, accessories){

            jQuery("#table_body2").append(

                '<tr id="table_row2' + counter2 + '">' +
                '<td width="14%">' + counter2 + '</td>' +
                '<td>'+ '<textarea type="text" name="accessory_data[]" id="accessories_data'+ counter2 +'" value="'+ accessories +'">'+ accessories +' </textarea>' +'</td>' +

                '<td width="15%">' +
                '<span>' +
                '<a href="javascript:void()" data-toggle="tooltip" data-placement="top" title="Close" onclick="deleterow2('+ counter2 +')"><i class="fa fa-close color-danger"></i></a>' +
                '</span>' +
                '</td>' +

                '</tr>');



            $("#accessories").val('');


        }




    </script>

    <script>

        jQuery("#brand").change(function () {
            var bra_name_id =$(this).val();

            // var dropDown = document.getElementById('brand');
            // var bra_name_id = dropDown.options[dropDown.selectedIndex].value;

            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{route('get_category')}}",
                data: {bra_name_id: bra_name_id},
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function (data) {

                    console.log(data);
                    $options = "<option value='' disabled selected>Select Category</option>";
                    //
                    $.each(data,function (index, value) {
                        $options += "<option value='" + value.cat_id + "'>" + value.cat_name + "</option>";
                    });
                    jQuery("#category").html(" ");
                    jQuery("#category").append($options);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.responseText);
                    alert(errorThrown);
                }
            });
        });

        jQuery("#category").change(function () {
            var cat_name_id =$(this).val();

            // var dropDown = document.getElementById('brand');
            // var bra_name_id = dropDown.options[dropDown.selectedIndex].value;

            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{route('get_model')}}",
                data: {cat_name_id: cat_name_id},
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function (data) {

                    console.log(data);
                    $options = "<option value='' disabled selected>Select Model</option>";
                    //
                    $.each(data,function (index, value) {
                        $options += "<option value='" + value.mod_id + "'>" + value.mod_name + "</option>";
                    });
                    jQuery("#model").html(" ");
                    jQuery("#model").append($options);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.responseText);
                    alert(errorThrown);
                }
            });
        });

        $('#client_no').blur(function () {
            var number = $('#client_no').val();

            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{route('client_exist')}}",
                // url: "client_exist",
                data: {number: number},
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    jQuery("#client_name").val(data['cli_name']);
                    jQuery("#client_address").val(data['cli_address']);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.responseText);
                    alert(errorThrown);
                }
            });


        });

    </script>

    <script type="text/javascript">

        function maincheckForm() {

            let number = document.getElementById("number"),

                client_name = document.getElementById("client_name"),

                delivery_time = document.getElementById("delivery_time"),

                brand = document.getElementById("brand"),

                category = document.getElementById("category"),

                model = document.getElementById("model"),

                // equipment = document.getElementById("equipment"),

                serial_no = document.getElementById("serial_no"),

                estimated_cost = document.getElementById("estimated_cost"),

                validateInputIdArray = [

                    number.id,

                    client_name.id,
                    brand.id,

                    category.id,

                    model.id,
                    serial_no.id,
                    delivery_time.id,

                    // equipment.id,



                    // estimated_cost.id

                ];

            // return validateInventoryInputs(validateInputIdArray);

            var ok = validateInventoryInputs(validateInputIdArray);

            if (brand.value == 0) {

                brand.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"

                return false;

            } else {

                brand.nextSibling.childNodes[0].childNodes[0].style.border = ""

            }

            if (category.value == 0) {

                category.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"

                return false;

            } else {

                category.nextSibling.childNodes[0].childNodes[0].style.border = ""

            }

            if (model.value == 0) {

                model.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"

                return false;

            } else {

                model.nextSibling.childNodes[0].childNodes[0].style.border = ""

            }

            if (number.value.length == 12) {

                number.classList.remove('red-border');

            } else {

                number.classList.add('red-border');

                return false;

            }


            if (ok) {

                alert(counter)
                alert(counter2)
                if (counter == 0) {

                    $("#complain").addClass('bg-danger');

                    return false;

                } else if (counter2 == 0) {

                    $("#accessories").addClass('bg-danger');

                    return false;

                } else {
                    // alert(123)
                    // Disable the submit button
                    $("button[type='submit']").prop('disabled', true);
                    return true;

                }

            } else {

                return false;

            }

            var check = $('#warrenty').is(':checked');

            if (check == true) {

                if ($("#wander").val() == "0") {

                    alert("Select Vendor First");

                    return false;

                } else {

                    $("#wandercol").css("display", "none");
                    $('#loading').show();
                }

            }

        }

        function complain_checkForm() {
            let complain = document.getElementById("complain"),
                validateInputIdArray = [
                    complain.id,
                ];
            return validateInventoryInputs(validateInputIdArray);
        }

        function accessories_checkForm() {
            let accessories = document.getElementById("accessories"),
                validateInputIdArray = [
                    accessories.id,
                ];
            return validateInventoryInputs(validateInputIdArray);
        }

        function validateInventoryInputs(InputIdArray) {
            let i = 0,
                flag = false,
                getInput = '';

            for (i; i < InputIdArray.length; i++) {
                if (InputIdArray) {
                    getInput = document.getElementById(InputIdArray[i]);
                    if (getInput.value === '' || getInput.value === 0) {
                        getInput.focus();
                        getInput.classList.add('bg-danger');
                        flag = false;
                        break;
                    } else {
                        getInput.classList.remove('bg-danger');
                        flag = true;
                    }
                }
            }
            return flag;
        }


    </script>
@stop


