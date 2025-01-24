@extends('layouts.theme')

@section('content')
    <style>
        #loading {
            position: fixed;
            display: block;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            text-align: center;
            opacity: 0.7;
            background-color: #fff;
            z-index: 99;
        }

        #loading-image {
            position: absolute;
            top: 100px;
            left: 240px;
            z-index: 100;
        }
    </style>

    <style>
        button,
        input {

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


        table thead,
        table tbody tr {

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

            textarea {

                width: 100%;

                border: none;

                overflow: hidden;

                line-height: 1;

                margin-top: 0px;

                margin-bottom: 0px;
            }

        }


        .icons {

            position: absolute;

            right: 15px;

            top: 8px;

        }
    </style>





    {{--    <!--********************************** --}}

    {{--                Content body start --}}

    {{--            ***********************************--> --}}

    <div id="loading">
        <img id="loading-image" src="{{ asset('loader/loader.gif') }}" alt="Loading..." />
    </div>
    <div class="content-body hidden-print">

        <div class="container-fluid hidden-print">

            <div class="row page-titles mx-0 hidden-print">

                <div class="col-sm-6 p-md-0 hidden-print">

                    <div class="welcome-text hidden-print">

                        <h4>Hi, welcome back!</h4>

                        <p class="mb-1">Job Information</p>

                    </div>

                </div>

                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex hidden-print">

                    <ol class="breadcrumb hidden-print">

                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Management</a></li>

                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Information</a></li>

                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Job Information</a></li>

                    </ol>

                </div>

            </div>

            @include('inc._message')

            @php
                
                if ($job_id == null) {
                    $jobi = 1;
                } else {
                    $jobi = $job_id->ji_id + 1;
                }
                
            @endphp

            <!-- row -->

            <div class="row hidden-print">

                <div class="col-lg-12 hidden-print">

                    <div class="card hidden-print">

                        <div class="card-header">

                            <h4 class="card-title">Form Job Information</h4>

                            <b style="color: red">Job ID = {{ $jobi }}</b>

                        </div>

                        <div class="card-body hidden-print">

                            <div class="form-validation hidden-print">

                                <form class="form-valide" id="form" action="{{ route('job_info.store') }}"
                                    method="post" onsubmit="return maincheckForm()">

                                    @csrf

                                    <div class="row">

                                        <div class="col-xl-12">


                                            <div class="form-group row">
                                                <div class="col-md-3">

                                                    <label class="col-form-label col-form-label-sm" for="job_title">Job
                                                        Title

                                                        <span class="text-danger">*</span>

                                                    </label>

                                                    <div class="">

                                                        <input readonly class="form-control form-control-sm" id="job_title"
                                                            name="job_title" value=""
                                                            placeholder="Enter a Job Title.." onchange="change_title()">

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group row">


                                                <div class="col-md-3">

                                                    <label class="col-form-label col-form-label-sm" for="number">Client
                                                        Number

                                                        <span class="text-danger">*</span>

                                                    </label>

                                                    <div class="">

                                                        <input type="text" class="form-control form-control-sm"
                                                            id="number" name="number" placeholder="Enter a Number.."
                                                            onkeypress="return numberFormatter(event)">

                                                    </div>

                                                </div>


                                                <div class="col-md-3">

                                                    <label class="col-form-label col-form-label-sm" for="client_name">Client
                                                        Name

                                                        <span class="text-danger">*</span>

                                                    </label>

                                                    <div class="">

                                                        <input type="text" class="form-control form-control-sm"
                                                            id="client_name" name="client_name"
                                                            placeholder="Enter a Client Name.."
                                                            onkeypress="return lettersOnly(event)">

                                                    </div>

                                                </div>


                                                <div class="col-md-3">

                                                    <label class="col-form-label col-form-label-sm"
                                                        for="client_address">Client Address

                                                    </label>

                                                    <div class="">

                                                        <input type="text" class="form-control form-control-sm"
                                                            id="client_address" name="client_address"
                                                            placeholder="Enter a Client Address..">

                                                    </div>

                                                </div>


                                                <div class="col-md-1">


                                                    <label class="col-form-label col-form-label-sm" for="warranty">Warranty

                                                        {{-- <span class="text-danger">*</span> --}}

                                                    </label>

                                                    <div class="form-check">

                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            id="warrenty" name="warrenty">

                                                    </div>

                                                </div>

                                                <div class="col-md-2" style="display:none;" id="wandercol">

                                                    <label class="col-form-label col-form-label-sm" for="model">Warrenty
                                                        Vendor

                                                        <span class="text-danger">*</span>

                                                    </label>

                                                    <div class="">

                                                        <select id="wander" name="wander" style="color: black">

                                                            <option value="0" style="color: black">Select Vendor
                                                            </option>

                                                            @foreach ($vendors as $vendor)
                                                                <option style="color: black"
                                                                    value="{{ $vendor->vendor_id }}"
                                                                    {{ $vendor->vendor_name == $vendor->vendor_id ? 'selected="selected"' : '' }}>

                                                                    {{ $vendor->vendor_name }}</option>
                                                            @endforeach

                                                        </select>

                                                    </div>

                                                </div>


                                            </div>


                                            <div class="form-group row">


                                                {{-- <div class="form-group row"> --}}

                                                {{-- <label class="col-lg-4 col-form-label col-form-label-sm" for="bra_name">Brand Name --}}

                                                {{-- <span class="text-danger">*</span> --}}

                                                {{-- </label> --}}

                                                {{-- <div class="col-lg-8"> --}}

                                                {{-- <select id="brand" name="brand"> --}}

                                                {{-- <option value=0 selected disabled>Select</option> --}}

                                                {{-- <option value="AL">Alabama</option> --}}

                                                {{-- <option value="WY">Wyoming</option> --}}

                                                {{-- </select> --}}

                                                {{-- </div> --}}

                                                {{-- </div> --}}

                                                <div class="col-md-3">

                                                    <label class="col-form-label col-form-label-sm" for="brand">Brand

                                                        <span class="text-danger">*</span>

                                                    </label>

                                                    <div class="">

                                                        <div class="icons">

                                                            <a href="{{ asset('add_brand') }}" style="color:black"
                                                                target="_blank">
                                                                <l class="fa fa-plus iconsl"></l>
                                                            </a>

                                                            <l id="bra_refresh" class="fa fa-refresh iconsl"
                                                                style="cursor: pointer;"></l>

                                                        </div>

                                                        <select id="brand" name="brand">

                                                            <option value="0" selected disabled>Select</option>


                                                            @foreach ($brands as $brand)
                                                                <option value="{{ $brand->bra_id }}">{{ $brand->bra_name }}
                                                                </option>
                                                            @endforeach

                                                        </select>

                                                    </div>

                                                </div>


                                                <div class="col-md-3">

                                                    <label class="col-form-label col-form-label-sm"
                                                        for="category">Category

                                                        <span class="text-danger">*</span>

                                                    </label>

                                                    <div class="">

                                                        <div class="icons">

                                                            <a href="{{ asset('add_category') }}" style="color:black"
                                                                target="_blank">
                                                                <l class="fa fa-plus iconsl"></l>
                                                            </a>

                                                            <l id="cat_refresh" class="fa fa-refresh iconsl"
                                                                style="cursor: pointer;"></l>

                                                        </div>

                                                        <select id="category" name="category">

                                                            <option value="0" selected disabled>Select</option>


                                                        </select>

                                                    </div>

                                                </div>

                                                <div class="col-md-3">

                                                    <label class="col-form-label col-form-label-sm" for="model">Model

                                                        <span class="text-danger">*</span>

                                                    </label>

                                                    <div class="">

                                                        <div class="icons">

                                                            <a href="{{ asset('add_model') }}" style="color:black"
                                                                target="_blank">
                                                                <l class="fa fa-plus iconsl"></l>
                                                            </a>

                                                            <l id="mod_refresh" class="fa fa-refresh iconsl"
                                                                style="cursor: pointer;"></l>

                                                        </div>

                                                        <select id="model" name="model">

                                                            <option value="0" selected disabled>Select</option>


                                                        </select>

                                                    </div>

                                                </div>

                                                <div class="col-md-3">

                                                    <label class="col-form-label col-form-label-sm" for="serial_no">Serial
                                                        No

                                                        <span class="text-danger">*</span>

                                                    </label>

                                                    <div class="">

                                                        <input type="text" class="form-control form-control-sm"
                                                            id="serial_no" name="serial_no"
                                                            placeholder="Enter a Serial No.."
                                                            onkeypress="return numbersOnly(value)">

                                                    </div>

                                                </div>
                                            </div>


                                            <div class="form-group row">

                                                <div class="col-md-3">

                                                    <label class="col-form-label col-form-label-sm"
                                                        for="equipment">Equipment

                                                        {{-- <span class="text-danger">*</span> --}}

                                                    </label>

                                                    <div class="">

                                                        <input type="text" class="form-control form-control-sm"
                                                            id="equipment" name="equipment"
                                                            placeholder="Enter Equipments..">

                                                    </div>

                                                </div>

                                                <div class="col-md-3">

                                                    <label class="col-form-label col-form-label-sm"
                                                        for="delivery_time">Delivery Time

                                                        <span class="text-danger">*</span>

                                                    </label>

                                                    <div class="">

                                                        <input type="date" class="form-control form-control-sm"
                                                            id="delivery_time" name="delivery_time"
                                                            placeholder="Enter a Delivery Time..">

                                                    </div>

                                                </div>


                                                <div class="col-md-3">

                                                    <label class="col-form-label col-form-label-sm"
                                                        for="estimated_cost">Estimated Charges

                                                        {{--                                                        <span class="text-danger">*</span> --}}

                                                    </label>

                                                    <div class="">

                                                        <input type="text" class="form-control form-control-sm"
                                                            id="estimated_cost" name="estimated_cost"
                                                            placeholder="Enter a Estimated Cost.."
                                                            onkeypress="return numbersOnly(value)">

                                                    </div>

                                                </div>


                                            </div>


                                            <div class="form-group row">


                                                <div class="col-md-3">

                                                    <label class="col-form-label col-form-label-sm"
                                                        for="complain">Complains<span class="text-danger">*</span>

                                                    </label>

                                                    <div class="">

                                                        <input type="text" class="form-control form-control-sm"
                                                            id="complain" name="complain"
                                                            placeholder="Enter a Complain..">

                                                    </div>

                                                </div>

                                                <div class="col-md-3 mt-auto">

                                                    <button type="button" onclick="add_complain()"
                                                        class="btn btn-primary">Add</button>

                                                </div>


                                                <div class="col-md-3">

                                                    <label class="col-form-label col-form-label-sm"
                                                        for="accessories">Accessories<span class="text-danger">*</span>

                                                    </label>

                                                    <div class="">

                                                        <input type="text" class="form-control form-control-sm"
                                                            id="accessories" name="accessories"
                                                            placeholder="Enter a Accessory..">

                                                    </div>

                                                </div>


                                                <div class="col-md-3 mt-auto">

                                                    <button type="button" onclick="add_accessories()"
                                                        class="btn btn-primary">Add</button>

                                                </div>


                                            </div>


                                            <div class="form-group row">


                                                <div class="col-lg-6">

                                                    {{-- <div class="card"> --}}

                                                    {{-- <div class="card-header"> --}}

                                                    {{-- <h4 class="card-title">Bordered Table</h4> --}}

                                                    {{-- </div> --}}

                                                    <div class="card-body">

                                                        <div class="table-responsive">

                                                            <table
                                                                class="table table-bordered verticle-middle table-responsive-sm">

                                                                <thead>

                                                                    <tr>

                                                                        <th scope="col" width="14%">Sr#</th>

                                                                        <th scope="col">Task</th>

                                                                        <th scope="col" width="15%">Action</th>

                                                                    </tr>

                                                                </thead>

                                                                <tbody id="table_body">


                                                                </tbody>

                                                            </table>

                                                        </div>

                                                    </div>

                                                    {{-- </div> --}}

                                                </div>


                                                <div class="col-lg-6">

                                                    {{-- <div class="card"> --}}

                                                    {{-- <div class="card-header"> --}}

                                                    {{-- <h4 class="card-title">Bordered Table</h4> --}}

                                                    {{-- </div> --}}

                                                    <div class="card-body">

                                                        <div class="table-responsive">

                                                            <table
                                                                class="table table-bordered verticle-middle table-responsive-sm w-auto">

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

                                                {{-- </div> --}}


                                            </div>


                                            <div class="form-group row">

                                                <div class="col-lg-8 ml-auto">

                                                    <button type="submit" class="btn btn-primary">Submit</button>

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

        /* farhad add  */

        .rec {
            margin: none;
            font-size: 20px;
            font-family: 'Times New Roman';
            -webkit-print-color-adjust: exact !important;
            /* Chrome, Safari, Edge */
            color-adjust: exact !important;
            /*Firefox*/
        }

        .rec p {
            line-height: 20px
        }

        .centered {
            text-align: center;
            align-content: center;
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
            width: 100px;
            height: 100px;
        }
    </style>

    {{-- <div class="modal fade" id="myModal" role="dialog">

        <div class="modal-dialog modal-lg mdl_wdth">

            <div class="modal-content base_clr">

                <div class="modal-header">

                    <h4 class="modal-title text-black">Sales Invoice Detail</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <div class="modal-body">



                    <div id="table_body">



                    </div>



                </div>



                <div class="modal-footer">

                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <div class="form_controls">

                            <button type="button" class="btn btn-default form-control form-control-sm cancel_button" data-dismiss="modal">

                                <i class="fa fa-times"></i> Cancel

                            </button>

                        </div>

                    </div>

                </div>





            </div>

        </div>

    </div> --}}


    <div class="modal fade rec" id="exampleModall" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header hidden-print">
                    <h5 class="modal-title" id="exampleModalLabel">Sales Invoice Detail</h5>
                    <button type="button" class="btn-close closemodal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="body_print">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary hidden-print closemodal"
                        data-bs-dismiss="modal">Close</button>
                    <button id="btnPrint" class="btn btn-success hidden-print">Print</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')



    <script>
        $("#warrenty").click(function() {

            var check = $('#warrenty').is(':checked');

            if (check == true) {

                $("#wandercol").css("display", "block");

            } else

                $("#wandercol").css("display", "none");

        });


        // $("#wander").change(function () {

        //     if($("#wander").val() != 0){

        //         $("#wandercol").css("display","none");

        //     }

        // });

        $("#brand").change(function() {

            title();

        });

        $("#category").change(function() {

            title();

        });

        $("#model").change(function() {

            title();

        });

        $("#equipment").change(function() {

            title();

        });

        $("#serial_no").change(function() {

            title();

        });

        function title() {

            var brand = document.getElementById("brand");

            var brandtext = brand.options[brand.selectedIndex].text;

            var cat = document.getElementById("category");

            var cattext = cat.options[cat.selectedIndex].text;

            cattext = ((cat.value == 0) ? "" : cattext);

            var model = document.getElementById("model");

            var modeltext = model.options[model.selectedIndex].text;

            modeltext = ((model.value == 0) ? "" : modeltext);

            var equi = document.getElementById("equipment").value;

            var sr_no = document.getElementById("serial_no").value;

            document.getElementById("job_title").value = brandtext + "-" + cattext + "-" + modeltext + "-" + equi + "-" +
                sr_no;

        }

        //   function maincheckForm() {

        //             let number = document.getElementById("number"),

        //             client_name = document.getElementById("client_name"),

        //             client_address = document.getElementById("client_address"),

        //             warrenty = document.getElementById("warrenty"),

        //             delivery_time = document.getElementById("delivery_time"),

        //             brand = document.getElementById("brand"),

        //             category = document.getElementById("category"),

        //             model = document.getElementById("model"),

        //             serial_no = document.getElementById("serial_no"),

        //             estimated_cost = document.getElementById("estimated_cost"),

        //             validateInputIdArray = [

        //                     number.id,

        //                     client_name.id,

        //                     client_address.id,

        //                     warrenty.id,

        //                     delivery_time.id,

        //                     brand.id,

        //                     category.id,

        //                     model.id,

        //                     serial_no.id,

        //                     estimated_cost.id,

        //                 ];


        //             // alert("dasdsada");

        //     if (brand.value == 0) {


        //         brand.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"

        //         return false;

        //     }

        //     else{

        //         brand.nextSibling.childNodes[0].childNodes[0].style.border = ""

        //     }

        //     if (category.value == 0) {

        //         category.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"

        //         return false;

        //     }

        //     else{

        //         category.nextSibling.childNodes[0].childNodes[0].style.border = ""

        //     }

        //     if (model.value == 0) {

        //         model.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"

        //         return false;

        //     }

        //     else{

        //         model.nextSibling.childNodes[0].childNodes[0].style.border = ""

        //     }


        //             // return validateInventoryInputs(validateInputIdArray);


        //             var ok = validateInventoryInputs(validateInputIdArray);


        //             if(ok){

        //                 if(counter == 0){

        //                     $("#complain").addClass('bg-danger');

        //                     return false;

        //                 }

        //                 else if(counter2 == 0){

        //                     $("#accessories").addClass('bg-danger');

        //                     return false;

        //                 }else{

        //                     return true;

        //                 }

        //             }

        //             else{

        //                 return false;

        //             }

        // }


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


                if (counter == 0) {

                    $("#complain").addClass('bg-danger');

                    return false;

                } else if (counter2 == 0) {

                    $("#accessories").addClass('bg-danger');

                    return false;

                } else {

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


        function change_title() {

            $("#brand").val();

        }


        $(document).ready(function() {
            $('#loading').hide();
            $("#wander").select2();

            $("#brand").select2();

            $("#model").select2();

            $("#category").select2();

            $('#form').validate({ // initialize the plugin


                // rules: {

                //     client_name: {

                //         required: true,

                //         pattern: /^[A-Za-z0-9. ]{3,30}$/

                //     },

                //     number: {

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

                //     number: {

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


        var counter = 0;

        var counter2 = 0;


        function add_complain() {


            if (complain_checkForm()) {

                counter++;


                var complain = $("#complain").val();


                add_complain_row(counter, complain);


            } else {


            }


        }


        function add_complain_row(counter, complain) {


            jQuery("#table_body").append(
                '<tr id="table_row' + counter + '">' +

                '<td width="14%">' + counter + '</td>' +

                '<td>' + '<textarea type="text" name="complain_data[]" id="complain_data' + counter + '" value="' +
                complain + '">' + complain + '</textarea>' + '</td>' +


                '<td width="15%">' +

                '<span>' +

                '<a href="javascript:void()" data-toggle="tooltip" data-placement="top" title="Close" onclick="deleterow(' +
                counter + ')"><i class="fa fa-close color-danger"></i></a>' +

                '</span>' +

                '</td>' +


                '</tr>');


            $("#complain").val('');


        }

        function deleterow(count) {

            $("#table_row" + count).remove();

        }

        function deleterow2(count) {

            $("#table_row2" + count).remove();

        }


        function add_accessories() {


            if (accessories_checkForm()) {


                counter2++;


                var accessories = $("#accessories").val();


                add_accessories_row(counter2, accessories);


            } else {


            }


        }


        function add_accessories_row(counter2, accessories) {


            jQuery("#table_body2").append(
                '<tr id="table_row2' + counter2 + '">' +

                '<td width="14%">' + counter2 + '</td>' +

                '<td>' + '<textarea type="text" name="accessory_data[]" id="accessories_data' + counter2 + '" value="' +
                accessories + '">' + accessories + ' </textarea>' + '</td>' +


                '<td width="15%">' +

                '<span>' +

                '<a href="javascript:void()" data-toggle="tooltip" data-placement="top" title="Close" onclick="deleterow2(' +
                counter2 + ')"><i class="fa fa-close color-danger"></i></a>' +

                '</span>' +

                '</td>' +


                '</tr>');


            $("#accessories").val('');


        }
    </script>



    <script>
        jQuery("#brand").change(function() {

            var bra_name_id = $(this).val();


            // var dropDown = document.getElementById('brand');

            // var bra_name_id = dropDown.options[dropDown.selectedIndex].value;


            jQuery.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')

                }

            });


            jQuery.ajax({

                url: "{{ route('get_category') }}",

                data: {
                    bra_name_id: bra_name_id
                },

                type: "GET",

                cache: false,

                dataType: 'json',

                success: function(data) {


                    console.log(data);

                    $options = "<option value='' disabled selected>Select Category</option>";

                    //

                    $.each(data, function(index, value) {

                        $options += "<option value='" + value.cat_id + "'>" + value.cat_name +
                            "</option>";

                    });

                    jQuery("#category").html(" ");

                    jQuery("#category").append($options);

                },

                error: function(jqXHR, textStatus, errorThrown) {

                    alert(jqXHR.responseText);

                    alert(errorThrown);

                }

            });

        });


        jQuery("#category").change(function() {

            var cat_name_id = $(this).val();


            // var dropDown = document.getElementById('brand');

            // var bra_name_id = dropDown.options[dropDown.selectedIndex].value;


            jQuery.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')

                }

            });


            jQuery.ajax({

                url: "{{ route('get_model') }}",

                data: {
                    cat_name_id: cat_name_id
                },

                type: "GET",

                cache: false,

                dataType: 'json',

                success: function(data) {


                    console.log(data);

                    $options = "<option value='' disabled selected>Select Model</option>";

                    //

                    $.each(data, function(index, value) {

                        $options += "<option value='" + value.mod_id + "'>" + value.mod_name +
                            "</option>";

                    });

                    jQuery("#model").html(" ");

                    jQuery("#model").append($options);

                },

                error: function(jqXHR, textStatus, errorThrown) {

                    alert(jqXHR.responseText);

                    alert(errorThrown);

                }

            });

        });


        $('#number').blur(function() {

            var number = $('#number').val();


            jQuery.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')

                }

            });


            jQuery.ajax({

                url: "{{ route('client_exist') }}",

                // url: "client_exist",

                data: {
                    number: number
                },

                type: "GET",

                cache: false,

                dataType: 'json',

                success: function(data) {

                    console.log(data);

                    jQuery("#client_name").val(data['cli_name']);

                    jQuery("#client_address").val(data['cli_address']);


                },

                error: function(jqXHR, textStatus, errorThrown) {

                    alert(jqXHR.responseText);

                    alert(errorThrown);

                }

            });


        });


        jQuery("#bra_refresh").click(function() {


            var bra_name_id = $(this).val();


            jQuery.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')

                }

            });


            jQuery.ajax({

                url: "{{ route('get_brand') }}",

                data: {
                    bra_name_id: bra_name_id
                },

                type: "GET",

                cache: false,

                dataType: 'json',

                success: function(data) {


                    console.log(data);

                    $options = "<option value='' disabled selected>Select Model</option>";

                    $.each(data, function(index, value) {

                        $options += "<option value='" + value.bra_id + "'>" + value.bra_name +
                            "</option>";

                    });

                    jQuery("#brand").html(" ");

                    jQuery("#brand").append($options);

                },

                error: function(jqXHR, textStatus, errorThrown) {

                    alert(jqXHR.responseText);

                    alert(errorThrown);

                }

            });

        });


        jQuery("#cat_refresh").click(function() {


            var bra_name_id = $("#brand").val();


            jQuery.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')

                }

            });


            jQuery.ajax({

                url: "{{ route('get_category') }}",

                data: {
                    bra_name_id: bra_name_id
                },

                type: "GET",

                cache: false,

                dataType: 'json',

                success: function(data) {


                    console.log(data);

                    $options = "<option value='' disabled selected>Select Model</option>";

                    $.each(data, function(index, value) {

                        $options += "<option value='" + value.cat_id + "'>" + value.cat_name +
                            "</option>";

                    });

                    jQuery("#category").html(" ");

                    jQuery("#category").append($options);

                },

                error: function(jqXHR, textStatus, errorThrown) {

                    alert(jqXHR.responseText);

                    alert(errorThrown);

                }

            });

        });


        jQuery("#mod_refresh").click(function() {


            var cat_name_id = $("#category").val();


            jQuery.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')

                }

            });


            jQuery.ajax({

                url: "{{ route('get_model') }}",

                data: {
                    cat_name_id: cat_name_id
                },

                type: "GET",

                cache: false,

                dataType: 'json',

                success: function(data) {


                    console.log(data);

                    $options = "<option value='' disabled selected>Select Model</option>";

                    $.each(data, function(index, value) {

                        $options += "<option value='" + value.mod_id + "'>" + value.mod_name +
                            "</option>";

                    });

                    jQuery("#model").html(" ");

                    jQuery("#model").append($options);

                },

                error: function(jqXHR, textStatus, errorThrown) {

                    alert(jqXHR.responseText);

                    alert(errorThrown);

                }

            });

        });
    </script>









    <script type="text/javascript">
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





    @if (Session::has('ji_id'))
        <script>
            // alert("id mill gai");


            jQuery("#table_body").html("");


            var id = '{{ Session::get('ji_id') }}';
            thermal_print(id);


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

                        var modalbody =
                            // '<div class="ticket">' +
                            '<p class="centered fw-bold">Job Card</p>' +
                            '<img class="img-center" src="{{ asset('') }}' + data.company_profile.cp_logo +
                            '" alt="Logo" width="100" height="100">' +
                            '<p class="centered fw-bold">' + data.company_profile.cp_name + ' <br>' + data
                            .company_profile.cp_salogan + ' </p>' +
                            '<p class="fw-bold">Job# ' + data.items.ji_id + '</p>' +
                            '<div class="border border-primary p-3 my-1">' +
                            '<p style="line-height: 10px;"><span class="fw-bold">Booking Date: </span> ' +
                            booking_date + '</p>' +
                            '<p style="line-height: 0;"><span class="fw-bold">Delivery Date: </span> ' +
                            delivery_date + '</p>' +

                            '</div>' +
                            '<div class="border border-primary p-3 my-1">' +
                            '<p><span class="fw-bold">Job Title: </span>' + data.items.ji_title + '</p>' +
                            '<p style="line-height: 10px;"><span class="fw-bold">Client Name: </span>' + data.items
                            .cli_name + '' +
                            '</p>' +
                            '<p><span class="fw-bold">Client Mobile# </span>' + data.items.cli_number + '' +
                            '</p>' +
                            '<p style="line-height: 10px;"><span class="fw-bold">Warrenty: </span> ' + warrenty +
                            '</p>' +
                            '</div>' +
                            '<div class="border border-primary p-3 my-1">' +
                            '<p><span class="fw-bold">Complaints:</span>';


                        $.each(data.complain_items, function(index, value) {
                            index = index + 1;
                            modalbody += '<br>' + index + '. ' + value.jii_item_name;

                        });


                        modalbody += '</p>' +
                            '<p><span class="fw-bold">Accessories:</span>';
                        $.each(data.accessory_items, function(index, value) {
                            index = index + 1;
                            modalbody += '<br>' + index + '. ' + value.jii_item_name;

                        });
                        let terms = data.company_profile.cp_terms.replace(/,/g, "<br>");

                        modalbody += '</p>' +
                            '</div>' +
                            '<div class="border border-primary p-3 my-1">' +
                            '<p class="centered fw-bold" style="line-height: 5px;"> Estimated Cost: ' + data.items
                            .ji_estimated_cost + '</p>' +
                            '</div>' +
                            '<div class="border border-primary p-3 my-1">' +
                            '<p class="text-capitalize"> Rupees ' + data.nbrOfWrds + ' Only </p>' +
                            '</div>' +
                            '<span class="fw-bold" style="line-height: 5px;"> We Deal in </span>' +
                            '<p class="ml-3">' + data.company_profile.cp_deal + '</p>' +

                            '<span class="fw-bold" style="line-height: 5px;"> Terms & Conditions </span>' +
                            '<p class="ml-3">' + terms + '</p>' +

                            '<p class="centered bold" style="line-height: 10px;">Contact No. ' + data
                            .company_profile.cp_contact + '</p>' +

                            '<p class="centered" style="line-height: 10px;">' + data.company_profile.cp_address +
                            '</p>';
                        // '</div>';
                        $('#body_print').html(modalbody);
                    }
                });

                $('#exampleModall').modal('show');
            }

            // $('.modal-body').load('{{ url('job_info_modal_view_details/view/') }}' + '/' + id, function() {

            //     $("#myModal").modal({
            //         show: true
            //     });


            // // for print preview to not remain on screen

            // if ($('#quick_print').is(":checked")) {

            //

            //     setTimeout(function () {

            //         var abc = $("#printi");

            //         abc.click();

            //

            //

            //         $('.invoice_sm_mdl').css('display', 'none');

            //         $('.cancel_button').click();

            //         $('#product').focus();

            //     }, 100);

            // }


            // });
        </script>

        <script></script>
        {{-- farhad add thermal print script --}}
        <script>
            const $btnPrint = document.querySelector("#btnPrint");
            $btnPrint.addEventListener("click", () => {
                window.print();
            });

            $('.closemodal').click(function() {
                $('#exampleModall').modal('hide');
            });
        </script>
    @endif



@stop
